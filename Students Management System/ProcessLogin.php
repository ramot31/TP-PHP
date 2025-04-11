<?php
session_start();
include "ConnexionBD.php";
include "User.php";
$mail=$_POST["mail"];
$pass=$_POST["pass"];
$bd = ConnexionBD::getInstance();
$user=new User($bd);
$user->login($mail,$pass);
?>