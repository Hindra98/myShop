<?php
session_start();
if (!isset($_SESSION['id'])) {
  if (!isset($_COOKIE['id'])) {
    header("Location: login.php");
    exit();
  } else {
    $_SESSION['id'] = $_COOKIE['id'];
  }
}

include('config.php');
$id = $_SESSION['id'];
$req = $db->prepare("SELECT * FROM profil WHERE id=?");
$req->execute(array($id));
while ($donnees = $req->fetch()) {
  $nom = $donnees['nom'];
  $telephone = $donnees['telephone'];
  $email = $donnees['email'];
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title><?= $nom; ?> - MyShop</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="icon" href="img/kaneki.jpeg" type="image/jpeg" />
</head>
<body>
  la page de parametres de <?= $nom; ?>
  
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

