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
