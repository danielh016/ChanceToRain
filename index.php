<?php
include "weather_data.php";
?>

<html>
	<head>
		<link rel="stylesheet" href="css/styles.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	</head>
	<body>
		<div class="grid-container">
  			<div class="grid-item">
  				<h1>Chance To Rain</h1>
				<p>Location: <?php echo $city; ?></p>
				<p>Current Temperature: <?php echo round($temperature,1)?>&#8451</p>
				<p>Chance of Rain Today: <?php echo ($precipProbability*100)?>%</p>
				<p>Highest Temperature will be <?php echo round($todayTempHigh,1)?>&#8451 at <?php echo $highestTime?>:00</p>
				<p>The Temperature at 8:00 will be <?php echo round($eightAmTemp,1)?>&#8451</p>
				<p>The Temperature at 20:00 will be <?php echo round($eightPmTemp,1)?>&#8451</p>
				<p><?php echo $dailySummary?></p>
  			</div>
  			<div class="grid-item">
  				<canvas id="sevenDayTemp" width="400" height="200"></canvas>
  			</div>
  			<div class="grid-item">
  				<p>Today's highest UV Index: <?php echo $uvindex ?>(<?php echo $uvscale ?>)</p>
  			</div>  
  			<div class="grid-item">
  				<p>Most recent PM2.5: <?php echo $pm25 ?>(<?php echo $pmscale ?>)</p>
  			</div>
		</div>
	</body>

<script>
  	var ctx = document.getElementById( "sevenDayTemp" ),
  		example = new Chart(ctx, {
  			type: "line", // chart type
  			data: {
  				labels: <?php echo json_encode($weekday) ?>,
        		datasets: [{
            		label: 'Highest Temperature',
            		fill: false,
            		backgroundColor: 'rgb(255, 99, 132)',
            		borderColor: 'rgb(255, 99, 132)',
            		data: <?php echo json_encode($weeklyHighTemp) ?>,
            		yAxisID: 'y-axis-1'
        		}, {
            		label: 'Lowest Temperature',
            		fill: false,
            		backgroundColor: 'rgb(60, 163, 232)',
            		borderColor: 'rgb(60, 163, 232)',
            		data: <?php echo json_encode($weeklyLowTemp) ?>,
            		yAxisID: 'y-axis-1'
        		}, {
            		label: 'Chance To Rain',
            		fill: false,
            		backgroundColor: 'rgb(255, 204, 97)',
            		borderColor: 'rgb(255, 204, 97)',
            		data: <?php echo json_encode($weeklyChanceToRain) ?>,
            		yAxisID: 'y-axis-2'
        		}]
  			},
  			options: {
  				scales: {
						yAxes: [{
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'left',
							id: 'y-axis-1',
						}, {
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'right',
							id: 'y-axis-2',
							ticks: {
								min: 0,
								max: 1
							},
							// grid line settings
							gridLines: {
								drawOnChartArea: false, // only want the grid lines for one axis to show up
							},
						}],
					}
  			}
  		});
</script>
</html>