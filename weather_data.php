<?php 
$geo_lati = "-37.7963689";
$geo_long = "144.9611738";
$unit = "units=si";
$jsonfile = file_get_contents("https://api.darksky.net/forecast/b49724af929a11f44eadf5e52a072994/".$geo_lati.",".$geo_long."?".$unit."&exclude=minutely&exclude=alert$exclude=flags");

$jsondata = json_decode($jsonfile);
$temperature = $jsondata->currently->temperature;
$precipProbability = $jsondata->currently->precipProbability;
$todayTempHigh = $jsondata->daily->data[0]->temperatureHigh;
$todayTempHighTime = $jsondata->daily->data[0]->temperatureHighTime;
// Convert it into 24hrs + 10hrs (To Melbourne Time)
$highestTime = ($todayTempHighTime%86400)/3600 + 10;
$hourlyProbability = $jsondata->hourly->data[0]->precipProbability;
$dailySummary = $jsondata->daily->summary;

// Retrieve the temperature for 8am and 8pm
$eightAmTemp = 0;
$eightPmTemp = 0;
for ($x=0; $x<24; $x++) {
	$time = $jsondata->hourly->data[$x]->time;
	if ($time%86400 == 28800) {
		$eightAmTemp = $jsondata->hourly->data[$x]->temperature;
	} elseif ($time%86400 == 72000) {
		$eightPmTemp = $jsondata->hourly->data[$x]->temperature;
	}
}
?>