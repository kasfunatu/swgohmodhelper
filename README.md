# swgohmodhelper
Library that interacts with swgoh.gg and swgoh.help before providing suggestions on mod recommendations for Galaxy of Heroes.

It is not the cleanest, efficient code, and I am sure can be improved.  It also only tries to optimise based on speed. 

This work was inspired by working with people from swgoh.help and using swgoh.gg.
Originally it used PHP wrapper: https://github.com/r3volved/api-swgoh-help to access swgoh.help for a number of features; however this version is only looking at mods and so has cut back a number of other elements working on.

In index.php<br/>
    Replace DEFAULT-CODE-YOU with your allycode (you can pass others as id in querystring)<br/>
    Ensure cache/ directory can be written to<br/>
    <br/>
Three tabs:<br/>
  My equipped mods:<br/>
  Table of all mods currently equipped on toons with rating, location and stats<br/>
  <br/>
  Fastest sets<br/>
    Determine based on all options how to create the fastest set possible, then assign and repeat. <br/>
    Where speed sets are used an assumed 15 is added (in game 13-16 range).<br/>
    An additional "set" just using fastest combination is also shown for comparison (not trying to get set bonuses)<br/>
    <br/>
  Mod options<br/>
    sortable and filterable view of all mod options.<br/> 
    unlike fastest sets all overlapping combinations are shown.<br/>
    Select "Assign on a row" will remove those mods from pool and rescan searching for best combinations<br/>
    Filtering can be applied to limit table to specifc mod combinations.<br/>
    
    
 


