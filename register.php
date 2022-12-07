
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
  <title>Inscription - MyShop</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="icon" href="img/kaneki.jpeg" type="image/jpeg" />
</head>

<body>
  <div class="form">
    <h1>Inscription - MyShop</h1>
    <form method="post" action="function.php">
      <label class="lab" for="nom">Nom</label>
      <input type="text" id="nom" name="nom" class="inp" placeholder="Votre nom" />
      <br />
      <label class="lab" for="prenom">Prénom</label>
      <input type="text" id="prenom" name="prenom" class="inp" placeholder="Votre prénom" />
      <br />
      <label class="lab" for="telephone">Téléphone</label>
      <input type="tel" id="telephone" name="telephone" class="inp" placeholder="Votre téléphone" />
      <br />
      <label class="lab" for="email">Email</label>
      <input type="email" id="email" name="email" class="inp" placeholder="Votre email" />
      <br />
      <label class="lab" for="adresse">Adresse</label>
      <input type="text" id="adresse" name="adresse" class="inp" placeholder="Votre adresse" />
      <br />
      <label class="lab" for="genre">Genre</label>
      <label for="homme">Homme</label> <input type="radio" id="homme" name="genre" class="genre" value="H" />
      <label for="femme">Femme</label> <input type="radio" id="femme" name="genre" class="genre" value="F" />
      <br />
      <label class="lab">Situation matrimoniale</label>
      <select name="sm">
        <option value="1">Celibataire</option>
        <option value="2">Marie(e)</option>
        <option value="0">Divorce(e)</option>
      </select>
      <br />
      <button type="submit">Enregistrer</button>
      <button type="reset">Annuler</button>
      <p>Vous avez déjà un compte? <a href="login.php">connectez-vous</a></p>
      <?php
        if (isset($_GET['err'])) {
        ?>
        <p class="error"><?= $_GET['err']; ?></p>
        <?php
        }
      ?>
      <input type="hidden" name="form" value="inscription" />
    </form>

  </div>
</body>

</html>
