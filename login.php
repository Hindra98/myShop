<?php
session_start();

if (isset($_COOKIE['id'])) {
  $_SESSION['id'] = $_COOKIE['id'];
}

if (isset($_SESSION['id'])) {
  # code...
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
  if ($err == 2) { // Des champs sont érronés
    $message = "L'email ou le mot de passe est érroné";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Connexion - MyShop</title>
  <!-- <link rel="stylesheet" type="text/css" href="css/style.css" /> -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="icon" href="img/kaneki.jpeg" type="image/jpeg" />
  <style>
    html,
    body {
      height: 100%;
    }

    body {
      display: flex;
      align-items: center;
      background-color: #ccc;
    }

    .form-signin {
      max-width: 410px;
      padding: 15px;
      background-color: #aaa;
      border-radius: 10px;
    }

    .form-signin input[type="email"],
    .form-signin input[type="password"] {
      height: 45px;
      font-size: 1.1em;
    }

    .form-signin input[type="email"] {
      border-radius: 14px 14px 0 0;
    }

    .form-signin input[type="password"] {
      border-radius: 0 0 10px 10px;
    }

    .form-signin label[for="check"] {
      cursor: pointer;
    }
  </style>
</head>

<body>
  <main class="form-signin w-100 m-auto">
    <form method="POST" class="text-center mx-auto pt-2" action="function.php">
      <h1 class="h2 mt-3 mb-5 fw-bold">Connexion - MyShop</h1>
      <div class="my-2">
        <input type="email" name="email" class="form-control px-3 py-2" placeholder="name@example.com" required />
      </div>
      <div class="my-2">
        <input type="password" name="pass" class="form-control px-3 py-2" placeholder="Mot de passe" required />
      </div>
      <div class="checkbox my-3">
        <input id="check" type="checkbox" class="check" name="souvenir" checked>
        <label for="check" class="form-label"> Se souvenir de moi</label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter</button>
      <p class="mt-3"><a href="#forgot" class="link-secondary">Mot de passe oublié</a></p>
      <p class="my-3 text-muted">Vous n'avez pas de compte? <a href="register.php">Inscrivez-vous</a></p>
      <?php
      if ($err != 0) {
      ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= $message ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
      <?php }
      if (isset($_GET['ok'])) {
      ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= "Inscription reussi! Connectez vous maintenant" ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
      <?php } ?>
      <input type="hidden" name="form" value="connexion" />
    </form>
  </main>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>