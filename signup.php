<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php
    $title = "Sign up";
    require_once("header.php");
  ?>
  <body>
    <form action="verifySignup.php" method="post">
      <fieldset>
        <label for="username">Email: </label>
        <input type="text" name="username" required pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$">
      </fieldset>
      <fieldset>
        <label for="password">Password: </label>
        <input type="password" name="password" required placeholder="Pick a strong password">
      </fieldset>
      <fieldset>
        <label for="password">Confirm Password: </label>
        <input type="password" name="passconf" required placeholder="Re-enter password">
      </fieldset>
      <input type="submit" name="" value="Sign up">
    </form>
  </body>
</html>
