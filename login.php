<?php
session_start();

if (isset($_COOKIE['id'])) {
  $_SESSION['id'] = $_COOKIE['id'];
}

if (isset($_SESSION['id'])) {
  # code...
  header("Location: index.php");
  exit();
}

$message = "";
$err = 0;
if (isset($_GET['err'])) {
  $err = (int) $_GET['err'];
  if ($err == 1) { // Des champs sont vides
    $message = "Vous devez remplir tous les champs!";
  }
  if ($err == 2) { // Des champs sont érronés
    $message = "L'email ou le mot de passe est érroné";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Connexion - MyShop</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="icon" href="img/kaneki.jpeg" type="image/jpeg" />
  <style>
    body {
      color: #6a6f8c;
      font: 600 16px/18px "Open Sans", sans-serif;
    }
  </style>
</head>

<body>
  <div class="login-wrap">
    <div class="login-html">
      <h1>Connexion - MyShop</h1><br />
      <form class="login-form" method="POST" action="function.php">
        <div class="sign-in-htm">
          <div class="group">
            <label for="user" class="label">Email</label>
            <input id="user" name="email" type="text" class="input" placeholder="Votre email" />
          </div><br /><br />
          <div class="group">
            <label for="pass" class="label">Mot de passe</label>
            <input id="pass" name="pass" type="password" class="input" placeholder="Votre pass" data-type="password" />
          </div><br /><br />
          <div class="group lab">
            <input id="check" type="checkbox" class="check" name="souvenir" checked>
            <label for="check" class="label"><span class="icon"></span> Se souvenir de moi</label>
          </div><br />
          <div class="group">
            <input type="submit" class="button" value="Se connecter">
          </div>
          <div class="hr"></div>
          <div class="foot-lnk">
            <a href="#forgot">Mot de passe oublié</a><br />
            <p>Vous n'avez pas de compte? <a href="register.php">Inscrivez-vous</a></p>
          </div>
        </div>
        <?php
        if ($err != 0) {
        ?>
          <p class="error"><?= $message ?></p>
        <?php }
        if (isset($_GET['ok'])) {
        ?>
          <p class="ok"><?= "Inscription reussi!<br/>Connectez vous maintenant" ?></p>
        <?php } ?>
        <input type="hidden" name="form" value="connexion" />
      </form>
    </div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>