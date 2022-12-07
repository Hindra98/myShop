
<?php
session_start();
if (!isset($_SESSION['id'])) {
  # code...
  header("Location: login.php");
  exit();
}
include('config.php');
$id = $_SESSION['id'];
$req = $db->prepare("SELECT * FROM profil WHERE id=?");
$req->execute($id);
while ($donnees = $req->fetch()) {
  $nom = $donnees['nom'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Accueil - MyShop</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="icon" href="img/kaneki.jpeg" type="image/jpeg" />
</head>
<body>
  Vous êtes bel et bien connecté <br/>
  <a href="deconnexion.php">Deconnectez Vous</a>
  
</body>
</html>
