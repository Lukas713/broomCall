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
          <li><a href="<?php echo $pathAPP.'private/department/index.php'?>">Departments</a></li>
          <li><a href="<?php echo $pathAPP.'private/cleanLevel/index.php'?>">Clean Level</a></li>
          <li><a href="<?php echo $pathAPP.'private/service/index.php'?>">Services</a></li>
          <li><a href="<?php echo $pathAPP.'private/squad/index.php'?>">Squads</a></li>
        </ul>
      </li>
        <?php endif; ?>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <?php if(isset($_SESSION[$appID."operater"])):?>
        <li><a href="<?php echo $pathAPP;?>logout.php"><i class='fas fa-2x fa-unlock-alt'></i> Logout</a></li>
      <?php else: ?>
        <li><a href="<?php echo $pathAPP;?>login.php"><i class='fas fa-2x fa-user-lock'></i> Login</a></li>
      <?php endif; ?>
    </ul>
  </div>
</div>