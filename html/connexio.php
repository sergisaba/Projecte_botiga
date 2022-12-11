<?php
//Connexio Server
$server = "localhost";
$usr = "root";
$password = "";
$bbdd = "botiga2022";
$connexio = mysqli_connect($server,$usr,$password,$bbdd);

if ($connexio === false) {
  die("ERROR!!".mysqli_connect_error());
}
?>