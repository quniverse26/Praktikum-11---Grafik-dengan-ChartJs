<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "praktikum11";
$koneksi = mysqli_connect($host, $user, $password, $database);

$kasus = mysqli_query($koneksi, "select * from tb_covid");
while ($row = mysqli_fetch_array($kasus)) 
{
  $negara[] = $row['negara']; 
  $jumlah_sembuh[] = $row['jumlah_sembuh'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title> Line Chart - Jumlah Sembuh </title>
  <script type="text/javascript" src="Chart.js"></script>
</head>
<body>
  <div style="width: 800px;height: 800px">
    <canvas id="myChart"></canvas>
  </div>


  <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?php echo json_encode($negara); ?>,
        datasets: [{
          label: 'Grafik Jumlah Sembuh Covid-19',
          data: <?php echo json_encode($jumlah_sembuh); ?>,
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