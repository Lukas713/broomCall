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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <style>
                #help {
                    margin-left: 3rem;
                    color: #999; 
                }

                #help:hover{
                    color: #000; 
                }
            </style>
        
        <link rel="stylesheet" type="text/css" href="https://www.highcharts.com/media/com_demo/css/highslide.css" />
    </head>
    <body>
        <?php include_once "../../template/navigation.php";  ?>
        <br><hr>
        
        <div class="container">
        <h3>Usage and progress chart <a class="helper" id="help" href="#" title="Chose on menu dropdown specific chart"><i class="fas fa-question-circle"></i></a></h3>
        <hr> 
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
            </div><hr>
        </div>


        <?php include_once "../../template/footer.php"; ?>
        <?php include_once "../../template/scripts.php";  ?>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
    <script>
                $(function() {
                $(document).tooltip();
            } );
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
        });  
    }

    whichChartParameters();

        function lineChart(){
            $(document).ready(function(){

                $.ajax({
                    type: "POST",
                    url: "jQuery/checkLineChart.php",
                    success: function(serverReturn){ 
                        createLineChart(serverReturn);
                    }
                });
            });
        }

        lineChart(); 
    

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
                    text: undefined
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
        
        </script>
    </body>
</html>