<?php include_once "config.php"; ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "template/head.php"; ?>
    <style>
        .log-in-form {
            border: 1px solid #cacaca;
            padding: 1rem;
            }

        .grid-x {
            justify-content: center; 
        }    
    </style>
  </head>
  <body>

    <?php include_once "template/navigation.php"; ?>  

<div class="grid-x">
  <div class="cell medium-4 large-3">
    <form class="log-in-form" method="post" action="authorization.php">
            <h4 class="text-center">Log in</h4>
            <label>Email
                <input type="text" id="username" name="username" placeholder="admin">
            </label>
            <label>Password
                <input type="password" id="password" name="password" autocomplete="new-password" placeholder="a">
            </label>
            <br>
            <input type="submit" name="submit" class="button expanded" value="Log in"></input>
            <p class="text-center"><a href="#">Forgot your password?</a></p>
        </form>
        
        <?php
            //check if there is feedback msg
            if(isset($_GET['msg'])){
                
                switch($_GET["msg"]){
                        case "1":
                        echo "<br><p style='color:red;' class='text-center'>Please fill all fields</p>";
                        break;

                        case "2":
                        echo "<br><p style='color:red;' class='text-center'>Wrong username/password</p>";
                        break;

                        default:
                        echo "";
                        break;
                }
            }
        ?>
  </div>
</div>

    <?php include_once "template/scripts.php"; ?>

    <?php include_once "template/footer.php"; ?>
  
  </body>
</html>