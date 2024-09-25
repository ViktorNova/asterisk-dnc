<?php 

include_once("config.inc.php"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

    	<link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
    	<link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
    	<link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
	<link rel="manifest" href="./site.webmanifest">
	<link rel="mask-icon" href="./safari-pinned-tab.svg" color="#5bbad5">

	<style type="text/css" media="screen">@import "basic.css";</style>
	<style type="text/css" media="screen">@import "tabs.css";</style>
</head>

<?php 
   $tab = isset($_GET['tab']) ? $_GET['tab'] : "ABC";
   $alph = array("ABC","DEF","GHI","JKL","MNO","PQRS","TUV","WXYZ")
?>

<body>

	<div class="logo">
	</div>

	        <div class="title">
                    <h1 class="title"><?php echo $title; ?></h1>
                </div>
	<a href="admin.php"><div class="loginButton">Add Number</div></a>

	<div id="header">
	<ul id="primary">
	<?php
	   for($i=0;$i<count($alph);$i++){
	      if(strtoupper($tab) == strtoupper($alph[$i])) {
		echo "<li><span>{$alph[$i]}</span></li>\n";
	      } else {
	        echo "<li><a href=\"index.php?tab={$alph[$i]}\">{$alph[$i]}</a></li>\n";
	      }
	   }

 	if (file_exists("admin")) :
 	echo "		<li><a href=\"admin.php\">Admin</a></li>\n" ;
 	endif ;
?> 
	</ul>
	</div>
	<div id="main">
		<div id="contents">
			<div class="note">
			<!-- <h2><?php echo $sub_title; ?></h2>	-->
			<p class="blurb">These numbers are not dialable from the call center</p>
			</div>
<?php

echo "<P>\n" ;
echo "<TABLE cellSpacing=0 cellPadding=15 width=\"100%\" border=0>\n" ;
echo "<TBODY>\n";
echo "<TR width=\"100%\">\n" ;
echo "<TD class=dir vAlign=top align=left width=\"100%\">\n" ;
echo "<TABLE cellSpacing=1 cellPadding=8 border=0 width=\"100%\">\n" ;
echo "<TBODY><TR>\n";

for($i=0;$i<strlen($tab);$i++){

	$chr = substr($tab,$i,1);
	if(strlen($tab) == 3) {
		$w = "33%";
	} else {
		$w = "25%";
	}
	echo "<TD vAlign=top width=\"$w\"><FONT face=verdana,sans-serif>\n" ;
	$query = "SELECT * FROM user1 where name between '$chr' AND '$chr".'zzzz'."' order by name asc";
	$result = mysql_query($query)
    	or die("Web site query failed");
	while ($row = mysql_fetch_array($result)) {
	echo "<div class='dncName'>";
 	echo $row["name"] . "</div><div class='dncNumber'> " .$row["out"] . " " . $row["dialcode"]   . "</div>" . "<BR><BR>\n" ;
	}
	echo "</FONT></TD>\n";
}


echo "</TR></TBODY>\n" ;
echo "</TABLE></TD></TR></TBODY></TABLE></P>\n";


?>
		</div>
	</div>
</body>
</html>
<?php mysql_close($dbconnection); ?>
