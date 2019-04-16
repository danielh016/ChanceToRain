<?php
include "weather_data.php";
?>

<html>
	<head>
		<style>
			h1, p {
				font-family: Arial, Helvetica, sans-serif;
			}
			#middle {
				position: absolute;
				text-align: center;
				background-color: #fff7c1;
				width: 500px;
				height: 300px;
				margin: auto;
				padding: 20px;
     			top: 0;
     			right: 0;
     			bottom: 0;
     			left: 0;
			}
		</style>
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
			<p><?php echo $dailySummary?></p>
		</div>
	</body>
</html>