<?php
class Session {


    public function checkAddStudentMessage()
    {
        if(isset($_SESSION['addMessageEtudiant'])) 
        {
            if($_SESSION['addMessageEtudiant'] == 'S')
                echo "Student added successfully<br>" ;
            else
                echo "Student not added due to database constraints<br>";
            unset($_SESSION['addMessageEtudiant']);
        }

    }

    public function checkEditStudentMessage()
    {
        if(isset($_SESSION['editMessageEtudiant'])) 
        {
            if($_SESSION['editMessageEtudiant']=='S') 
                echo "Student edited successfully<br>" ;
            else 
                echo "Student not edited due to database constraints<br>";
            unset($_SESSION['editMessageEtudiant']);
        }
    }

    public function checkDeleteStudentMessage()
    {
        if(isset($_SESSION['deleteMessageEtudiant'])) 
        {
            if($_SESSION['deleteMessageEtudiant'] == 'S') 
                echo "Student deleted successfully<br>" ;
            else
                echo "Student not deleted due to a random error<br>";
            unset($_SESSION['deleteMessageEtudiant']);
        }
    }

    public function checkAddSectionMessage()
    {
        if(isset($_SESSION['addMessageSection'])) 
        {
            if ($_SESSION['addMessageSection'] == 'S')
                echo "Section added successfully<br>" ;
            else
                echo "Section not added due to database constraints<br>";
            unset($_SESSION['addMessageSection']);
        }
    }

    public function checkEditSectionMessage()
    {
        if(isset($_SESSION['editMessageSection'])) 
        {
            if($_SESSION['editMessageSection'] == 'S') 
                echo "Section edited successfully<br>" ;
            else
                echo "Section not edited due to database constraints<br>";
            unset($_SESSION['editMessageSection']);
        }
    }

    public function checkDeleteSectionMessage()
    {
        if(isset($_SESSION['deleteMessageSection'])) 
        {
            if($_SESSION['deleteMessageSection'] == 'S') 
                echo "Section deleted successfully<br>" ;
            else
                echo "Section not deleted due to a random error<br>";
            unset($_SESSION['deleteMessageSection']);
        }
    }

    public function isLoggedIn()
    {
        if(!isset($_SESSION['mail']))
        {
            header('Location:Login.php');
            exit;
        }
    }

    public function start()
    {
        session_start();
        $this->isLoggedIn();
    }
    
    public function checkRole($page)
    {
        if($page=='Student')
            $redirection='ListeEtudiants.php';
        else
            $redirection='ListeSections.php';
        if($_SESSION['role']!='admin')
        {
            header("Location: ".$redirection);
            exit;
        }
    }
};