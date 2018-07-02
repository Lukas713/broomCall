<?php include_once "config.php" ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include_once "template/head.php" ?>

    <style>
        .log-in-form {
        border: 1px solid #cacaca;
        padding: 1rem;
        border-radius: 0;
        }
    </style>
  </head>
  <body>
    <div class="grid-container">
      
    <?php include_once "template/header.php" ?>

    <?php include_once "template/navigation.php" ?>

   <div class="grid-x grid-padding-x" style="justify-content: center;">
    <div class="large-4 cell">
        <form class="log-in-form" method="post" action="authorized.php">
            <h4 class="text-center">Log in with your email account</h4>
            <label for="loginEmail">Email
                <input type="email" id="loginEmail" name="email" placeholder="somebody@example.com">
            </label>
            <label for="loginPassword">Password
                <input type="password" id="loginPassword" name="password" autocomplete="new-password" placeholder="Password">
            </label>
            <p><input type="submit" name="loginSubmit" class="button expanded" value="Log in"></input></p>
            <p class="text-center"><a href="#">Forgot your password?</a></p>
        </form>
    </div>
  </div>




    <?php include_once "template/footer.php" ?>

    <?php include_once "template/skripts.php" ?>
  </body>
</html>
