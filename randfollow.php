<?php
/*
*	@author: Jamey Ballard
*	@date:	4/8/2016
*	@filename: randfollow.php
*/
error_reporting(E_ALL);
ini_set("display_errors", 1);
$user= $_POST["user"];

//Hey Justin if you could fix the formatting Yeah that be great


echo "<font =\"arial\">Streams now on twitch<font>";


$n=0; //offset variable
do
{

// $dataArray = json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams/followed'), true);

// echo "<br> hi ". $total. "</br>";
$dataFollows = json_decode(@file_get_contents('https://api.twitch.tv/kraken/users/' .$user .'/follows/channels?limit=100&offset=' . $n. ''), true);
//grabs the object of a users next 100 follows starting at $n
// this is done as the API will only return 100 channels at a time

$total=$dataFollows['_total'];

$name = array(); //an array need to get the array of streams

for ($i=0; $i < count($dataFollows['follows']) ; $i++) {
  $name[$i]= $dataFollows['follows'][$i]['channel']['name']; // builds an array of all the names from the channel object
}
 $datastream=json_decode(@file_get_contents('https://api.twitch.tv/kraken/streams?stream_type=live&limit=100&channel=' .implode(",",$name) .''), true);
 // gets an object containing the streams which channels  are part of $dataFollow object  and they are online

 // the Implode funiction converts the name array in to a string with commas i.e. trumpsc,firebat,Amaz,... which is what we need to  to build the correct stream object

for ($i=0; $i < count($datastream['streams']) ; $i++) { // a classic for loop to check elements of an array


  if ($datastream['streams'][$i]["_id"]!= null) { // Double check that the stream are online


      $urlarr[$i+$n]=$datastream['streams'][$i]['channel']['url']; // and array of online urls

      }

        }




$n=$n+100; // offset

}while(($total -$n)> 0); //This is here to allow it to run for user with more then onehundred folowers

$rand_index = array_rand($urlarr); // gets a random index of The urlarr

$url= $urlarr[$rand_index]; // get the url at the Random index

header('Location: '.$url); //redircet to our random Url
die(); // ends the PHP after the redirect so the browser makes it to the url


 ?>
