<?php


function menuItem($pathAPP, $currentPage, $label){
    ?>
    <li<?php 
    if ($pathAPP . $currentPage == $_SERVER["PHP_SELF"]){
      echo " class=\"active\"";
    }?>><a href="<?php echo $pathAPP . $currentPage; ?>"><?php echo $label;  ?></i></a></li>
    <?php
}

?>


