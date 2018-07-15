<?php include_once "config.php"; ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "template/head.php"; ?>
    <style>
      .contact {
        margin-left: 1rem; 
      }
    </style>
  </head>
  <body>

  <?php include_once "template/navigation.php"; ?>  

  <div class="grid-container">
    <h3>Map</h3>
      <div class="grid-x">
        <div id="googleMap" style="width:100%;height:400px;"></div>
          <script>
              //funcion for google maps
              function myMap() {
                var myCenter = new google.maps.LatLng(45.560455,18.680983);
                var mapCanvas = document.getElementById("googleMap");
                var mapOptions = {center: myCenter, zoom: 15};
                var map = new google.maps.Map(mapCanvas, mapOptions);
                var marker = new google.maps.Marker({position:myCenter});
                marker.setMap(map);
              }  
          </script>
      </div><hr><br>
      <h4>Contact informations</h4>
    <div class="grid-x">
          <div class="cell" style="width:2rem">
            <i class="fas fa-map-marker-alt" style="color:green"></i>
          </div>
          <div class="cell medium-4 small-4">
            Ulica Lorenza Jegera 5<br>
            31000, Osijek<br>
          </div>
    </div> 
    <br>
    <div class="grid-x">
          <div class="cell" style="width:2rem">
          <i class="fas fa-phone" style="color:green"></i>
          </div>
          <div class="cell medium-4 small-4">
            +385 91 551 7903<br>
            +385 31 551 932<br>
          </div>
    </div>
    <br>
    <div class="grid-x">
          <div class="cell" style="width:2rem">
          <i class="fas fa-envelope" style="color:green"></i>
          </div>
          <div class="cell medium-4 small-4">
            lukas.scharmitzer@gmail.com<br>
          </div> 
    </div>
    <br>
    <div class="grid-x">
          <div class="cell" style="width:2rem">
          <i class="fas fa-globe" style="color:green"></i>
          </div>
          <div class="cell medium-4 small-4">
            www.broomCall.com<br>
          </div>
    </div>
  </div>

  <?php include_once "template/scripts.php"; ?>

  <?php include_once "template/footer.php"; ?>
  
  </body>
</html>
