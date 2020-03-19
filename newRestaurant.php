<!DOCTYPE html>
<html lang="en" dir="ltr">
  <body>
    <?php
      $title = "Leave a Review";
      require_once ('header.php');
    ?>
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
