<?php
$db_host = "localhost";
$db_name = "myshop";
$db_user = "root";
$db_password = "";

try {
  $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
  $e->getMessage();
}


function messEnvoi($contenu, $date_envoi, $fichier=null) {
  $final = "";
  $final .= "<div class='mess messenvoi px-1 py-1 mt-2 mb-1 mx-2'>";
  $final .= "<p><a href='$fichier'>$fichier</a></p><p>$contenu</p>";
  $final .= "<p class='text-muted lead text-right'>$date_envoi</p><div class='fleche'></div></div>";
  return $final;
}

function messRecu($contenu, $date_envoi, $fichier=null) {
  $final = "";
  $final .= "<div class='mess messrecu px-1 py-1 mt-2 mb-1 me-2'>";
  $final .= "<p><a href='$fichier'>$fichier</a></p><p>$contenu</p>";
  $final .= "<p class='text-muted lead text-right'>$date_envoi</p><div class='fleche'></div></div>";
  return $final;
}

