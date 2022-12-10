<div class="ami list-group list-group-flush">
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
    if ($donnees['photo']) {
      $photo = "<img src=" . $donnees['photo'] . " width='100%' height='100%' alt='photo de profil' class=''  />";
    } else {
      $photo = '<img src="img/kaneki.jpeg" width="100%" height="100%" alt="" class=" " />';
    }
  ?>

    <a href="index.php?uid=<?= $idAmi; ?>" class="list-group-item list-group-item-action">
      <div class="card d-inline-block">
        <div class="row g-0">
          <div class="col-md-4">
            <?= $photo; ?>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"> <?= $nom_ami; ?></h5>
              <p class="card-text"><small class="text-muted"><?= $connect; ?></small></p>
            </div>
          </div>
        </div>
      </div>
    </a>
  <?php
  }
  $req->closeCursor();
  ?>
</div>