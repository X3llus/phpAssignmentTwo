<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <?php

      $id = $_GET["id"];

      $db = new PDO('mysql:host=172.31.22.43;dbname=Braden_W1095701', 'Braden_W1095701', 'P8TwvNsomx');

      // Make sql command to get our data
      $select = "DELETE FROM Reviews WHERE id = :id;";
      $cmd = $db->prepare($select);

      $cmd->bindParam(':id', $id, PDO::PARAM_INT);

      $cmd->execute();

      header('location:reviews.php');

    ?>
  </body>
</html>
