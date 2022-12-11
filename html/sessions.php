<?php
session_start();
include("connexio.php");
$_SESSION["usr"] = $_POST["Lmail"];

$mail = $_POST['Lmail'];
$pass = $_POST['Lcontrasenya'];


$sql = "SELECT COUNT(*) as usr FROM `usuari` WHERE email LIKE '$mail'";
$execute = mysqli_query($connexio, $sql);
$lineas =  mysqli_fetch_array($execute);

if ($lineas['usr'] == 1) {
      $sql = "SELECT * FROM `usuari` WHERE email LIKE '$mail'";
      $execute = mysqli_query($connexio, $sql);
      $lineas =  mysqli_fetch_array($execute);
      if ($lineas['password'] == "admin") {
            header("Location: admin.php");
      }
      elseif ($lineas['password'] == md5($pass)) {
            header("Location: botiga.php");
      } else {
            header("Location: index.php");
      }
} else {
      header("Location: index.php");
}
