<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
    require "ConnexionBD.php";
    $bd=ConnexionBD::getInstance();
    $id=$_GET["id"];
    $select="select * from student where id=".$id;
    $result=$bd->prepare($select);
    $result->execute();
    if ($result && $result->rowCount()>0) 
    {
        $student=$result->fetch(PDO::FETCH_ASSOC);
        echo "<h1>Details de l'étudiant</h1>";
        echo "ID : ".$student['id']."<br>";
        echo "Nom : ".$student['name']."<br>";
        echo "Birthday : ".$student['birthday']."<br>";
    } 
    else
        echo "Error id not found<br>";
    ?>
</body>
</html>