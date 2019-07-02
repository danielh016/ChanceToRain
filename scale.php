<?php 
	//include "weather_data.php";

function scaling($uvindex) {
	if ($uvindex < 2) {
		$uvscale = "Low";
	} elseif ($uvindex < 5) {
		$uvscale = "Moderate, better wear a hat and put on sunscreen every 2 hours.";
	} elseif ($uvindex < 7) {
		$uvscale = "High! Reduce exposure by staying under the shade and put on sunscreen!";
	} elseif ($uvindex < 10) {
		$uvscale = "Very High! Reduce exposure by staying under the shade and put on sunscreen!";
	} else {
		$uvscale = "*EXTREMELY DANGEROUS OUTSIDE*";
	}
	return $uvscale;
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