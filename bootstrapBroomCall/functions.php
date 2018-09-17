<?php

/*
* 3 string param
* creates navigation bar links
* no return value
*
*/
function menuItem($pathAPP, $currentPage, $label){
     ?>

    <li <?php 
    if ($pathAPP . $currentPage == $_SERVER["PHP_SELF"]){
        echo " class=\"active\"";
      }
    ?>> <a href="<?php echo $pathAPP . $currentPage; ?>"><?php echo $label;  ?></i></a></li>
    <?php 
}


/**
 * 
 * 2 params
 * $_POST array and KEY value
 * checks if input is ok
 * no return value 
 */
function inputErrorHandling(array $post, $key){

    if($post[$key] == ""){
        return "Input is empty!"; 
    } else if(strlen($post[$key]) > 50){
        return 'You entered '.strlen($post[$key]).' character, maximum is 50.';
    }
      
}

function dateErrorHandling(array $post, $key){

    if(!empty($post[$key])){
        $dateTime = DateTime::createFromFormat('Y-m-d', $post[$key]);
       
        if(!$dateTime){
          return "Date format is not correct, please enter dd.MM.yyyy. (e.g. for today " . date("d.m.Y.") . ")";
        }else {
            return 0; 
        }

      }else {
        return "Service date is not entered."; 
      }

      
      
}







?>


