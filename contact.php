<?php include_once "config.php"; ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "template/head.php"; ?>
    <style>
      #map{
        background-color: grey; 
      }
    </style>
  </head>
  <body>

  <?php include_once "template/navigation.php"; ?>  

  <div class="grid-container">
  <h3>Map</h3><hr>
    <div class="grid-x grid-margin-x">
      <div id="map">
        <script>
            function initMap(){
              //location
              var uluru = {lat: -25.344, lng: 131.036};
              var map = new google.maps.Map(
                        document.getElementById('map'), {zoom: 4, center: uluru});
              var marker = new google.maps.Marker({position: uluru, map: map});
            }
        </script>
      </div>
    </div> 
  </div>

  <?php include_once "template/scripts.php"; ?>

  <?php include_once "template/footer.php"; ?>
  
  </body>
</html>
