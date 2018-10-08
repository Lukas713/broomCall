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
        
        <link rel="stylesheet" type="text/css" href="https://www.highcharts.com/media/com_demo/css/highslide.css" />
    </head>
    <body>
        <?php include_once "../../template/navigation.php";  ?>
        <br><hr>
        
        <div class="container">
            <h3>Usage and progress chart</h3><hr>
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

                    <div id="container1" style="min-width: 310px; height: 400px; max-width: 600px; margin: auto"></div>

                </div>
                <div class="col col-md-6">

                    <div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: auto"></div>
                
                </div>
            </div><hr>
        </div>


        <?php include_once "../../template/footer.php"; ?>
        <?php include_once "../../template/scripts.php";  ?>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/series-label.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://www.highcharts.com/media/com_demo/js/highslide-full.min.js"></script>
        <script src="https://www.highcharts.com/media/com_demo/js/highslide.config.js" charset="utf-8"></script>


    <script>
    /*
    *
    *takig id from chart options
    *sends data to checkChartId.php
    *calls createHighChart(data)
    *no ret val
     */
        function whichChartParameters(){


            $(".chartID").click(function(){

                chartID = $(this);
                
                $.ajax({
                    type: "POST",
                    url: "jQuery/checkChartID.php",
                    data: "chartID="+chartID.attr("id").split("_")[1],
                    success: function(serverReturn){ 
                        createHighChart(serverReturn);
                        
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "jQuery/checkLineChart.php",
                    data: "chartID="+chartID.attr("id").split("_")[1],
                    success: function(serverReturn){ 
                        createLineChart(serverReturn);
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

            var  serverReturn = JSON.parse(serverReturn);
        
            Highcharts.chart('container1', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Total: ' + serverReturn[1].t
                },
                tooltip: {
                    pointFormat: '<b>{point.z}:</b> {point.y} per unit'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '{point.z}: {point.x} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    colorByPoint: true,
                    data: serverReturn
                }]
            });

        }   

         function createLineChart(serverReturn){

            var  serverReturn = JSON.parse(serverReturn);
            console.log(serverReturn);

            Highcharts.chart('container2', {

                chart: {
                    scrollablePlotArea: {
                        minWidth: 700
                    }
                },

                title: {
                    text: 'Agreements over the last year'
                },

                subtitle: {
                    text: 'Source: BroomCall'
                },

                data: {
                    formatter: function(){

                        return moment(new Date(this.value)).format('YYYY-MM-DDT hh:mm:ss'); // example for moment.js date library

                        //return this.value;
                    },
                },

                xAxis: {
                    min:Date.UTC(2018, 0, 0),
                    max:Date.UTC(2018, 11, 1),
                    allowDecimals: false,
                    type           : 'datetime',
                    tickInterval   : 24 * 3600 * 1000*30, //one day
                    labels         : {
                        rotation : 0
                    },
                },

                yAxis: { 
                    title: {
                        text: 'Total spent  ( € )'
                        },          
                    min: 100,
                    max:600
                },

                legend: {
                    align: 'left',
                    verticalAlign: 'top',
                    borderWidth: 0
                },

                tooltip: {
                    shared: true,
                    crosshairs: true
                },

                series: [{
                    data: serverReturn,
                }]
            });
        }

        
        </script>
    </body>
</html>