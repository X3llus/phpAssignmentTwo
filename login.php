<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php
    $title = "Sign up";
    require_once("header.php");
  ?>
  <body>
    <form action="verifyLogin.php" method="post">
      <fieldset>
        <label for="username">Email: </label>
        <input type="text" name="username" maxlength="50" required pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$">
      </fieldset>
      <fieldset>
        <label for="password">Password: </label>
        <input type="password" name="password" maxlength="255" required>
      </fieldset>
      <input type="submit" value="Log in">
    </form>
  </body>
</html>
