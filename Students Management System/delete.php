<?php
include "Start.php";
include "ConnexionBD.php";
include "User.php";

$page=$_GET['page'];

//$session is declared in Start.php
$session->checkRole($page);   //check if an admin is deleting otherwise we direct the user to the page he came from
                            //we dont show the actual page to non admins but they can use the add.php link directly so this comes to help
$bd = ConnexionBD::getInstance();
$user = new User($bd);

if($page=='Student') //based on what page you came from we decide we delete a student or a section
{
    $user->deleteStudent($_GET['id']);
    header('Location:ListeEtudiants.php');
    exit;
}
else
{
    $user->deleteSection($_GET['id']);
    header('Location:ListeSections.php');
    exit;
}
?>