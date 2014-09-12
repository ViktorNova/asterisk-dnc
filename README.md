asterisk-dnc
============

Web-based outbound call blacklist for Asterisk 

Ignore this please! For now.


These notes are just for me at the moment, so I can remember how I did this before
Adapted from: http://bestof.nerdvittles.com/applications/asteridex4/


cd /var/www/html
mkdir dnc
cd dnc
wget http://bestof.nerdvittles.com/applications/asteridex4/asteridex4.zip
unzip asteridex4.zip
rm -f asteridex4.zip
chown asterisk:asterisk *
chmod +x *
nano -w config.inc.php


