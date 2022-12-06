
<?php
include("config.php");
session_start();
if (isset($_POST['email']) && isset($_POST['pass'])) {
  $mail = htmlentities($_POST['email']);
  $hash_pass = sha1($_POST['pass']);
}

?>
