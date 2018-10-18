<?php 
include_once "config.php"; 
include_once "checkRegistration.php"; 
?>

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
        <?php include_once "registrationModal.php";  ?>
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

        function errorHanding(string){
            if(string == ""){
                return "Input is empty!" ;
            }else if(string.length > 50){
                return "You entered "+string.length+" characters, maximum is 50!"; 
            }

            return ""; 
        }
        /**
        on submiting form
         */
        $("#registrationForm").submit(function( event ) {
            var error = new Array();
            var array = new Array();
            //push inputs in array
            array[0] = $("#registerFirstName").val()
            array[1] = $("#registerLastName").val()
            array[2] = $("#registerEmail").val()
            array[3] = $("#registerPassword").val()
            array[4] = $("#registerPhoneNumber").val()

            /*
            *iterate through array and call function to check errors
             */
            $.each(array, function( index, value ) {
                error[index] = errorHanding(value);
                if(error[index] != ""){
                    event.preventDefault(); //dont close modal
                }
                return true; //close moda, evrything is fine
            }); 
            console.log(error); 
            //if there is errors in array
            var div = new Array();
            var tekst = new Array();
            if(error[0] != ""){ //create invalid class and apend it to cityControl id
                div[0] = document.createElement("div");
                $("#registerFirstName").addClass("is-invalid");
                tekst[0] = document.createTextNode(error[0]);
                div[0].appendChild(tekst[0]);
                div[0].setAttribute("class", "invalid-feedback");
                $("#firstNameControl").append(div[0]);  
            }
            if(error[1] != ""){
                div[1] = document.createElement("div");
                $("#registerLastName").addClass("is-invalid");
                tekst[1] = document.createTextNode(error[1]);
                div[1].appendChild(tekst[1]);
                div[1].setAttribute("class", "invalid-feedback");
                $("#lastNameControl").append(div[1]);
            }
            if(error[2] != ""){
                div[2] = document.createElement("div");
                $("#registerEmail").addClass("is-invalid");
                tekst[2] = document.createTextNode(error[2]);
                div[2].appendChild(tekst[2]);
                div[2].setAttribute("class", "invalid-feedback");
                $("#emailControl").append(div[2]);
            }
            if(error[3] != ""){
                div[3] = document.createElement("div");
                $("#registerPassword").addClass("is-invalid");
                tekst[3] = document.createTextNode(error[3]);
                div[3].appendChild(tekst[3]);
                div[3].setAttribute("class", "invalid-feedback");
                $("#passwordControl").append(div[3]);
            }
            if(error[4] != ""){
                div[4] = document.createElement("div");
                $("#registerPhoneNumber").addClass("is-invalid");
                tekst[4] = document.createTextNode(error[4]);
                div[4].appendChild(tekst[4]);
                div[4].setAttribute("class", "invalid-feedback");
                $("#phoneControl").append(div[3]);
            }

        });
        </script>
    </body>
</html>