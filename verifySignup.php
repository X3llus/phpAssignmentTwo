<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <?php

      $username = htmlspecialchars($_POST["username"]);
      $password = $_POST["password"];
      $passconf = $_POST["passconf"];

      $db = new PDO('mysql:host=172.31.22.43;dbname=Braden_W1095701', 'Braden_W1095701', 'P8TwvNsomx');

      // Make sql command to get our data
      $select = "SELECT username FROM users;";
      $cmd = $db->prepare($select);
      $cmd->execute();

      $usernames = $cmd->fetchAll();
      $userArray = [];

      $db = null;

      foreach ($usernames as $user) {
        array_push($userArray, $user["username"]);
      }

      $valid = true;

      if(empty($usernames)) {
        echo "Email cannot be empty <br />";
        $valid = false;
      }

      if (in_array($username, $userArray)) {
        echo "Username is taken <br />";
        $valid = false;
      }

      if(empty($password)) {
        echo "You must enter a password <br />";
        $valid = false;
      }

      if ($password != $passconf) {
        echo "Passwords must match <br />";
        $valid = false;
      }

      if ($valid) {
        $db = new PDO('mysql:host=172.31.22.43;dbname=Braden_W1095701', 'Braden_W1095701', 'P8TwvNsomx');

        $insert = "INSERT INTO users (username, password) VALUES (:username, :password);";
        $cmd = $db->prepare($insert);

        $cmd->bindParam(':username', $username, PDO::PARAM_STR);
        $cmd->bindParam(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);

        $cmd->execute();

        // Get and store userId
        $select = "SELECT userId FROM users WHERE username == :username;";
        $cmd = $db->prepare($insert);

        $cmd->bindParam(':username', $username, PDO::PARAM_STR);

        $cmd->execute();
        $users = $cmd->fetch();

        session_start();
        $_SESSION["userId"] = $users["userId"];

        $db = null;

        echo '<h2 class="alert alert-success">Signed up!</h2>';
        header('location:reviews.php');
      }

    ?>
  </body>
</html>
