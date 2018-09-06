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
function inputError(array $post, $key){

    //if $_POST["add"] is not sent
    if(!isset($post["add"])){

        echo '<div class="form-group">
                <label for='.$key.'>'.$key.'</label>
                <input type="text" id='.$key.' name='.$key.' class="form-control">
            </div>' ;
              return;
    }
    
        if($post[$key] == ""){
            echo '<div class="form-group">
                    <label for='.$key.'>'.$key.'</label>
                    <input type="text" id='.$key.' name='.$key.' class="form-control is-invalid">
                    <div class="invalid-feedback"> Your input is empty! </div>
                  </div>' ;
                  return true;

        }else if(strlen($post[$key]) > 50){
            echo '<div class="form-group">
                        <label for='.$key.'>'.$key.'</label>
                        <input type="text" id='.$key.' name='.$key.' class="form-control is-invalid">
                        <div class="invalid-feedback"> You entered '.strlen($post[$key]).' characters, maximum is 50. </div>
                    </div>' ;
                  return true;
        }else {
            echo '<div class="form-group">
                    <label for='.$key.'>'.$key.'</label>
                    <input type="text" id='.$key.' name='.$key.' class="form-control" value='.$post[$key].'>
                 </div>' ;
          return;
        } 
}

/**
 * 4 params
 * object, array, string, string
 * checks if select option is 0
 * returns true if it is
 */
function selectErrorHandling(array $object, array $post, $key, $name){
   
    if(!isset($post["add"])){
         echo '<label for='.$key.'>'.$key.'</label>
                <select class="form-control" id='.$key.' name='.$key.'>
                    <option value="0">Chose '.$key.'</option>';
                    foreach($object as $row){
                        echo '<option ';
                        if(isset($post[$key]) && $post[$key]==$row->id){
                            echo ' selected="selected" ';
                        }
                    echo 'value='.$row->id.'>'.$row->$name.'</option>';
                    }
                echo '</select>';
                return false; 
    }


    if($post[$key] == "0"){
        echo '<label for='.$key.'>'.$key.'</label>
          <select class="form-control is-invalid" id='.$key.' name='.$key.'>
            <option value="0">Chose '.$key.'</option>';
            foreach($object as $row){
                echo '<option ';
                if(isset($post[$key]) && $post[$key]==$row->id){
                    echo ' selected="selected" ';
                 }
               echo 'value='.$row->id.'>'.$row->$name.'</option>';
            }
        echo "</select>";
        echo '<div class="invalid-feedback">Please select '.$key.'</div>';
        return true; 
    }

    echo '<label for='.$key.'>'.$key.'</label>
          <select class="form-control" id='.$key.' name='.$key.'>
            <option value="0">Chose '.$key.'</option>';
            foreach($object as $row){
                echo '<option ';
                if(isset($post[$key]) && $post[$key]==$row->id){
                    echo ' selected="selected" ';
                 }
               echo 'value='.$row->id.'>'.$row->$name.'</option>';
            }
        echo "</select>";
        return; 
}




?>


