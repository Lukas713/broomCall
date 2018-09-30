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
                            <input type="email" class="form-control" id="email" autocomplete="on" placeholder="admin@admin.com" name="email">
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
                                <a class="reg" href="register.php" data-toggle="modal" data-target="#exampleModal"><h5>Dont have account?</h5></a>
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
        <?php include_once "registration.php";  ?>
        <?php include_once "template/footer.php"; ?>
        <?php include_once "template/scripts.php"; ?>
        <script>
            function displayPassword() {
                var x = document.getElementById("registerPassword");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
        <script>
            function catchRegistration(){
                var array = new Array(); 

                $("#submitRegistration").click(function(){
                    
                    array.push($("#registerFirstName").val());   
                    array.push($("#registerLastName").val()); 
                    array.push($("#registerEmail").val());
                    array.push($("#registerPassword").val());
                    array.push($("#registerPhoneNumber").val());
                    array.push($("#submitRegistration").val());

                    $.ajax({
                        type: "POST",
                        url: "checkRegistration.php",
                        data: "firstName="+array[0]+"&lastName="+array[1]+
                              "&email="+array[2]+"&password="+array[3]+
                              "&phoneNumber="+array[4]+"&submit="+array[5],
                        success: function(serverReturn){
                                console.log(serverReturn);    
                        }
                    });
                
                });
            }
            catchRegistration(); 
        </script>
    </body>
</html>