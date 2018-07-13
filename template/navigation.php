<div class="title-bar" data-responsive-toggle="navigation-bar" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle="navigation-bar"></button>
  <div class="title-bar-title">Menu</div>
</div>

<div class="top-bar" id="navigation-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <?php 
        menuItem($pathAPP, "index.php", "<i class='fas fa-2x fa-home'></i>"); 
        menuItem($pathAPP, "aboutUs.php", "<i class='fas fa-2x fa-copy'></i> About us");
        menuItem($pathAPP, "contact.php", "<i class='fas fa-2x fa-address-book'></i> Contact");

        if(isset($_SESSION[$appID."operater"])):
          menuItem($pathAPP, "private/controlBoard.php", "<i class='fas fa-2x fa-laptop'></i>Control board"); 
      ?> 
      <li>
        <a href="#"><i class="fas fa-2x fa-archive"></i> Information list</a>
        <ul class="menu vertical">
          <li><a href="#">Departments</a></li>
          <li><a href="#">Squads</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Clean level</a></li>
        </ul>
      </li>
        <?php endif; ?>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <?php
        if(isset($_SESSION[$appID."operater"])){

          echo "<li><a href='$pathAPP/logout.php'><i class='fas fa-2x fa-unlock-alt'></i> Logout</a></li>";
        } else {
          echo "<li><a href='$pathAPP/login.php'><i class='fas fa-2x fa-user-lock'></i> Login</a></li>";
        }
      ?>
    </ul>
  </div>
</div>