<?php

  require_once("auth.php");

  if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $db = new PDO('mysql:host=172.31.22.43;dbname=Braden_W1095701', 'Braden_W1095701', 'P8TwvNsomx');

    // Make sql command to get our data
    $select = "SELECT res.Restaurant as Restaurant, rev.rating as Rating, rev.review as Review FROM Reviews rev, Restaurants res WHERE rev.restaurant_id = res.id AND rev.id = :id;";
    $cmd = $db->prepare($select);

    $cmd->bindParam(':id', $id, PDO::PARAM_INT);

    $cmd->execute();

    $review = $cmd->fetch();
    $res = $review["Restaurant"];
    $rating = $review["Rating"];
    $rev = $review["Review"];

  } else {
    $res = null;
    $rating = null;
    $rev = null;
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <body>
    <?php
      $title = "Leave a Review";
      require_once('header.php');
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
            echo "<option value=" . $restaurant['id'];
            if ($restaurant["Restaurant"] == $res) {
              echo " selected";
            }
            echo ">" . $restaurant['Restaurant'] . "</option>";
          }

          $db = null;

          ?>
        </select>
      </fieldset>
      <fieldset>
        <label for="star">Star Rating</label>
        <input type="number" name="star" <?php echo "value=$rating"; ?> min="1" max="5" required>
      </fieldset>
      <fieldset>
        <label for="review">Review</label>
        <input type="text" name="review" <?php echo "value=\"$rev\""; ?> required>
      </fieldset>

      <?php

        if (!empty($_GET["id"])) {
          echo "<input type=hidden name=id value=$id>";
        }

      ?>
      <input type="submit" name="submit" value="Submit Review">
    </form>
  </body>
</html>
