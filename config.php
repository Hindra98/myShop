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


function messEnvoi($contenu, $date_envoi, $profil, $nom_fic = null, $fichier = null)
{
  $af_fic = ($fichier) ? aff_fic($fichier, $nom_fic) : '';
  $final = '
  <div class="message-feed media">
    <div class="pull-left">
      <img src="' . $profil . '" alt="" class="img-avatar">
    </div>
    <div class="media-body ms-2">
      <div class="mf-content">' . $af_fic . '
        ' . $contenu . '
      </div>
      <small class="mf-date"><i class="fa fa-clock-o"></i> &nbsp;' . $date_envoi . '</small>
    </div>
  </div>';
  return $final;
}


function messRecu($contenu, $date_envoi, $profil, $nom_fic, $fichier)
{
  $af_fic = ($fichier) ? aff_fic($fichier, $nom_fic) : '';
  $final = '
  <div class="message-feed right">
    <div class="pull-right">
      <img src="' . $profil . '" alt="" class="img-avatar">
    </div>
    <div class="media-body">
      <div class="mf-content">' . $af_fic . '
        ' . $contenu . '
      </div>
      <small class="mf-date"><i class="fa fa-clock-o"></i> &nbsp;' . $date_envoi . '</small>
    </div>
  </div>';
  return $final;
}

function aff_fic($fichier, $nom_fic)
{
  $affiche = '';
  if (fic_aud($fichier))
    $affiche = '<audio controls src="uploads/' . $fichier . '" preload="auto">
        <a href="uploads/' . $fichier . '">' . $nom_fic . '</a></audio>';
  elseif (fic_img($fichier))
    $affiche = '<a href="uploads/' . $fichier . '">
    <img src="uploads/' . $fichier . '" alt="' . $nom_fic . '"/></a>';
  elseif (fic_vid($fichier))
    $affiche = '<video controls src="uploads/' . $fichier . '" preload="auto">
        <a href="uploads/' . $fichier . '">' . $nom_fic . '</a></video>';
  else $affiche = '<a href="uploads/' . $fichier . '">' . $nom_fic . '</a>';
  return '<p>'.$affiche.'</p>';
}
function fic_img($fichier)
{
  $fic_in = strrev($fichier);
  $coupe = explode('.', $fic_in);
  $ext = strtolower($coupe[0]);
  $ext = strrev($ext);
  $ext_auth = array('jpg', 'jpeg', 'png', 'gif', 'svg', 'webp');
  if (in_array($ext, $ext_auth))
    return true;
  else
    return false;
}

function fic_aud($fichier)
{
  $fic_in = strrev($fichier);
  $coupe = explode('.', $fic_in);
  $ext = strtolower($coupe[0]);
  $ext = strrev($ext);
  $ext_auth = array('mp3', 'wav', 'ogg', 'wma', 'mid');
  if (in_array($ext, $ext_auth))
    return true;
  else
    return false;
}

function fic_vid($fichier)
{
  $fic_in = strrev($fichier);
  $coupe = explode('.', $fic_in);
  $ext = strtolower($coupe[0]);
  $ext = strrev($ext);
  $ext_auth = array('mp4', 'avi', 'mov', 'mpg', 'webm', 'mpeg', 'mkv', 'flv', 'm4v', 'wmv');
  if (in_array($ext, $ext_auth))
    return true;
  else
    return false;
}

function data_user($id, $db)
{
  $req = $db->prepare("SELECT * FROM profil WHERE id=?");
  $req->execute(array($id));
  return $req;
}
