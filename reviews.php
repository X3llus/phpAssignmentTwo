<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php
    $title = "Reviews";
    require_once("header.php");
  ?>
  <body>
    <br />
      <a href="./newRestaurant.php">Leave Review</a>
    <table class="table table-hover table-bordered">

      <thead class="thead-dark"><th>Restaurants</th><th>Rating</th><th>Review</th></thead>
      <?php

      // Connect to my database
      $db = new PDO('mysql:host=172.31.22.43;dbname=Braden_W1095701', 'Braden_W1095701', 'P8TwvNsomx');

      // Make sql command to get our data
      $select = "SELECT res.Restaurant as Restaurant, rev.rating as Rating, rev.review as Review, rev.id as id FROM Reviews rev, Restaurants res WHERE rev.restaurant_id = res.id;";
      $cmd = $db->prepare($select);
      $cmd->execute();

      $reviews = $cmd->fetchAll();

      // Build out the table rows with the data
      foreach ($reviews as $review) {
        echo "<tr><td>" . $review["Restaurant"] . "</td><td>" . $review["Rating"] . "</td><td>" . $review["Review"] . "</td>";
        if (!empty($_SESSION['userId']))
        {
          echo "<td><a href=\"./newRestaurant.php?id=" . $review["id"] . "\">Edit</a>";
          echo "<a href=\"./delete.php?id=" . $review["id"] . "\">Delete</a></td>";
        }
        echo "</tr>";
      }

      $db = null;

      ?>
     </table>
  </body>
</html>
