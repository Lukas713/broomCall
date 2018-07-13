<div class="title-bar" data-responsive-toggle="navigation-bar" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle="navigation-bar"></button>
  <div class="title-bar-title">Menu</div>
</div>

<div class="top-bar" id="navigation-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <?php 
        menuItem($pathAPP, "index.php", "<i class='fas fa-2x fa-home'></i>"); 
        menuItem($pathAPP, "aboutUs.php", "About us");
        menuItem($pathAPP, "contact.php", "Contact");
        if(isset($_SESSION[$appID."operater"])){
          menuItem($pathAPP, "private/controlBoard.php", "Control board");
        }
      ?>

    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <li><a href="login.php">Login</a></li>
    </ul>
  </div>
</div>