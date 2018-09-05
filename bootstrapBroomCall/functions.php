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
 * no return value 
 */
function errorHandling(array $post, $key){

    if(empty($post)){
        echo '<div class="form-group">
                <label for='.$key.'>'.$key.'</label>
                <input type="text" id='.$key.' name='.$key.' class="form-control">
              </div>' ;
        return;
    }else if(strlen($post[$key]) > 50){
        echo '<div class="form-group">
                <label for='.$key.'>'.$key.'</label>
                <input type="text" id='.$key.' name='.$key.' class="form-control is-invalid">
                <div class="invalid-feedback"> "You entered '.strlen($post[$key]).' characters, maximum is 50." </div>
              </div>' ;
        return;
    }else if($post[$key] == ""){
        echo '<div class="form-group">
                <label for='.$key.'>'.$key.'</label>
                <input type="text" id='.$key.' name='.$key.' class="form-control is-invalid">
                <div class="invalid-feedback"> "Your input is empty!" </div>
              </div>' ;
    }else {
        echo '<div class="form-group">
                <label for='.$key.'>'.$key.'</label>
                <input type="text" id='.$key.' name='.$key.' class="form-control" value='.$post[$key].'>
              </div>' ;
    }
        return;

  
  
   
}

?>


