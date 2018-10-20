<?php

require_once 'api-swgoh-help.php';

class ApiSwgohHelpKas extends ApiSwgohHelp {


    public function login($returntoken = 0) {
        parent::login();
        if ($returntoken == 1) {
            print $this->token . '<br/><hr/><br/>';
        }
    }

    public function fetchAPI($url, $criteria = null, $lang = null) {
        try {
            if (!isset($this->token)) {
                $this->login();
            }
            $curl = curl_init(); 
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.swgoh.help/swgoh/' . $url . '',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $criteria,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    $this->token),
            ));
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            return $response;
        } catch (Exception $e) {
            throw $e;
        }
    }

   public function checkcache($type) {
        $useCache = 1;
        if (!file_exists($type . ".txt")) {
            $useCache = 0;
        } elseif (isset($_GET['forceCache']) && (integer) $_GET['forceCache'] == 1) {
            $useCache = 0;
        } elseif (strpos($type, ".me") && (time() - filemtime($type . ".txt")) > 86400) {
            $useCache = 0;
       } elseif ((time() - filemtime($type . ".txt")) > 86400 * 7) {
            $useCache = 0;
        }
        return $useCache;
    }

    function loadfromswgoh($type, $id = "") {

        if ($id != "") {
            $otype = "cache/" . $id . ".swgoh." . $type;
        } else {
            $otype = "cache/swgoh." . $type;
        }
        $jsonraw = "";
        if ($this->checkcache($otype) == 1 || $otype == "cache/swgoh.myzetadefinitions") {
            $jsonraw = file_get_contents($otype . ".txt");
        } else {
            if ($type == "memod") {
                $url = "https://swgoh.gg/api/players/" . $id . "/mods/?format=json&rand=" . time();
            } elseif ($type == "me") {
                $url = "https://swgoh.gg/api/player/" . $id . "/?format=json&rand=" . time();
            } else {
                $url = "https://swgoh.gg/api/" . $type . "/?format=json&rand=" . time();
            }
            $jsonraw = file_get_contents($url);
            $fp = fopen($otype . ".txt", 'w');
            fwrite($fp, $jsonraw);
            fclose($fp);
        }
        $json = json_decode($jsonraw);
        return $json;
    }

    function loadfromhelp($type, $id = "") {
        if ($id != "") {
            $otype = "cache/" . $id . ".help." . $type;
        } else {
            $otype = "cache/help." . $type;
        }

        if ($this->checkcache($otype) == 1) {
            $jsonraw = file_get_contents($otype . ".txt");
        } else {
            if ($type == "me") {
                $jsonraw = $this->fetchAPI('player', '{"allycode": ' . $id . ', "language": "eng_us", "project": { "name": 1, "level": 1, "guildName": 1, "stats": 1,"roster" :1 }}');
            } elseif ($type == "skillist") {
                $jsonraw = $this->fetchAPI('data', '{"collection":"skillList","language":"eng_us","enums":true,"project":{"id":1,"abilityReference":1,"isZeta":1}} ');
            } elseif ($type == "abilities") {
                $jsonraw = $this->fetchAPI('data', '{"collection":"abilityList","language":"eng_us","project":{"id":1,"nameKey":1,"descKey":1,"tierList":{"count":1},"useAsReinforcementDesc":1}}');
            } elseif ($type == "abilitiesFull") {
                $jsonraw = $this->fetchAPI('data', '{"collection":"abilityList","language":"eng_us","project":{"id":1,"nameKey":1,"descKey":1,"tierList":{"descKey":1},"useAsReinforcementDesc":1}}');
            }
            try {
                $fp = fopen($otype . ".txt", 'w');
                fwrite($fp, $jsonraw);
                fclose($fp);
            } catch (Exception $e) {
                $jsonraw = file_get_contents($otype . ".txt");
            }
        }

        $json = json_decode($jsonraw);

        return $json;
    }

    function loadmycollection($id) {
        $tncln = $this->loadfromhelp("me", $id);
        return $tncln[0]->roster;
    }

    public $mytooncollection = [];
    public $myzetacollection = [];
    public $mygearcollection = [];
    public $myskllcollection = [];
    public $mymodscollection = [];
    public $allskills = [];
    public $idtoons = []; 
    public $fullcoll = []; 
 
    
    function setmytoonsIDs(){
        $toons = $this->loadfromswgoh('characters');
         foreach ($toons as $k => $v) {
            $id = $v->base_id;
            $this->idtoons[$id] = $v->name;
         } 
         return $toons;
    }
     

    function setmymods() {
        $mymod = $this->loadfromswgoh('memod', $this->allycode);
        $scndstat = ["Speed" => 7, "Critical Chance" => 8, "Critical Damage" => 9, "Offense" => 10, "Health" => 11, "Protection" => 12, "Defense" => 13, "Critical Avoidance" => 14, "Potency" => 15, "Tenacity" => 16, "Accuracy" => 17];
        $modslots = ["", "Square", "Arrow", "Diamond", "Triangle", "Circle", "Cross"];
        $modssets = ["", "Health", "Offense", "Defense", "Speed", "Crit Chance", "Crit Damage", "Potency", "Tenacity"];
        $modlettr = ["", "E", "D", "C", "B", "A"];
        $mi = 0;
        $this->mymodscollection = [];
        foreach ($mymod->mods as $mk => $mv) {
            $mi++;

            $this->mymodscollection[$mv->id] = [$modslots[$mv->slot], $modssets[$mv->set], $mv->level, $mv->rarity, $modlettr[$mv->tier], $mv->primary_stat->name, $this->idtoons[$mv->character], 0, "", "", "", "", "", "", "", "", "", "", $mv->set, $mv->slot];
            if (isset($mv->secondary_stats) && is_array($mv->secondary_stats)) {
                foreach ($mv->secondary_stats as $mvk => $mvv) { 
                    if (isset($this->mymodscollection[$mv->id][($scndstat[$mvv->name])]) && $this->mymodscollection[$mv->id][($scndstat[$mvv->name])] != "") {
                        $this->mymodscollection[$mv->id][($scndstat[$mvv->name])] .= " + " . $mvv->display_value;
                    } else {
                        $this->mymodscollection[$mv->id][($scndstat[$mvv->name])] = $mvv->display_value;
                    }
                }
            }
            $primaryid = $scndstat[$mv->primary_stat->name];
            if ($primaryid == 7) {
                $this->mymodscollection[$mv->id][$primaryid] = $this->mymodscollection[$mv->id][$primaryid] + $mv->primary_stat->display_value;
            } elseif ($this->mymodscollection[$mv->id][$primaryid] != "") {
                $this->mymodscollection[$mv->id][$primaryid] = $this->mymodscollection[$mv->id][$primaryid] . " + " . $mv->primary_stat->display_value;
            } else {
                $this->mymodscollection[$mv->id][$primaryid] = $mv->primary_stat->display_value;
            }
            if ($mi == 10) {
                //break;
            }
        }
    }
 
    function createcachefile() {
        $this->setmytoonsIDs(); 
        $this->setmymods(); 
        

        $fp = fopen("complete." . $this->allycode . ".txt", 'w');
        fwrite($fp, '{"modarray":' . json_encode($this->mymodscollection) . ',"toonarray":' . json_encode($this->mytooncollection) . ',"zetaarray":' . json_encode($this->myzetacollection) . ',"raidarray":' . json_encode($this->mygearcollection) . ',"skllarray":' . json_encode($this->myskllcollection) . '}');
        fclose($fp);
    }

}

?>