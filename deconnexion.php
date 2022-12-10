
<?php
session_start();
include('config.php');
$up_status = $db->prepare("UPDATE profil SET status = '0' WHERE profil.id = ?");
$up_status->execute(array($_SESSION['id']));
setcookie('id', '', time() - 365 * 24 * 3600, null, null, false, true);
session_destroy();
header("Location: login.php");
exit();
?>