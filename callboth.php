<?php
// CallBoth.php 3.01 (c) Copyright Ward Mundy, 2005. All rights reserved.  USE OF THIS APPLICATION CONSTITUTES YOUR AGREEMENT THAT YOU ASSUME ALL RISKS ASSOCIATED WITH ITS USE.
// NO WARRANTIES EXPRESS OR IMPLIED INCLUDING IMPLIED WARRANTIES OF FITNESS FOR USE OR MERCHANTABILITY ARE PROVIDED. IF YOU DON'T AGREE, DON'T USE THE SOFTWARE.
// Ownership of the software remains with the copyright holder.  Your use is subject to the terms of the following Creative Commons License: http://creativecommons.org/licenses/by-nd-nc/1.0/
// Commercial use of this software is prohibited without the written authorization of the copyright holder. Requests for commercial licenses should be emailed to license@mundy.org.

// SECURITY WARNING: This application is intended for use with the AsteriDex web application. See http://NerdVittles.com for more information and BEFORE using this software.

// Before this application will work, you must set the four variables below to support AND protect your system. We don't recommend changing anything else.
// You must also add the following context to the end of your extensions_custom.conf file. Adjust the number following dialout-trunk to the desired trunk number to use for placing your outbound calls. 
// Trunk numbers can be deciphered by looking at the OUT_0, OUT_1 global variables in your extensions_additional.conf file. Choose the OUT number of the trunk to be used for outbound calls.

//    [custom-callboth]
//    exten => _1NXXNXXXXXX,1,Wait(1)
//    exten => _1NXXNXXXXXX,2,Background(pls-wait-connect-call)
//    exten => _1NXXNXXXXXX,3,Macro(dialout-trunk,0,${EXTEN},)
//    exten => _1NXXNXXXXXX,4,Macro(outisbusy)	; No available circuits

// $INdefault defines the default trunk and extension for incoming calls when the IN variable is set to an asterisk (*). Syntax to call a ring group is local/222@from-internal.
// $INtrunk defines which trunk you wish to use to process incoming calls. The usual options are SIP and IAX2.
// $LDprefix defines the dialing prefix, if any, to be appended to the OUT dial string stored for each database entry.
// $CallerID defines the caller id to be sent with the outbound call.
// Note: Nothing technically precludes forwarding the INbound portion of these calls to a cell phone or any other phone, e.g. $INdefault = "SIP/telasip-gw/16785551212"
// Remember: The outbound call does not get placed until the inbound call is answered; however, if voice mail or an answering machine answers the inbound call, that counts.

include_once("config.inc.php");

// --------------------------------  MAKE NO CHANGES BELOW HERE -------------------------------------------------------------------------------

$IN=$_REQUEST['IN'];
$OUT=$_REQUEST['OUT'];
$SEQ=$_REQUEST['SEQ'];
if ($IN < "1" and $IN<>"*") :
  exit() ;
endif ;
if ($IN<>"*") :
 $IN = $INtrunk . "/" . $IN ;
else  :
 $IN = $INdefault ;
endif ;
$OUT= $LDprefix . $OUT ;

$IN = str_replace( chr(13), "", $IN );
$IN = str_replace( chr(10), "", $IN );
$IN = str_replace( ">", "", $IN );
$IN = str_replace( "<", "", $IN );
$OUT = str_replace( chr(13), "", $OUT );
$OUT = str_replace( chr(10), "", $OUT );
$OUT = str_replace( ">", "", $OUT );
$OUT = str_replace( "<", "", $OUT );


$pos = false ;
// You can add any error detection logic desired below. Right now, it is minimal.
if (strlen($OUT)>100) :
 $pos=true ;
endif ;
if (strlen($IN)>100) :
 $pos=true ;
endif ;
if ($SEQ<>"654321") :
 $pos=true ;
endif ;

if ($pos===false) :
$errno=0 ;
$errstr=0 ;
$fp = fsockopen ("localhost", 5038, &$errno, &$errstr, 20);
 if (!$fp) {
  echo "$errstr ($errno)<br>\n"; 
} else {
 fputs ($fp, "Action: login\r\n");
 fputs ($fp, "Username: admin\r\n");
 fputs ($fp, "Secret: amp111\r\n");
 fputs ($fp, "Events: off\r\n\r\n");
sleep(1) ;
 fputs ($fp, "Action: Originate\r\n");
 fputs ($fp, "Channel: $IN\r\n");
 fputs ($fp, "Context: custom-callboth\r\n");
 fputs ($fp, "Exten: $OUT\r\n");
 fputs ($fp, "Priority: 1\r\n\r\n");
 fputs ($fp, "Callerid: $CallerID\r\n\r\n");
 fputs ($fp, "Timeout: 30\r\n\r\n");
sleep(2) ;
 fclose ($fp);
 } 

echo "<HTML><HEAD>\n" ;
echo "<script>\n";
echo "var duration = 4000;\n" ;
echo "x = null;\n";
echo "function closeIt(){\n";
echo "x = setTimeout(\"self.close()\",duration);\n";
echo "}\n";
echo "</script>\n";
echo "</HEAD><BODY onload=\"closeIt();self.focus()\">\n" ;
echo "Extension $IN is ringing now. <BR>When $IN answers, call to $OUT will be placed.\n" ;
echo "</BODY></HTML>\n" ;

else :
 echo "<HTML><HEAD>\n" ;
 echo "<script>\n";
 echo "var duration = 1000;\n" ;
 echo "x = null;\n";
 echo "function closeIt(){\n";
 echo "x = setTimeout(\"self.close()\",duration);\n";
 echo "}\n";
 echo "</script>\n";
 echo "</HEAD><BODY onload=\"closeIt();self.focus()\">\n" ;
 echo "</BODY></HTML>\n" ;
endif;
?>
