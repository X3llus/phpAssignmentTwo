<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300|Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/header.css">
  </head>
  <body>
    <header>
      <h1>Restaurant Reviews</h1>
      <nav>
        <a href="./">Home</a>
        <a href="./reviews.php">Reviews</a>

        <?php
          if (session_status() == PHP_SESSION_NONE) {
            session_start();
          }
          if (!empty($_SESSION["userId"])) {
            echo "<div>" . $_SESSION["email"] . "</div>";
            echo "<a href=\"./logout.php\">Log out</a>";
          } else {
            echo "<a href=\"./signup.php\">Sign up</a>";
            echo "<a href=\"./login.php\">Log in</a>";
          }

        ?>
      </nav>
    </header>
  </body>
</html>
