<?php
include "weather_data.php";
?>

<html>
	<head>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<div id="middle">
			<h1>Forecast</h1>
			<p>Current Temperature: <?php echo round($temperature,1)?>&#8451</p>
			<p>Chance of Rain Today: <?php echo ($precipProbability*100)?>%</p>
			<p>Highest Temperature will be <?php echo round($todayTempHigh,1)?>&#8451 at <?php echo $highestTime?>:00</p>
			<p>The Temperature at 8:00 will be <?php echo round($eightAmTemp,1)?>&#8451</p>
			<p>The Temperature at 20:00 will be <?php echo round($eightPmTemp,1)?>&#8451</p>
			<!--<p>Testing Hourly Chance of Rain: <?php echo ($hourlyProbability*100)?>%</p>-->
			<p>Today's highest UV Index: <?php echo $uvindex; ?></p>
			<p><?php echo $dailySummary?></p>
		</div>
	</body>
</html>