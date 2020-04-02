<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <?php

    require_once("auth.php");

    $restaurant = $_POST["restaurant"];
    $rating = $_POST["star"];
    $review = htmlspecialchars($_POST["review"]);
    $photo = $_FILES["photo"];
    $photoName = null;

    // Connect to my database
    $db = new PDO("mysql:host=172.31.22.43;dbname=Braden_W1095701", "Braden_W1095701", "P8TwvNsomx");

    // Make sql command to get our data
    $select = "SELECT id FROM Restaurants;";
    $cmd = $db->prepare($select);
    $cmd->execute();

    $restaurants = $cmd->fetchAll();
    $resArray = [];

    $db = null;

    foreach ($restaurants as $res) {
      array_push($resArray, $res["id"]);
    }

    $valid = true;

    if(empty($restaurant)) {
      echo "You must select a restaurant <br />";
      $valid = false;
    } else if (!in_array($restaurant, $resArray)) {
      echo "Restaurant not in list <br />";
      $valid = false;
    }

    if(empty($rating)) {
      echo "You must give a star value <br />";
      $valid = false;
    } else if (!($rating >= 1 && $rating <= 5)) {
      echo "The rating must be between 1 and 5 stars <br />";
      $valid = false;
    }

    if(empty($review)) {
      echo "You must leave a review <br />";
      $valid = false;
    }

    if (!empty($photo['tmp_name'])) {
    $photoName = $photo['name'];
    $tmp_name = $photo['tmp_name'];
    $type = mime_content_type($tmp_name);

    if ($type != 'image/*') {
        echo 'File must be an image';
        $ok = false;
    }

    $photoName = session_id() . '-' . $photoName;
    move_uploaded_file($tmp_name, "./uploadedImages/$photoName");
}

      if ($valid) {
        $db = new PDO("mysql:host=172.31.22.43;dbname=Braden_W1095701", "Braden_W1095701", "P8TwvNsomx");

        if (empty($_POST["id"])) {
          $insert = "INSERT INTO Reviews (restaurant_id, rating, review, photoName) VALUES (:restaurant, :rating, :review , :photoName);";
          $cmd = $db->prepare($insert);
        } else {
          $update = "UPDATE Reviews SET restaurant_id = :restaurant, rating = :rating, review = :review WHERE id = :id;";
          $cmd = $db->prepare($update);
          $cmd->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
        }

        $cmd->bindParam(":restaurant", $restaurant, PDO::PARAM_INT);
        $cmd->bindParam(":rating", $rating, PDO::PARAM_INT);
        $cmd->bindParam(":review", $review, PDO::PARAM_STR);
        $cmd->bindParam(":photoName", $photoName, PDO::PARAM_STR, 100);
        $cmd->execute();

        $db = null;

        echo "<h2 class=\"alert alert-success\">Review Posted</h2>";
        // header("location:reviews.php");
      }

    ?>
  </body>
</html>
