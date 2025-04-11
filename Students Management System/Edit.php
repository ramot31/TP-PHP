<?php
include "Start.php";
include "header.php";
$page=$_GET['page'];
$id=$_GET["id"];

if($page=='Student') :?>      <!--depending on which page you came from(student or section the form changes-->            
    <form method="POST" action="ProcessEdit.php">
        <input type="hidden" name="idToChange" value="<?php echo htmlspecialchars($id); ?>">
        <input type="hidden" name="page" value="Student">
        <label>New ID : </label><input type="text" name="id"><br>
        <label>New Name : </label><input type="text" name="nom"><br>
        <label>New Birthday : </label><input type="date" name="bday"><br>
        <label>New Image : </label><input type="text" name="image"><br>
        <label>New Section : </label><input type="text" name="section"><br>
        <button type="submit">Edit Student</button>
    </form>

<?php else :?>
    <form method="POST" action="ProcessEdit.php">
        <input type="hidden" name="idToChange" value="<?php echo htmlspecialchars($id); ?>">
        <input type="hidden" name="page" value="Section">
        <label>New ID : </label><input type="text" name="id"><br>
        <label>New Designation : </label><input type="text" name="desig"><br>
        <label>New Description : </label><input type="text" name="descri"><br>
        <button type="submit">Edit Section</button>
    </form>
        
<?php endif; ?>
</body>
</html>