<?php

/*
* 3 string param
* creates navigation bar links
* no return value
*
*/
function menuItem($pathAPP, $currentPage, $label){
    ?>
    <li<?php 
    if ($pathAPP . $currentPage == $_SERVER["PHP_SELF"]){
      echo " class=\"active\"";
    }?>><a href="<?php echo $pathAPP . $currentPage; ?>"><?php echo $label;  ?></i></a></li>
    <?php
}

/**
 * 
 * 2 params
 * $_POST array and KEY value
 * checks if input is ok
 * return array with string 
 */
function errorHandling(array $post, $key){

  $errors = array();

  if(trim($post[$key])==""){
      $errors = "Your input is empty!";
      return $errors;  
  }else if(strlen($post[$key]) > 50){
      $errors = 'You entered '.strlen($post[$key]).' characters, and maximum is 50.'; 
      return $errors;
  }

  return;
}

?>


