
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
  <meta charset="UTF-8" />
  <title>Connexion - MyShop</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="icon" href="img/kaneki.jpeg" type="image/jpeg" />
</head>

<body>
  <div class="form">
    <h1>Connexion - MyShop</h1>
    <form method="POST" action="function.php">
      <label class="lab" for="email">Email</label>
      <input type="email" id="email" name="email" class="inp" placeholder="Votre email" />
      <br />
      <label class="lab" for="password">Mot de passe</label>
      <input type="password" id="password" name="pass" class="inp" placeholder="Votre password" />
      <br />
      <button type="submit">Se connecter</button>
      <button type="reset">Annuler</button>
      <p>Vous n'avez pas de compte? <a href="register.php">inscrivez-vous</a></p>
      <?php
        if (isset($_GET['err'])) {
        ?>
        <p class="error"><?= $_GET['err']; ?></p>
        <?php
        }
        echo sha1("vadiny");
      echo "<br/>";
        echo sha1("franck");
      ?>
      <input type="hidden" name="form" value="connexion" />
    </form>
  </div>
</body>

</html>
