<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <?php

      $username = htmlspecialchars($_POST["username"]);
      $password = $_POST["password"];

      $valid = true;

      if(empty($username)) {
        echo "Email cannot be empty <br />";
        $valid = false;
      }

      if(empty($password)) {
        echo "You must enter a password <br />";
        $valid = false;
      }

      if ($valid) {
        $db = new PDO("mysql:host=172.31.22.43;dbname=Braden_W1095701", "Braden_W1095701", "P8TwvNsomx");

        $select = "SELECT userId, password FROM users WHERE username = :email;";
        $cmd = $db->prepare($select);
        $cmd->bindParam(":email", $username, PDO::PARAM_STR);
        $cmd->execute();

        $user = $cmd->fetch();

        $db = null;

        if (password_verify($password, $user["password"])) {
          session_start();
          $_SESSION["userId"] = $user["userId"];
          $_SESSION["email"] = $username;
          echo "<h2 class=\"alert alert-success\">Signed up!</h2>";
          header("location:reviews.php");
        } else {
          echo "<h2 class=\"danger\">Passwords don't match</h2>";
        }
      }

    ?>
  </body>
</html>
