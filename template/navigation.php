<div class="title-bar" data-responsive-toggle="nav" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle="nav"></button>
  <div class="title-bar-title"><?php echo $nameAPP; ?></div>
</div>

<div class="top-bar" id="nav">
  <div class="top-bar-left">
    <ul class="menu">
      
      <?php
      activePage($pathAPP,"index.php","<i class=\"fas fa-home fa-1x \" style=\"color: #2a6182;\"></i>");
      if(isset($_SESSION["operator"])):
        activePage($pathAPP, "private/crudBoard.php", "Dashboard");
      endif;
        activePage($pathAPP, "aboutUs.php", "About us");
        activePage($pathAPP, "contact.php", "Contact");
      ?>
      
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
    <?php if(isset($_SESSION["operator"])): ?>
      <li style="width:100%; text-align: center;"><a href="<?php echo $pathAPP; ?>logout.php">Logout</a></li> 
    <?php else: ?>
      <li style="width:100%; text-align: center;  "><a href="<?php echo $pathAPP; ?>login.php">Login</a></li>
    <?php endif ?>
    </ul>
  </div>
</div>