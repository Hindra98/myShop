
<?php
session_start();
if (!isset($_SESSION['id'])) {
  # code...
  header("Location: login.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>My-Shop</title>
</head>
<body>
  Vous êtes bel et bien connecté <br/>
  <a href="deconnexion.php">Deconnectez Vous</a>
  
</body>
</html>
