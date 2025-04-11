<?php
include "Start.php";
include "ConnexionBD.php";
require "Section.php";
require "Student.php";

$page=$_POST["page"];

//$session already declared in the Start.php
$session->checkRole($page); //check if an admin is adding otherwise we direct the user to the page he came from
                            //we dont show the actual page to non admins but they can use the add.php link directly so this comes to help

$bd = ConnexionBD::getInstance();
$id=$_POST["id"];

if($page=='Student')
{
    $name=$_POST["nom"];
    $image=$_POST["image"];
    $section=$_POST["section"];
    $bday=$_POST["bday"];
    $student=new Student($bd);
    $student->addStudent($id,$name,$image,$section,$bday);
}
else
{
    $desig=$_POST["desig"];
    $desc=$_POST["desc"];
    $section=new Section($bd);
    $section->addSection($id,$desig,$desc);
}






?>