<?php
/*
*	@author: Jamey Ballard
*	@date: 4/8/2016
*	@filename: printstreams.php
*/
error_reporting(E_ALL);
ini_set("display_errors", 1);

$dataArray = json_decode(@file_get_contents('https://api.twitch.tv/kraken/games/top'), true);  // grabs the games object top from the API
echo "<div id=\"leftpanel\">"; //Panels and stuff
echo "<center>"."<font face=\"arial\" size=\"6\"><b>"."Current Top Games on Twitch"."</b></font>"."<br>";

echo "<font face=\"arial\" size =\"4\">"; 

for ($i=0; $i <10 ; $i++) {
  echo "<br>" . $dataArray['top'][$i]['game']['name'] ."</br>";  // prints off the name of each of the first ten games in the object  which will be the top games

}
echo "</font>"."</center>"."</div>";
 ?>
