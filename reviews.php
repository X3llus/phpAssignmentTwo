<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Restaurant Review</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300|Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/master.css">
  </head>
  <body>

    <?php require_once ('header.php'); ?>

    <table class="table table-striped table-hover">
      <thead><th>Restaurants</th><th>Rating</th><th>Review</th></thead>
      <?php

      // Connect to my database
      $db = new PDO('mysql:host=172.31.22.43;dbname=Braden_W1095701', 'Braden_W1095701', 'P8TwvNsomx');

      // Make sql command to get our data
      $select = "SELECT res.Restaurant as Restaurant, rev.rating as Rating, rev.review as Review FROM Reviews rev, Restaurants res WHERE rev.restaurant_id = res.id;";
      $cmd = $db->prepare($select);
      $cmd->execute();

      $reviews = $cmd->fetchAll();

      // Build out the table rows with the data
      foreach ($reviews as $review) {
        echo "<tr><td>" . $review["Restaurant"] . "</td><td>" . $review["Rating"] . "</td><td>" . $review["Review"] . "</td></tr>";
      }

      $db = null;

      ?>
     </table>
  </body>
</html>
