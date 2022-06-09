<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "praktikum11";
$koneksi = mysqli_connect($host, $user, $password, $database);

$kasus = mysqli_query($koneksi, "SELECT * FROM tb_covid");
while ($row = mysqli_fetch_array($kasus)) {
	$negara[] = $row['negara'];

	$query = mysqli_query($koneksi, "SELECT sum(kematian_baru) as kematian_baru FROM tb_covid where id_kasus='". $row['id_kasus']."'");
	$row = $query->fetch_array();
	$kematian_baru[] = $row['kematian_baru'];

}

?>

<!DOCTYPE html>
<html>
<head>
	<title> Bar Chart - Kematian Baru </title>
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
					label: 'Grafik Kematian Baru Covid-19',
					data: <?php echo json_encode($kematian_baru); ?>,
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