
<?php
session_start();

include("config.php");

// Connexion
if (isset($_POST['form']) && ($_POST['form'] == "connexion")) {

  if (isset($_POST['email']) && !empty($_POST['email']) && !empty($_POST['pass'])) {
    $mail = $_POST['email'];
    $hash_pass = sha1($_POST['pass']);
    $req = $db->prepare('SELECT id FROM profil WHERE email = :email and pass  = :pass');
    $req->execute(array('email' => $mail, 'pass' => $hash_pass));
    $donnees = $req->fetch();
    if ($donnees) {
      $_SESSION['id'] = $donnees['id'];
      if (isset($_POST['souvenir'])) {
        setcookie('id', $donnees['id'], time() + 365 * 24 * 3600, null, null, false, true);
      }
      header('Location: index.php');
    } else {
      header("Location: login.php?err=2");
    }
  } else {
    header("Location: login.php?err=1");
  }
}

// Insertion
if (isset($_POST['form']) && ($_POST['form'] == "inscription")) {

  if (
    empty($_POST['email']) || empty($_POST['pass']) || empty($_POST['passr']) || empty($_POST['nom']) ||
    empty($_POST['tel']) || empty($_POST['adresse']) || empty($_POST['genre']) || empty($_POST['sm'])
  ) {
    header("Location: register.php?err=1");
    exit();
  }
  if (strlen($_POST['pass']) < 5) {
    header("Location: register.php?err=2");
    exit();
  }
  if ($_POST['pass'] != $_POST['passr']) {
    header("Location: register.php?err=3");
    exit();
  }

  $mail = $_POST['email'];
  $req = $db->prepare('SELECT * FROM profil WHERE email = :email');
  $req->execute(array('email' => $mail));
  $donnees = $req->fetch();
  if ($donnees) {
    header("Location: register.php?err=4");
    exit();
  }
  $hash_pass = sha1($_POST['pass']);
  $req = $db->prepare('INSERT INTO profil VALUES(NULL,:nom,:tel,:email,:pass,:adresse,:genre,:sm, NOW(), 0)');
  $req->execute(array(
    'nom' => $_POST['nom'],
    'tel' => $_POST['tel'],
    'email' => $_POST['email'],
    'pass' => $hash_pass,
    'adresse' => $_POST['adresse'],
    'genre' => $_POST['genre'],
    'sm' => $_POST['sm']
  ));
  header('Location: login.php?ok=1');
}


// Envoi de message
if (isset($_POST['form']) && ($_POST['form'] == "message")) {
  $uid = $_POST['uid'];
  $id = $_SESSION['id'];

  if (empty($_POST['textMessage']) && $_FILES['sendFic']['error'] != 0) {
    header("Location: index.php?err=1&uid=$uid");
    exit();
  }

  $message = htmlentities($_POST['textMessage']);
  $lab_fic = null;
  $fichier = null;
  if ($_FILES['sendFic']['error'] == 0) {
    $infosfichier = pathinfo($_FILES['sendFic']['name']);
    $ext = $infosfichier['extension'];
    $nbr = (int) $ext;
    $nbr += 1;
    $lab_fic = basename($_FILES['sendFic']['name']);
    $lab_fic = substr($lab_fic, 0, -$nbr);
    $fichier = $id . $uid . uniqid() . '.' . $ext;
    move_uploaded_file($_FILES['sendFic']['tmp_name'], './uploads/' . $fichier);
  }

  $req = $db->prepare('INSERT INTO messages VALUES(NULL,:id,:userid,:contenu,NOW(),:fichier, :lab_fic, 0)');
  $req->execute(array(
    'id' => $id,
    'userid' => $uid,
    'contenu' => $message,
    'fichier' => $fichier,
    'lab_fic' => $lab_fic
  ));
  header("Location: index.php?uid=$uid");
}
