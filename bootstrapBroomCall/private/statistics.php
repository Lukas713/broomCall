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

                    <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: auto"></div>

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
                    text: 'Usage of clean levels, pie chart'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.x} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Clean levels',
                    colorByPoint: true,
                    data: <?php
                        $query = $conn->prepare("select b.levelName as name, count(a.cleanLevel) as y, sum(a.cleanLevel),
                                                (sum(a.cleanLevel) / (select sum(a.cleanLevel) from agreement a))*100 as x 
                                                from cleanlevel b 
                                                inner join agreement a on a.cleanLevel = b.id
                                                group by name
                                                ");
                        $query->execute();
                        $result = $query->fetchAll(PDO::FETCH_OBJ);
                        echo json_encode($result, JSON_NUMERIC_CHECK);
                    ?> 
                }]
            });
        </script>
    </body>
</html>