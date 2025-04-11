<?php
include "Start.php";
include "header.php";
require "ConnexionBD.php";
require "Student.php";
require "Section.php";

$bd=ConnexionBD::getInstance();
$id=$_GET["id"];
$page=$_GET['page'];
if($page=='Student')
{
    $student=new Student($bd);
    echo "<h1>Details de l'etudiant</h1>";
    $student->printStudent($id,1);
}
else
{
    $section=new Section($bd);
    $section->printStudentsOfSection($id);
}
?>
</body>
</html>