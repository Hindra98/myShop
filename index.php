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

include_once('config.php');
$id = (int) $_SESSION['id'];
$req = $db->prepare("SELECT * FROM profil WHERE id=?");
$req->execute(array($id));
while ($donnees = $req->fetch()) {
  $nom = $donnees['nom'];
  $telephone = $donnees['telephone'];
  $email = $donnees['email'];
}
$req->closeCursor();

$up_status = $db->prepare("UPDATE profil SET status = '1' WHERE profil.id = ?");
$up_status->execute(array($id));
// UPDATE profil SET status = '1' WHERE profil.id = 1;

$uid = 0;
if (isset($_GET['uid'])) {
  $uid = (int) $_GET['uid'];
  $request = $db->prepare("SELECT * FROM messages WHERE (id_exp=:id AND id_dest=:userid) OR (id_exp=:userid AND id_dest=:id) ORDER BY id");
  $request->execute(array('id' => $id, 'userid' => $uid));
}
$messageError = "";
$err = 0;
if (isset($_GET['err'])) {
  $err = (int) $_GET['err'];
  if ($err == 1) { // Des champs sont vides
    $messageError = "Message vide! <<l'envoi de fichier de plus de 8Mo n'est pas autorisé>>";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Accueil - MyShop</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="icon" href="img/kaneki.jpeg" type="image/jpeg" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Fourth navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="img/kaneki.jpeg" width="40" height="40" alt="" class="rounded-circle" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Notifications</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul><span class="navbar-text me-2 mt-xs-3"> <?= $nom; ?> </span>
        <form role="search" class="ms-2 mt-xs-3">
          <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        </form>
        <a class="btn btn-outline-danger my-2 mt-xs-3 ms-4" href="deconnexion.php">Déconnexion</a>
      </div>
    </div>
  </nav><br />

  <div class="contain">
    <aside class="amis me-1">
      <?php include_once('inc/amis.php') ?>
    </aside>
    <div class="messages">
      <?php
      if ($uid == 0) {
      ?>
        <p class="lead h2 display-6 text-black-50 text-center my-5 mx-5">
          Choisissez un ami sur le menu gauche pour commencer à tchatter.
        </p>
        <?php
      } else {
        $cpt = 0;
        while ($message = $request->fetch()) {
          $contenu = $message['contenu'];
          $date_envoi = $message['date_envoi'];
          $fichier = $message['fichier'];
          if ($message['id_exp'] == $id) {
            echo messEnvoi($contenu, $date_envoi); 
          }
          if ($message['id_exp'] == $uid) {
            echo messRecu($contenu, $date_envoi);
          }
          $cpt += 1;
        }
        if ($cpt == 0) {
        ?>
          <p class="lead h2 display-6 text-black-50 text-center my-5 mx-5">
            Aucun message pour le moment..
          </p>
        <?php
        }
        ?>
        <form class="input-group mt-4 mb-2 w-75 mx-auto" method="POST" action="function.php" enctype="multipart/form-data">
          <input type="file" class="input-group-append form-control" name="sendFic" />
          <textarea class="form-control" aria-label="With textarea" name="textMessage"></textarea>
          <button class="input-group-append btn btn-info" type="submit"> Send </button>
          <input type="hidden" name="form" value="message" />
          <input type="hidden" name="uid" value=<?= $uid; ?> />
        </form>

        <?php
        if ($err != 0) {
        ?>
          <p class="error"><?= $messageError ?></p>
        <?php } ?>
      <?php
      }
      ?>
    </div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>