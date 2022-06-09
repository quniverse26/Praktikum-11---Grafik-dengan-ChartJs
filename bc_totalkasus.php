<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "praktikum11";
$koneksi = mysqli_connect($host, $user, $password, $database);

$kasus = mysqli_query($koneksi, "SELECT * FROM tb_covid");
while ($row = mysqli_fetch_array($kasus)) {
	$negara[] = $row['negara'];

	$query = mysqli_query($koneksi, "SELECT sum(total_kasus) as total_kasus FROM tb_covid where id_kasus='". $row['id_kasus']."'");
	$row = $query->fetch_array();
	$total_kasus[] = $row['total_kasus'];

}

?>

<!DOCTYPE html>
<html>
<head>
	<title> Bar Chart - Total Kasus </title>
	<script type="text/javascript" src="Chart.js"></script>
</head>

<body>

	<div style="width: 800px; height: 800px">
		<canvas id="myChart"></canvas>
	</div>

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($negara); ?>, datasets: [{
					label: 'Grafik Total Kasus Covid-19',
					data: <?php echo json_encode($total_kasus); ?>,
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255, 99, 132, 1',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>