<?php 
$geo_lati = "-37.7963689";
$geo_long = "144.9611738";
$air_qua_token = "42293b49452ed774a44e10ed95c9523ceff4d4be";
$darksky_token = "b49724af929a11f44eadf5e52a072994";
$timezone = 10;
$unit = "units=si";
$jsonfile = file_get_contents("https://api.darksky.net/forecast/".$darksky_token."/".$geo_lati.",".$geo_long."?".$unit."&exclude=minutely&exclude=alert$exclude=flags");

$jsondata = json_decode($jsonfile);
$temperature = $jsondata->currently->temperature;
$precipProbability = $jsondata->currently->precipProbability;
$todayTempHigh = $jsondata->daily->data[0]->temperatureHigh;
$todayTempHighTime = $jsondata->daily->data[0]->temperatureHighTime;
// Convert it into 24hrs + 10hrs (To Melbourne Time)
$highestTime = ($todayTempHighTime%86400)/3600 + 10;
$hourlyProbability = $jsondata->hourly->data[0]->precipProbability;
$dailySummary = $jsondata->hourly->summary;
$uvindex = $jsondata->daily->data[0]->uvIndex;

// Retrieve the temperature for 8am and 8pm
$eightAmTemp = 0;
$eightPmTemp = 0;
for ($x=0; $x<24; $x++) {
	$fetchtime = $jsondata->hourly->data[$x]->time;
	$time = ($fetchtime%86400)/3600;
	if (($time+$timezone)%24 == 8) {
		$eightAmTemp = $jsondata->hourly->data[$x]->temperature;
	} elseif (($time+$timezone)%24 == 20) {
		$eightPmTemp = $jsondata->hourly->data[$x]->temperature;
	}
}
?>