<?php
session_start();
if (isset($_SESSION['id'])) {
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
  if ($err == 2) { // Mauvaise longueur du mot de passe
    $message = "Le mot de passe doit contenir au moins cinq caractères";
  }
  if ($err == 3) { // Mots de passe differents
    $message = "Les mots de passe ne sont pas identiques";
  }
  if ($err == 4) { // Email existant dans la base de donnée
    $message = "Cette adresse mail existe dans notre base de donnée<br/>Connectez vous avec cette adresse email";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Inscription - MyShop</title>
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
      <h1>Inscription - MyShop</h1>
      <form class="login-form" method="POST" action="function.php">
        <div class="groupe">
          <div class="group">
            <label for="email" class="label">Email</label>
            <input id="email" name="email" type="email" class="input" placeholder="Votre adresse" required />
          </div>
          <div class="group">
            <label for="nom" class="label">Nom</label>
            <input id="nom" name="nom" type="text" class="input" placeholder="Votre nom" required />
          </div>
        </div>
        <div class="groupe">
          <div class="group">
            <label for="pass" class="label">Mot de passe</label>
            <input id="pass" name="pass" type="password" class="input" placeholder="Votre mot de passe" required />
          </div>
          <div class="group">
            <label for="passr" class="label">Repéter mot de passe</label>
            <input id="passr" name="passr" type="password" class="input" placeholder="Répéter mot de passe" required />
          </div>
        </div>
        <div class="groupe">
          <div class="group">
            <label for="tel" class="label">Téléphone</label>
            <input id="tel" name="tel" type="tel" class="input" placeholder="Votre téléphone" required />
          </div>
          <div class="group">
            <label for="adresse" class="label">Adresse</label>
            <input id="adresse" name="adresse" type="adresse" class="input" placeholder="Votre adresse" required />
          </div>
        </div>
        <div class="groupe">
          <div class="group">
            <label class="label">Genre</label>
            <div class="genre lab">
              <label for="homme">Homme <input type="radio" id="homme" name="genre" value="Homme" /></label>
              <label for="femme">Femme <input type="radio" id="femme" name="genre" value="Femme" /></label>
            </div>
          </div>
          <div class="group">
            <label class="label" for="sm">Situation matrimoniale</label>
            <select name="sm" id="sm" required>
              <option value="Célibataire">Célibataire</option>
              <option value="Marié(e)">Marié(e)</option>
              <option value="Divorcé(e)">Divorcé(e)</option>
            </select>
          </div>
        </div>
        <div class="group">
          <input type="submit" class="button" value="S'inscrire" />
        </div>
        <div class="hr"></div>
        <div class="foot-lnk">
          <p>Vous avez déjà un compte? <a href="login.php">Connectez-vous</a></p>
        </div>
        <?php
        if ($err != 0) {
        ?>
          <p class="error"><?= $message ?></p>
        <?php } ?>
        <input type="hidden" name="form" value="inscription" />
      </form>
    </div>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>