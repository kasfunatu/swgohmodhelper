# swgohmodhelper
Library that interacts with swgoh.gg and swgoh.help before providing suggestions on mod recommendations for Galaxy of Heroes.

It is not the cleanest, efficient code, and I am sure can be improved.  It also only tries to optimise based on speed. 

This file is based upon work from swgoh.help and swgoh.gg.
It uses PHP wrapper: https://github.com/r3volved/api-swgoh-help to access swgoh.help

To use:
  Create account with swgoh.help
  in index.php:
    Replace swgoh.help:username with new username
    Replace swgoh.help:password with new password
    Replace DEFAULT-CODE-YOU with your allycode (you can pass others as id in querystring)
    Ensure cache/ directory can be written to
    
    


