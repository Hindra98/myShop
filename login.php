
<?php
session_start();
if (isset($_SESSION['id'])) {
  # code...
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Shop</title>
</head>
<body>
  <div class="container">
    <form action="function.php" method="POST" name="connexion">
      <fieldset>
        <legend>My-Shop</legend>
        <input type="email" name="email" class="email" placeholder="Email" required/><br/>
        <input type="password" name="pass" class="password" placeholder="password" required/><br/>
        <input type="submit" value="Se connecter"/>
      </fieldset>
      <p>Vous n'avez pas de compte? <a href="register.php">inscrivez-vous</a></p>
    </form>
  </div>
  
</body>
</html>