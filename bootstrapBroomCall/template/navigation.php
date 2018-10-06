<nav class="navbar navbar-expand-lg navbar-light bg-info text-white">
<a class="navbar-brand" href="<?php echo $pathAPP;?>index.php"><img src="<?php echo $pathAPP;?>img/logo.svg" alt="logoBroomCall" style="height:3rem; width:5rem;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php
        menuItem($pathAPP, "index.php", "Home");
        menuItem($pathAPP, "aboutUs.php", "About us");
        menuItem($pathAPP, "contact.php", "Contact");
        if(isset($_SESSION[$appID."admin"])):
          menuItem($pathAPP,"private/controlBoard.php","Control board");   
      ?>
        <li class="nav-item dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Company info</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?php echo $pathAPP.'private/department/index.php'?>">Department</a>
            <a class="dropdown-item" href="<?php echo $pathAPP.'private/squad/index.php'?>">Squad</a>
            <a class="dropdown-item" href="<?php echo $pathAPP.'private/cleanLevel/index.php'?>">Clean level</a>
            <a class="dropdown-item" href="<?php echo $pathAPP.'private/services/index.php'?>">Services</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo $pathAPP.'private/employees/index.php'?>">Employees</a>
            <a class="dropdown-item" href="<?php echo $pathAPP.'private/users/index.php'?>">Users</a>
            <a class="dropdown-item" href="<?php echo $pathAPP.'private/agreements/index.php'?>">Agreements</a>
            <a class="dropdown-item" href="<?php echo $pathAPP.'private/statistics/statistics.php'?>">Statistics</a>
          </div>
        </li>
        <?php 
        elseif(isset($_SESSION[$appID."operater"])):
        menuItem($pathAPP,"private/controlBoard.php","Control board");

        endif;
         ?>
      
</div>
    </ul>
    <ul class="nav justify-content-end">
      <?php if(isset($_SESSION[$appID."operater"]) || isset($_SESSION[$appID."admin"]) || isset($_SESSION[$appID."user"])):?>
        <li><a href="<?php echo $pathAPP;?>logout.php"><i class='fas fa-user-lock'></i> Logout</a></li>
      <?php else: ?>
        <li><a href="<?php echo $pathAPP;?>login.php"><i class='fas fa-unlock-alt'></i> Login</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
