<?php

/*
*   @parameters
*   $pathAPP = root
*   $currentPage = page that will be active 
*   $label = name of <a> 
*   
*   enters in <li> tag and asks if this page is currently userd, if it is currently opened
*   add 'active' class 
*/
function activePage($pathAPP, $currentPage, $label){
    ?>
        <li<?php 
        if ($pathAPP . $currentPage == $_SERVER["PHP_SELF"]){
          echo " class=\"active\"";
        }
        ?>><a href="<?php echo $pathAPP . $currentPage; ?>"><?php echo $label;  ?></i></a></li>
        <?php
}

?>