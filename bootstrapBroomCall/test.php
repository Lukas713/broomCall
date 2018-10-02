<?php
if(isset($_POST["submit"])){
    print_r($_FILES); 
}


?>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data">
          <div class="form-group">	
             <label for="image"></label>
             <input accept="image" type="file" name="imagesss" type="file">
          </div>
    
        <input type="submit" class="btn btn-primary" name="submit" value="submit">
</form>