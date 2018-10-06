<?php
include_once "../../config.php";
if(!isset($_SESSION[$appID."admin"])){
  header('location:'.$pathAPP.'logout.php');
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once "../../template/head.php";  ?>
    </head>
    <body>
        <?php include_once "../../template/navigation.php";  ?>
        <br><hr>
        
        <div class="container">
            <div class="dropdown show">
                <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item chartID" href="#" id="id_1">Clean levels usage</a>
                    <a class="dropdown-item chartID" href="#" id="id_2">Service usage</a>
                    <a class="dropdown-item chartID" href="#" id="id_3">Squads progress</a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col col-md-6">

                    <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: auto"></div>

                </div>
                <div class="col col-md-6">
                    One of three columns
                </div>
            </div>
        </div>


        <?php include_once "../../template/footer.php"; ?>
        <?php include_once "../../template/scripts.php";  ?>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>

    <script>
    /*
    *
    *takig id from chart options
    *sends data to checkChartId.php
    *calls createHighChart(data)
    *no ret val
     */
        function whichChartParameters() {

            $(".chartID").click(function(){

                chartID = $(this);
                
                $.ajax({
                    type: "POST",
                    url: "checkChartID.php",
                    data: "chartID="+chartID.attr("id").split("_")[1],
                    success: function(serverReturn){
                        serverReturn = JSON.parse(serverReturn);
                        createHighChart(serverReturn);
                    }
                });
            });

        }

        whichChartParameters();

        /*
         *takes json from server
         *creates highshart (plugin)
         *no ret value
         */
        function createHighChart(serverReturn){

            Highcharts.chart('container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Kako da se odma učita chart i kako promjenit ovo "slice"?!'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b> {point.o}: {point.y}</b>'
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
                    name: "help!",
                    colorByPoint: true,
                    data: serverReturn
                }]
            });


        }   
        </script>
    </body>
</html>