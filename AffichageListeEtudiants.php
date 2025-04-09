<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <table style="margin:auto">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Details</th>
            </tr>
            <?php
            require "ConnexionBD.php";
            $bd=ConnexionBD::getInstance();
            $select="select * from student";
            $reponse=$bd->prepare($select);
            $reponse->execute();
            $students=$reponse->fetchAll(PDO::FETCH_OBJ);
            foreach ($students as $student)
            {
                echo "<tr>";
                echo "<td>".$student->id."</td>";
                echo "<td>".$student->name."</td>";
                echo "<td>".$student->birthday."</td>";
                echo "<td><a href='DetailsEtudiant.php?id=".$student->id."'>Informations</a></td>";
                echo "</tr>";
            }
            ?>
    </table>
    
</body>
</html>