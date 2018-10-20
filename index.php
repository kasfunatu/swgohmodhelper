<?php
if (isset($_GET['id']) && (int) $_GET['id'] > 0) {
    $me = (int) $_GET['id'];
} else {
    $me = 'DEFAULT-CODE-YOU';
}

$gotETLV = 1;
if (!file_exists("complete.".$me. ".txt")) {
    $gotETLV = 0;
} elseif (isset($_GET['forceCache']) && (integer) $_GET['forceCache'] == 1) {
    $gotETLV = 0;
} elseif ((time() - filemtime("complete.".$me. ".txt")) > 86400) {
    $gotETLV = 0;
} 
if($gotETLV==0){
    
    $swgoh = new ApiSwgohHelpKas();
    $swgoh->allycode = $me;
    $swgoh->createcachefile();
}


 



?><!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/datatables.min.css"/>
        <style type="text/css">div.container table {margin-top:20px;margin-bottom:50px; font-size:8px}</style>
        <title>SWGOH</title>
    </head>
    <body>  
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
           
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-6">My equipped mods</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-7">Fastest sets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-8">Mod options</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
           <div class="tab-pane active container" id="tabs-6"><input type="button" onclick="copytext('mods_list_equpped', 1);" value="Copy to clipboard"/><br/><br/><table id="mods_list_equpped" border="1"><thead><tr><th>ID</th><th>Slot</th><th>Set</th><th>Level</th><th>Dot</th><th>Tier</th><th>Primary</th><th>Currently on</th><th>Speed</th><th>Critical Chance</th><th>Critical Damage</th><th>Offense</th><th>Health</th><th>Protection</th><th>Defense</th><th>Critical Avoidance</th><th>Potency</th><th>Tenacity</th></tr></thead><tbody><tbody></tbody><tfoot><tr><th>ID</th><th>Slot</th><th>Set</th><th>Level</th><th>Dot</th><th>Tier</th><th>Primary</th><th>Currently on</th><th>Speed</th><th>Critical Chance</th><th>Critical Damage</th><th>Offense</th><th>Health</th><th>Protection</th><th>Defense</th><th>Critical Avoidance</th><th>Potency</th><th>Tenacity</th></tr></tfoot></table></div>
            <div class="tab-pane container" id="tabs-7"><input type="button" onclick="copytext('mods_fast_options', 1);" value="Copy to clipboard"/><br/><br/><table id="mods_fast_options" border="1"><thead><tr><th>Name</th>		<th>Sets</th><th>Square</th>	<th></th>	<th>Arrow</th>	<th></th>	<th>Diamond</th>	<th></th>	<th>Triangle</th>	<th></th>	<th>Circle</th>	<th></th>	<th>Cross</th>	<th></th><th></th></tr></thead><tbody></tbody></table></table></div>
            <div class="tab-pane container" id="tabs-8"><div><div style="width:30%; float:left">
                       <h4>Filtered</h4>
                       <select id="modSelect" onchange="returnbodsoftype(finalmodcomboarray,this.options[this.selectedIndex].value,0,100)">
                           
                           <option value="0"> - All - </option>
                           <option value="555">Crit Chance + Crit Chance + Crit Chance </option>
<option value="535">Crit Chance + Crit Chance + Defense </option>
<option value="515">Crit Chance + Crit Chance + Health </option>
<option value="355">Crit Chance + Defense + Crit Chance </option>
<option value="335">Crit Chance + Defense + Defense </option>
<option value="315">Crit Chance + Defense + Health </option>
<option value="155">Crit Chance + Health + Crit Chance </option>
<option value="135">Crit Chance + Health + Defense </option>
<option value="115">Crit Chance + Health + Health </option>
<option value="755">Crit Chance + Potency + Crit Chance </option>
<option value="735">Crit Chance + Potency + Defense </option>
<option value="715">Crit Chance + Potency + Health </option>
<option value="855">Crit Chance + Tenacity + Crit Chance </option>
<option value="835">Crit Chance + Tenacity + Defense </option>
<option value="815">Crit Chance + Tenacity + Health </option>
<option value="506">Crit Damage + Crit Chance </option>
<option value="306">Crit Damage + Defense </option>
<option value="106">Crit Damage + Health </option>
<option value="706">Crit Damage + Potency </option>
<option value="806">Crit Damage + Tenacity </option>
<option value="533">Defense + Crit Chance + Defense </option>
<option value="513">Defense + Crit Chance + Health </option>
<option value="313">Defense + Defense + Health </option>
<option value="133">Defense + Health + Defense </option>
<option value="113">Defense + Health + Health </option>
<option value="733">Defense + Potency + Defense </option>
<option value="713">Defense + Potency + Health </option>
<option value="833">Defense + Tenacity + Defense </option>
<option value="813">Defense + Tenacity + Health </option>
<option value="511">Health + Crit Chance + Health </option>
<option value="311">Health + Defense + Health </option>
<option value="111">Health + Health + Health </option>
<option value="711">Health + Potency + Health </option>
<option value="811">Health + Tenacity + Health </option>
<option value="502">Offense + Crit Chance </option>
<option value="302">Offense + Defense </option>
<option value="102">Offense + Health </option>
<option value="702">Offense + Potency </option>
<option value="802">Offense + Tenacity </option>
<option value="557">Potency + Crit Chance + Crit Chance </option>
<option value="537">Potency + Crit Chance + Defense </option>
<option value="517">Potency + Crit Chance + Health </option>
<option value="577">Potency + Crit Chance + Potency </option>
<option value="357">Potency + Defense + Crit Chance </option>
<option value="337">Potency + Defense + Defense </option>
<option value="317">Potency + Defense + Health </option>
<option value="377">Potency + Defense + Potency </option>
<option value="157">Potency + Health + Crit Chance </option>
<option value="137">Potency + Health + Defense </option>
<option value="117">Potency + Health + Health </option>
<option value="177">Potency + Health + Potency </option>
<option value="757">Potency + Potency + Crit Chance </option>
<option value="737">Potency + Potency + Defense </option>
<option value="717">Potency + Potency + Health </option>
<option value="777">Potency + Potency + Potency </option>
<option value="857">Potency + Tenacity + Crit Chance </option>
<option value="837">Potency + Tenacity + Defense </option>
<option value="817">Potency + Tenacity + Health </option>
<option value="877">Potency + Tenacity + Potency </option>
<option value="504">Speed + Crit Chance </option>
<option value="304">Speed + Defense </option>
<option value="104">Speed + Health </option>
<option value="704">Speed + Potency </option>
<option value="804">Speed + Tenacity </option>
<option value="558">Tenacity + Crit Chance + Crit Chance </option>
<option value="538">Tenacity + Crit Chance + Defense </option>
<option value="518">Tenacity + Crit Chance + Health </option>
<option value="578">Tenacity + Crit Chance + Potency </option>
<option value="588">Tenacity + Crit Chance + Tenacity </option>
<option value="358">Tenacity + Defense + Crit Chance </option>
<option value="338">Tenacity + Defense + Defense </option>
<option value="318">Tenacity + Defense + Health </option>
<option value="378">Tenacity + Defense + Potency </option>
<option value="388">Tenacity + Defense + Tenacity </option>
<option value="158">Tenacity + Health + Crit Chance </option>
<option value="138">Tenacity + Health + Defense </option>
<option value="118">Tenacity + Health + Health </option>
<option value="178">Tenacity + Health + Potency </option>
<option value="188">Tenacity + Health + Tenacity </option>
<option value="758">Tenacity + Potency + Crit Chance </option>
<option value="738">Tenacity + Potency + Defense </option>
<option value="718">Tenacity + Potency + Health </option>
<option value="778">Tenacity + Potency + Potency </option>
<option value="788">Tenacity + Potency + Tenacity </option>
<option value="858">Tenacity + Tenacity + Crit Chance </option>
<option value="838">Tenacity + Tenacity + Defense </option>
<option value="818">Tenacity + Tenacity + Health </option>
<option value="878">Tenacity + Tenacity + Potency </option>
<option value="888">Tenacity + Tenacity + Tenacity </option>

                       </select>
               </div><div style="width:70%; float:left">
                   <h4>Assigned sets</h4>
                   <a onclick="modreset();">reset</a>
                   <table id="mods_my_options" border="1"></table>
               </div></div>
             <div><div style="width:30%; float:left">
                       <h4>selected mod</h4>
               </div><div style="width:70%; float:left">
                   <h4>Available options</h4>
                   <input type="button" onclick="copytext('mods_all_options', 1);" value="Copy to clipboard"/>
                   <table id="mods_all_options" border="1"></table>
               </div></div></div>
        </div> 
        
        
         

      

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS --> 
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/datatables.min.js"></script>
        <script>
                    tempdata = [];
                    fulldata = [];
                    finalmodcomboarray= [];
                    function copytext(mytable, myclear) {
                        i=-2;
                        if(mytable!="mods_fast_options" && mytable!="mods_all_options"){
                            var table = $('#'+mytable+'').DataTable();
                            info = table.page.info();
                            i=info.length;
                            table.page.len( -1 ).draw();
                        }
                        
                        
                        el = document.getElementById(mytable);
                        var body = document.body, range, sel;
                        if (document.createRange && window.getSelection) {
                            range = document.createRange();
                            sel = window.getSelection();
                            sel.removeAllRanges();
                            try {
                                range.selectNodeContents(el);
                                sel.addRange(range);
                            } catch (e) {
                                range.selectNode(el);
                                sel.addRange(range);
                            }
                        } else if (body.createTextRange) {
                            range = body.createTextRange();
                            range.moveToElementText(el);
                            range.select();
                        }
                        document.execCommand("Copy");
                        if (myclear == 1) {
                            if (window.getSelection) {
                                window.getSelection().removeAllRanges();
                            } else if (document.selection) {
                                document.selection.empty();
                            }
                        }
                        if(i>-2){
                           table.page.len( i ).draw();
                        }
                    }

                    function getbestspeed(data,returnrows=1,justbest=0){
                        bestspeed = [];
                        $.each(data, function(mk, mv) {
                            if(justbest==1 && mv[18]==4){uak = 4;}else if(justbest==1){uak = 9;}else{uak = mv[18];}
                            if (!bestspeed[uak]){bestspeed[uak] = ["", [-1, 0], [-1, 0], [-1, 0], [-1, 0], [-1, 0], [-1, 0]]; }
                            if (!bestspeed[uak][mv[19]]){bestspeed[uak][mv[19]] = [ -1, ""]; }
                            if (mv[7] > bestspeed[uak][mv[19]][0]){
                                bestspeed[uak][mv[19]] = [mv[7]*1, mk];
                            }
                        });  
                        
                       
                        finalmodcomboarray = [];
                        modcomboarray = [];
                        for (mi = 1; mi <= 9; mi++){
                            if((justbest==1 && (mi==4 || mi==9)) || justbest==0){
                                if (mi === 2 || mi === 4 || mi === 6){istf = 1; } else{istf = 0; }
                                startat = 0; checkat = 0; ca = 0;
                                checkall = []; modall = [];
                                if (istf === 1) {
                                    for (msi = 1; msi <= 6; msi++) {
                                        if (bestspeed[mi][msi] && bestspeed[mi][msi][0]) {
                                            startat += bestspeed[mi][msi][0] * 1;
                                            checkat += Math.pow(2, (msi - 1));
                                            checkall.push(msi);
                                            modall[msi] = bestspeed[mi][msi][1];
                                            ca ++;
                                        }
                                    }
                                }

                                if (mi === 4) {startat += 15; }
                                if (checkall.length == 6 && istf == 1){
                                    for (xi = 1; xi < 6; xi++) {
                                        for (yi = (xi + 1); yi <= 6; yi++) {
                                            tempmodall = modall.slice();
                                            combo = 63 - Math.pow(2, (xi - 1)) - Math.pow(2, (yi - 1));
                                            speed = startat - bestspeed[mi][xi][0] * 1 - bestspeed[mi][yi][0] * 1;
                                            if (!modcomboarray[mi]){modcomboarray[mi] = []; }

                                            tempmodall[yi]='';
                                            tempmodall[xi]='';
                                            modcomboarray[mi].push([combo, mi, speed, tempmodall]);
                                        }
                                    }
                                } else if (checkall.length >= 4 && istf == 1){ 
                                    $.each(checkall, function(xxi, xi) {
                                        tempmodall = modall.slice();
                                         combo = checkat - Math.pow(2, (xi - 1));
                                         speed = startat - bestspeed[mi][xi][0];
                                            tempmodall[xi]='';
                                    });
                                    if (!modcomboarray[mi]){modcomboarray[mi] = []; }        
                                   modcomboarray[mi].push([combo, mi, speed, tempmodall]);

                                } else if (istf == 0){
                                    for (xi = 1; xi < 6; xi++) {
                                        for (yi = (xi + 1); yi <= 6; yi++) {
                                            if (bestspeed[mi] && bestspeed[mi][xi] && bestspeed[mi][xi][0] && bestspeed[mi][yi] && bestspeed[mi][yi][0]) {
                                                combo = Math.pow(2, (xi - 1)) + Math.pow(2, (yi - 1));
                                                speed = bestspeed[mi][xi][0] * 1 + bestspeed[mi][yi][0] * 1;
                                                if (!modcomboarray[mi]){modcomboarray[mi] = []; }
                                                modcomboarray[mi].push([combo, mi, speed, [bestspeed[mi][yi][1], bestspeed[mi][xi][1]]]);
                                            } 
                                        }
                                    }
                                }
                            }
                        }
 
 
                        
 

                        for (pi = 1; pi < 9; pi++) {
                            if (pi != 2 && pi != 4 && pi != 6) {
                                $.each(modcomboarray[pi], function(mk, msa)  {
                                    a = msa[0]*1;
                                    for (ppi = pi ; ppi <= 8; ppi++) {
                                        if (ppi != 2 && ppi != 4 && ppi != 6) {
                                            $.each(modcomboarray[ppi], function(ok, oka)  {
                                                b = oka[0]*1;
                                                if ((a ^ b) == (a + b)) {
                                                    mi = pi * 10 + ppi;
                                                    if (!modcomboarray[mi]){modcomboarray[mi] = []; }
                                                    tempmsa = msa[3].slice();
                                                    tempoka = oka[3].slice();
                                                    modcomboarray[mi].push([a + b, mi, (msa[2] * 1 + oka[2] * 1), $.merge(tempmsa, tempoka)]);
                                                }
                                            });
                                        }
                                    }
                                }); 
                            }
                        }
                        
                         if(justbest==1 ){
                             dblmodarray = modcomboarray[9];
                         }else{
                            dblmodarray = $.merge(modcomboarray[1], modcomboarray[3]);
                            dblmodarray = $.merge(dblmodarray, modcomboarray[5]);
                            dblmodarray = $.merge(dblmodarray, modcomboarray[7]);
                            dblmodarray = $.merge(dblmodarray, modcomboarray[8]);
                         }
                       
                        for (pi = 1; pi <= 88; pi++) {
                            if (pi != 1 && pi != 3 && pi != 5 && pi != 7 && pi != 9 && pi != 8 && modcomboarray[pi] && modcomboarray[pi].length > 0) {
                                $.each(modcomboarray[pi], function(mk, msa)  {
                                    a = msa[0]*1;
                                    $.each(dblmodarray, function(dk, dka) {
                                        b = dka[0]*1;
                                        ppi = dka[1];
                                        if ((a ^ b) == (a + b) && (pi>ppi || pi<10)) {
                                            mi = pi + ppi * 100;
                                            
                                            tempmsa = msa[3].slice();
                                            tempdka = dka[3].slice();
                                            finalmodcomboarray.push([a + b, mi, (msa[2] * 1 + dka[2] * 1), $.merge(tempmsa, tempdka)]);
                                            
                                        }
                                    });
                                });
                            } 
                        }

                        finalmodcomboarray.sort(function(a, b) {
                            return  b[2] - a[2];
                        });
                        
                        returnmodstable(finalmodcomboarray,returnrows,justbest);  
                    }

                    function returnbodsoftype(finalmodcomboarray,find=0,returnrows=1){
                       if(find==0){
                            $("#mods_all_options tr").remove();
                        returnmodstable(finalmodcomboarray,returnrows);
                       }else{
                            filtermod = [];
                            $.each(finalmodcomboarray, function(mk, mv) { 
                                if(mv[1]==find){
                                    filtermod.push(mv); 
                                }
                            });
                         $("#mods_all_options tr").remove();
                     }
                        returnmodstable(filtermod,returnrows);
                    }
                    
                    function assignmods(removemods=[]){
                        $.each(removemods, function(mk, mv) {
                            tempdata[mv]= [];
                        });
                    }
                    
                    
                    function assignandreset(ele, removemods=[],returnrows=1){ 
                        $("#mods_my_options").append('<tr>'+$(ele).closest('tr').html()+'</tr>');
                        assignmods(removemods);
                        $("#mods_all_options tr").remove();
                        $("#modSelect").val(0);
                        getbestspeed(tempdata,returnrows);  
                    }

                    function modreset(){ 
                        var tempdata = Object.assign({}, fulldata);
                        $("#mods_all_options tr").remove();
                        $("#mods_my_options tr").remove();                        
                        getbestspeed(tempdata,200); 
                    }


                    function returnmodstable(finalmodcomboarray,returnrows=1,justbest=0){
                            modbT = ''; oom = 1;
                            lastlist= [];
                            allslot = ["", "", "", "", "", "", ""];
                            modsets = ["", "Health", "Offense", "Defense", "Speed", "Crit Chance", "Crit Damage", "Potency", "Tenacity","any?"];
                            $.each(finalmodcomboarray, function(mk, mv) {
                                modaT = ''; modlist = '';  templist = [];
                                mi = mv[1];
                                modsetused = modsets[(mi % 10)]+ ' + ' + modsets[(Math.floor(mi / 100))]
                                if (modsets[(Math.floor((mi % 100) / 10))] != "") {
                                    modsetused = modsetused + ' + ' + modsets[(Math.floor((mi % 100) / 10))];
                                }
                                modaT += '<tr><td>' + mv[2] + '</td><td>' + modsetused+' ('+mi+')</td>';;
                                tempslot = allslot.slice();modlist = "";
                                $.each(mv[3], function(mmk, mmv) {
                                    if( fulldata[mmv] && mmv!==0 ){
                                  
                                        tempslot[fulldata[mmv][19]] = "" + fulldata[mmv][1] + " +" + fulldata[mmv][7] + "</td><td>" + (fulldata[mmv][6])+ "";
                                        modlist += mmv + "<br/>";   
                                        templist.push(mmv.trim());
                                    }
                                }); 
                                templist.sort(); 
                                 
                                for (ti = 1; ti < 7; ti++) {
                                     modaT += "<td>" + tempslot[ti] + "</td>";
                                }
                                if(returnrows==1){
                                    modaT += '<td>' + modlist + '</td>';
                                }else{
                                    modaT += '<td><a onclick=\'assignandreset(this,'+JSON.stringify(templist)+',0,100)\'>Assign</a></td>';
                                }
                                modaT += '</tr>';
 
                                 if(returnrows==1 && justbest==0){
                                    assignmods(templist);
                                } 
                            if(JSON.stringify(lastlist)!=JSON.stringify(templist)){
                                 modbT += modaT;
                             }
                             
                                lastlist = templist; 
                                
                                if (oom === returnrows ){
                                    return false;
                                } 
                                                                  oom++;  
                                if(oom==200){return false;}
                            });
                             
                             if(returnrows==1){
                                $("#mods_fast_options").append(modbT);
                                if(justbest==1){
                                    $("#mods_fast_options").append($("#mods_fast_options thead").html());
                                 }
                             }else{
                                $("#mods_all_options").append(modbT);
                             } 
                    }



                    function activatedatatable(tableID,dataArray,orderBy){
                    datatable = $('#'+tableID+'').DataTable( {
                            initComplete: function () {
                                this.api().columns().every( function () {
                                    var column = this;
                                    var select = $('<select><option value=""></option></select>')
                                        .appendTo( $(column.footer()).empty() )
                                        .on( 'change', function () {
                                            var val = $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                            );
                                            column
                                                .search( val ? '^'+val+'$' : '', true, false )
                                                .draw();
                                        } );
                                    column.data().unique().sort().each( function ( d, j ) {
                                        select.append( '<option value="'+d+'">'+d+'</option>' )
                                    } );
                                } );
                            }, 
                            data:  dataArray, 
                             "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                             "iDisplayLength": 50,
                            "order": orderBy
                        } ); 
                    }


                    function addmodtable(_tempmodarray){ 
                       var dttempmodarray = [];  
                       $.each(_tempmodarray, function(mk, mv) {  
                           var mx =  mv.slice(0) ;
                           mx.unshift(mk); 
                           dttempmodarray.push(mx ); 
                        });
                        activatedatatable('mods_list_equpped',dttempmodarray,[[ 8, 'desc' ]]);
                    }
                     
                    function addsimpletable(mydata, addtotable, sortby = [[ 0, 'asc' ]]){
                        var dttempmodarray = [];  
                        $.each(mydata, function(mk, mv) {  
                            dttempmodarray.push(mv ); 
                        });  
                        activatedatatable(addtotable,dttempmodarray,sortby);
                    }
 

                    $.getJSON("complete.<?php print $me;?>.txt", function(data) {
                        fulldata = data['modarray']; 
                        addmodtable(fulldata);
                        tempdata =  Object.assign({}, fulldata);
                        getbestspeed(tempdata,1,1); 
                        for(i=0;i<10;i++){
                            getbestspeed(tempdata,1); 
                        }
                        tempdata = Object.assign({}, fulldata); 
                        getbestspeed(tempdata,200); 
                    }); 


        </script>
    </body>
</html>
