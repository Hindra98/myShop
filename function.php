
<?php
session_start();

include("config.php");

// Connexion
if (isset($_POST['form']) && ($_POST['form'] == "connexion")) {
  if ( isset($_POST['email']) && !empty($_POST['email']) && !empty($_POST['pass']) ) {
    $mail = htmlentities($_POST['email']);
    $hash_pass = sha1($_POST['pass']);
    $req = $db->prepare("SELECT * FROM profil WHERE email=:email and pass=:pass");
    $req->execute(array('email' => $mail, 'pass' => $hash_pass));
    $donnees = $req->fetch();
    if ($donnees) {
      $_SESSION['id'] = $donnees['id'];
      header('Location: index.php');
    } else {
      header("Location: login.php?err=Email ou pass erroné $mail!");
    }
  } else {
    header("Location: login.php?err=Email ou pass vide!");
  }
}

// Insertion
if (isset($_POST['form']) && ($_POST['form'] == "inscription")) {
  if ((isset($_POST['inscription']) && isset($_POST['email']))) {
    $insertion = $connexion->prepare('INSERT INTO profil VALUES(NULL,:nom,:prenom,:telephone,:mail,:adresse,:genre,:sm)');
    $insertion->bindParam(':nom', $_POST['nom']);
    $insertion->bindParam(':prenom', $_POST['prenom']);
    $insertion->bindParam(':telephone', $_POST['telephone']);
    $insertion->bindParam(':mail', $_POST['mail']);
    $insertion->bindParam(':adresse', $_POST['adresse']);
    $insertion->bindParam(':genre', $_POST['genre']);
    $insertion->bindParam(':sm', $_POST['sm']);
    $verification = $insertion->execute();

    if ($verification) {
      echo "insertion reussie";
    } else {
      echo "echec de l'insertion";
    }
  } else {
    echo "une variable n'est pas declaree et / ou est null";
  }
}

function ajouter($db, $image, $nom, $prix, $description)
{
  $req = $db->prepare("INSERT INTO produits(image,nom,prix,description) VALUES ($image,$nom,$prix,$description)");
  $req->execute(array($image, $nom, $prix, $description));
  $req->closeCursor();
}
function afficher($db)
{
  $req = $db->prepare("SELECT * FROM produits ORDER BY id DESC");
  $req->execute();
  $data = $req->fetchAll(PDO::FETCH_OBJ);
  $req->closeCursor();
  return $data;
}

function supprimer($db, $id)
{
  $req = $db->prepare("DELETE * FROM produits WHERE id=? ");
  $req->execute(array($id));
}
