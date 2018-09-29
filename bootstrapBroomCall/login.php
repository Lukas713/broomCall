<?php include_once "config.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once "template/head.php"; ?>
        <style>
            .reg {
                color: black;
            }
        </style>
    </head>

    <body>
        <?php include_once "template/navigation.php"; ?>
        <br>
        <div class="grid-container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-4">
                    <h3>Login</h3> <hr>
                    <form action="authorization.php" method="post">
                        <div class="form-group">
                            <label for="email">Enter email</label>
                            <input type="email" class="form-control" id="email"  placeholder="admin@admin.com" name="email">
                            <small id="emailHelp" class="form-text text-muted">Dont share your privacy informations.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Enter password</label>
                            <input type="password" class="form-control" id="password" placeholder="a" autocomplete="new-password" name="password">
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                            </div>
                            <div class="col">
                                <a class="reg" href="register.php"><h5>Dont have account?</h5></a>
                            </div>
                            <hr>
                        </div>
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
                <div>
            </div>
        </div>
        <?php include_once "template/scripts.php"; ?>

        <?php include_once "template/footer.php"; ?>
    </body>
</html>