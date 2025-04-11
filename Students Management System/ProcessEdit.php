<?php
include "Start.php";
include "ConnexionBD.php";
include "Section.php";
include "Student.php";

$page=$_POST["page"]; 

//$session already declared in the Start.php
$session->checkRole($page); //check if an admin is editing otherwise we direct the user to the page he came from
                                //we dont show the actual page to non admins but they can use the add.php link directly so this comes to help

$bd = ConnexionBD::getInstance();
$oldId=$_POST['idToChange'];
$id=$_POST["id"];

if($page=='Student')
{
    $name=$_POST["nom"];
    $image=$_POST["image"];
    $section=$_POST["section"];
    $bday=$_POST["bday"];
    $student=new Student($bd);
    $student->updateStudent($oldId,$id,$name,$image,$section,$bday);
}
else
{
    $desig=$_POST["desig"];
    $desc=$_POST["descri"];
    $section=new Section($bd);
    $section->updateSection($oldId,$id,$desig,$desc);
}



?>