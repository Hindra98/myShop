<div class="list-group lg-alt">
  <?php
  include_once('config.php');
  $idAmi = $_SESSION['id'];
  $req = $db->prepare("SELECT * FROM profil WHERE id!=? ORDER BY nom");
  $req->execute(array($idAmi));
  while ($donnees = $req->fetch()) {
    $connect = "Non connecté";
    $nom_ami = $donnees['nom'];
    $idAmi = $donnees['id'];
    if ($donnees['status']) {
      $connect = "Connecté";
    }
    $photo = ($donnees['photo']) ? $donnees['photo'] : 'profil/defaut.jpeg';
  ?>

    <a class="list-group-item media" href="index.php?uid=<?= $idAmi; ?>">
      <div class="pull-left">
        <img src="<?= $photo; ?>" alt="" class="img-avatar" />
      </div>
      <div class="media-body">
        <span class="list-group-item-heading"> <?= $nom_ami; ?> </span><br/>
        <span class="list-group-item-text c-gray"><?= $connect; ?></span>
      </div>
    </a>
  <?php
  }
  $req->closeCursor();
  ?>
</div>