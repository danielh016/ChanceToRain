<?php 
include "parameters.php";
//$geo_lati = "-37.7963689";
//$geo_long = "144.9611738";
$timezone = 10;
$unit = "units=si";

$userIp = getUserIpAddr();
$geojson = file_get_contents("http://ip-api.com/json/".$userIp);
$geodata = json_decode($geojson);
$geo_lati = $geodata->lat;
$geo_long = $geodata->lon;
$city = $geodata->city;

$jsonfile = file_get_contents("https://api.darksky.net/forecast/".$darksky_token."/".$geo_lati.",".$geo_long."?".$unit."&exclude=minutely&exclude=alert$exclude=flags");
$jsonAir = file_get_contents("https://api.waqi.info/feed/geo:".$geo_lati.";".$geo_long."/?token=".$air_qua_token);

$jsondata = json_decode($jsonfile);
$airdata = json_decode($jsonAir);
$temperature = $jsondata->currently->temperature;
$precipProbability = $jsondata->daily->data[0]->precipProbability;
$todayTempHigh = $jsondata->daily->data[0]->temperatureHigh;
$todayTempHighTime = $jsondata->daily->data[0]->temperatureHighTime;
// Convert it into 24hrs + 10hrs (To Melbourne Time)
$highestTime = ($todayTempHighTime%86400)/3600 + 10;
$hourlyProbability = $jsondata->hourly->data[0]->precipProbability;
$dailySummary = $jsondata->hourly->summary;
$uvindex = $jsondata->daily->data[0]->uvIndex;
$pm25 = $airdata->data->iaqi->pm25->v;
$pm25time = $airdata->data->time->s;


$weeklyHighTemp = [];
$weeklyLowTemp = [];
$weeklyChanceToRain = [];
$weekday = [];
for ($i=1; $i<8; $i++) {
	$tempHigh = $jsondata->daily->data[$i]->temperatureHigh;
	$tempLow = $jsondata->daily->data[$i]->temperatureLow;
	$chanceToRain = $jsondata->daily->data[$i]->precipProbability;
	$day = $jsondata->daily->data[$i]->time;
	array_push($weeklyHighTemp, $tempHigh);
	array_push($weeklyLowTemp, $tempLow);
	array_push($weeklyChanceToRain, ($chanceToRain*100));
	array_push($weekday, date('D', $day));
}

include "scale.php"; // The descriptions of the UV / PM2.5 score.

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

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
?>