<?php
include "Start.php";
include "header.php";
require "ConnexionBD.php";
require "Student.php";

$filterName = isset($_GET['filter_name']) ? trim($_GET['filter_name']) : '';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
</head>
<body>
    <h1>Liste des etudiants : </h1><?php if($_SESSION['role']=='admin') echo '<a href="Add.php?page=Student">Click to add a student</a>'; ?>
        <form method="GET" style="margin: 20px 0;">
        <input type="text" name="filter_name" placeholder="Filter by name" value="<?= htmlspecialchars($filterName) ?>">
        <button type="submit">Filter</button>
    </form>

    <?php
    //$session declared and included in Start.php
    $session->checkAddStudentMessage();                 //we check if we added or edited a student
    $session->checkEditStudentMessage();
    $session->checkDeleteStudentMessage();
    ?>

    <table id="studentsTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Picture</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Section</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $bd = ConnexionBD::getInstance();
            $student=new Student($bd);
            $student->printStudents($filterName,$_SESSION['role']);
            ?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#studentsTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'csv', 'pdf'
            ],
            pageLength: 10,
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json' 
            }
        });
    });
    </script>
</body>
</html>