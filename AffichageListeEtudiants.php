<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <table style="margin:auto">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Birthday</th>
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
            echo "</tr>";
        }
        ?>
    </table>
</head>
<body>
    
</body>
</html>