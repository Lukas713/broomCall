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
    <div id="googleMap" style="width:100%;height:400px;"></div>
        <script>
            function myMap() {
              var myCenter = new google.maps.LatLng(45.560455,18.680983);
              var mapCanvas = document.getElementById("googleMap");
              var mapOptions = {center: myCenter, zoom: 15};
              var map = new google.maps.Map(mapCanvas, mapOptions);
              var marker = new google.maps.Marker({position:myCenter});
              marker.setMap(map);
            }   



        </script>
    </div> 
  </div>

  <?php include_once "template/scripts.php"; ?>

  <?php include_once "template/footer.php"; ?>
  
  </body>
</html>
