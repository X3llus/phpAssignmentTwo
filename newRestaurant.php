<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Leave a Review</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300|Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/master.css">
  </head>
  <body>
    <?php require_once ('header.php'); ?>
    <form action="addRestaurant.php" method="post">
      <h1>Leave a Review</h1>
      <fieldset>
        <label for="restaurant">Restaurant</label>
        <select name="restaurant" required>
          <?php

          // Connect to my database
          $db = new PDO('mysql:host=172.31.22.43;dbname=Braden_W1095701', 'Braden_W1095701', 'P8TwvNsomx');

          // Make sql command to get our data
          $select = "SELECT * FROM Restaurants;";
          $cmd = $db->prepare($select);
          $cmd->execute();

          $restaurants = $cmd->fetchAll();

          foreach ($restaurants as $restaurant) {
            echo "<option value=" . $restaurant['id'] . ">" . $restaurant['Restaurant'] . "</option>";
          }

          $db = null;

          ?>
        </select>
      </fieldset>
      <fieldset>
        <label for="star">Star Rating</label>
        <input type="number" name="star" value="1" min="1" max="5" required>
      </fieldset>
      <fieldset>
        <label for="review">Review</label>
        <input type="text" name="review" value="" required>
      </fieldset>
      <input type="submit" name="submit" value="Submit Review">
    </form>
  </body>
</html>
