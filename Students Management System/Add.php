<?php
include "Start.php";
include "header.php";

$page=$_GET['page'];

if($page=='Student') :?>      <!--depending on which page you came from(student or section the form changes-->            
    <h1>Add Student :</h1>
    <form method="POST" action="ProcessAdd.php">
        <input type="hidden" name="page" value="Student">
        <label>Saisir l'id de l etudiant : </label><input type="text" name="id"><br>
        <label>Saisir le nom de l etudiant :</label><input type="text" name="nom"><br>
        <label>Saisir la date de naissance de l etudiant :</label><input type="date" name="bday"><br>
        <label>Saisir le lien de l'image de l etudiant :</label><input type="text" name="image"><br>
        <label>Saisir la section de l etudiant :</label><input type="text" name="section"><br>
        <button type="submit">Add Student</button>
    </form>

<?php else :?>
    <h1>Add Section :</h1>
    <form method="POST" action="ProcessAdd.php">
        <input type="hidden" name="page" value="Section">
        <label>Saisir l'id de la section : </label><input type="text" name="id"><br>
        <label>Saisir designation de la section :</label><input type="text" name="desig"><br>
        <label>Saisir la description de la section :</label><input type="text" name="desc"><br>
        <button type="submit">Add Section</button>
    </form>
        
<?php endif; ?>
</body>
</html>