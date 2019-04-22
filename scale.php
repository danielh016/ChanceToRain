<?php 
	//include "weather_data.php";

	if ($uvindex < 2) {
		$uvscale = "Low";
	} elseif ($uvindex < 5) {
		$uvscale = "Moderate, better put on sunscreen every 2 hours.";
	} elseif ($uvindex < 7) {
		$uvscale = "High! Reduce exposure and put on sunscreen!";
	} elseif ($uvindex < 10) {
		$uvscale = "Very High! Reduce exposure and put on sunscreen!";
	} else {
		$uvscale = "*EXTREME*";
	}

	if ($pm25 < 50) {
		$pmscale = "Good";
	} elseif ($pm25 < 100) {
		$pmscale = "Moderate, still acceptable.";
	} elseif ($pm25 < 150) {
		$pmscale = "Unhealthy for sensitve groups";
	} elseif ($pm25 < 200) {
		$pmscale = "Unhealthy, avoid outside activities.";
	} elseif ($pm25 < 300) {
		$pmscale = "Very Unhealthy, WARNING of emergency conditions.";
	} else {
		$pmscale = "*HAZARDOUS* GO INDOOR RIGHT NOW";
	}
 ?>