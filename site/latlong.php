<?php
$address = $_POST["location"];
$address = str_replace(' ','+',$address);
$geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyCpvkDGXhNs5yjoEkXtYERc5Nhy64NTXO0&address='.$address.'&sensor=false');
$output= json_decode($geocode);
//print_r($output);
$lat = $output->results[0]->geometry->location->lat;
$long = $output->results[0]->geometry->location->lng;
echo $lat."|".$long;
die;
?> 