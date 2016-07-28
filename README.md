asterisk-dnc
============
Web-based outbound call blacklist for Asterisk 


The web app portion was adapted from Asteridex
http://bestof.nerdvittles.com/applications/asteridex4/
I had to make it look more like LCARS, though ;)

cd /var/www/html
git clone https://github.com/ViktorNova/asterisk-dnc.git dnc
chown -R asterisk:asterisk dnc
cd dnc

##Create database and import tables
Using Adminer, PHPMyAdmin, or the commandline, create the following database & user:
  - DB Name: dncdb
  - DB User: dnc
  - DB Password: password
  - Import mysql/dnc.sql into your newly created database
  - 
The example configs in this repo use these credentials for ease of use.. 
Obviously don't *actually* use 'password' as your password - just make sure you update config.inc.php and the Asterisk config script to use your actual password


##Create audio announcement
When someone dials a blacklisted number, you want to play them a recording letting them know why their call did not go through. 
  - In FreePBX, go to Admin -> System Recordings
  - Add a new recording, and upload the Viktor-DoNotCall.wav file from this repository
  - Leave the name as is (note, you can use your own file too, just be sure and modify the Asterisk config below to reflect the name of your recording. If you use the provided recording and keep the name, no modification of that section is needed)

##Edit Asterisk config
Add this to your Asterisk config. I put mine at the end of extension_custom.conf
This tells Asterisk to check each outbound call against the database before sending it out.
You can also add a list of extensions that you would like to be able to dial blacklisted numbers, if any:

````
; ------------------------------------------------------------------------------------------
; DNC LOOKUP - 
; MAKE SURE THE WEB INTERFACE IS INSTALLED FIRST, OR THIS WILL BLOCK ALL OUTBOUND CALLS!!
;
; ALSO DATABASE INFO MUST BE EDITED APPROPRIATELY!!!
; ------------------------------------------------------------------------------------------

[macro-dialout-trunk-predial-hook]
exten => s,1,NOOP(Checking outbound number against Asteridex blacklist)
;The next bunch of lines are extensions whose calls are NOT checked against the DNC list.
;In other words, these extensions can call numbers that are blacklisted for everyone else
exten => s,n,GotoIf($[${REALCALLERIDNUM} = 400]?next)
exten => s,n,GotoIf($[${REALCALLERIDNUM} = 401]?next)
exten => s,n,GotoIf($[${REALCALLERIDNUM} = 402]?next)
exten => s,n,GotoIf($[${REALCALLERIDNUM} = 403]?next)
; This next section checks all outbound calls against the DNC list
; DON'T FORGET TO CHANGE 'password' TO YOUR ACTUAL DNC DATABASE PASSWORD!
exten => s,n,MYSQL(Connect connid localhost dnc password dncdb)  ;this should work with stock PIAF, alter credentials to suit; can check for error condition here for ${conid} = ""
exten => s,n,NoOp(Connected to asteridex with mysql connection id: ${connid});the following lines query Asteridex dbase and return the number of ocurences of the number to the variable 'count'
exten => s,n,MYSQL(Query resultid ${connid} SELECT count(`id`) FROM `user1` WHERE `out` LIKE '%${OUTNUM:-10}%')
exten => s,n,MYSQL(Fetch fetchid ${resultid} count)
exten => s,n,MYSQL(Clear ${resultid}); can check for error condition here if "${fetchid}" = "0"
exten => s,n,NoOp(Found ${count} occurrences in Asteridex blacklist)
exten => s,n,GotoIf($[${count} = 0]?next)
exten => s,n(begin),Noop(Playing announcement DNC List)
; Play the system recording. MODIFY THIS NEXT LINE IF YOU USE YOUR OWN RECORDING
exten => s,n,Playback(custom/Viktor-DoNotCall,noanswer)
exten => s,n,Noop(number blacklisted, ending call); add whatever you need to alert the caller that the number is blocked
exten => s,n,Hangup() ; or redirect to some other destination
exten => s,n(next),Noop(Not blacklisted, call continues ...)

````

