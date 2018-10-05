<?php
include_once "../config.php";
if(!isset($_SESSION[$appID."admin"])){
  header('location:'.$pathAPP.'logout.php');
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once "../template/head.php";  ?>
    </head>
    <body>
        <?php include_once "../template/navigation.php";  ?>
        <br><hr>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col col-md-6">
                    <h3>Pie chart</h3>
                </div>
                <div class="col col-md-6">
                    One of three columns
                </div>
            </div>
        </div>


        <?php include_once "../template/footer.php"; ?>
        <?php include_once "../template/scripts.php";  ?>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script>
            Highcharts.chart('container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Clean level agreements within 2017-2018 years'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false,
                            format: '<b>{point.name}</b>: {point.y}',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Clean levels',
                    colorByPoint: true,
                    data: 
                }]
            });
        </script>
    </body>
</html>