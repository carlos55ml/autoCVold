<!DOCTYPE html>
<html lang="en">
<?php 
  $title = "Inicio";
  $mustLogin = true;

  include_once __DIR__ . '/modules/head.php';
?>
<body>
  <?php
  ?>
  <h1>AutoCV app</h1>
  <?php
  echo "<b>Tus datos:</b> ";
  print_r($userObj);
  ?>
  <form action="/app/userHandler.php" method="post">
    <input type="hidden" name="action" value="logout">
    <input type="submit" value="Cerrar sesion">
  </form>
</body>
</html>