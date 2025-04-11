<?php
class Student {
    public $bd;

    public function __construct($bd)
    {
        $this->bd = $bd;
    }


    public function getSectionDesignationForCurrentStudent($sectionId)   //gets the section designation for a given section ID ( for example for section ID = 1 we get GL or RT etc)
    {
        $select="select designation from section where id=".$sectionId;
        $result=$this->bd->prepare($select);
        $result->execute();
        $sectionDesignation=$result->fetch(PDO::FETCH_ASSOC);
        return $sectionDesignation['designation'];
    }


    public function printStudent($id,$showSection)                  //prints a student in details
    {
        $select="select * from etudiant where id=".$id;
        $result=$this->bd->prepare($select);
        $result->execute();
        if ($result && $result->rowCount()>0) 
        {
            $student=$result->fetch(PDO::FETCH_ASSOC);
            $sectionDesignation=$this->getSectionDesignationForCurrentStudent($student['section']); //we have the student's section id but we need to get for each section id the designation of the section and this is where this function comes to play
            echo "ID : ".$student['id']."<br>";
            echo 'Image : <img src="'.$student['image'].'"width=150px height=150px><br>';
            echo "Name : ".$student['name']."<br>";
            echo "Birthday : ".$student['birthday']."<br>";
            if($showSection==1)
                echo "Section : ".$sectionDesignation."<br>";
        } 
        else
            echo "Error id student not found<br>";
    }


    public function printStudents($filterName,$role)      //prints all the students
    {                                                    //if $role is admin we print the delete and edit links
        $select = "select * from etudiant";
        $params = [];

        if (!empty($filterName)) 
        {
            $select .= " where name like :filterName";
            $params[':filterName']='%'.$filterName.'%';
        }

        $reponse = $this->bd->prepare($select);
        $reponse->execute($params);
        $students = $reponse->fetchAll(PDO::FETCH_OBJ);
        foreach ($students as $student) {
            $sectionDesignation=$this->getSectionDesignationForCurrentStudent($student->section);   //we have the student's section id but we need to get for each section id the designation of the section and this is where this function comes to play
            echo "<tr>";
            echo "<td>{$student->id}</td>";
            echo "<td><img src='{$student->image}' width='150px' height='150px'></td>";
            echo "<td>{$student->name}</td>";
            echo "<td>{$student->birthday}</td>";
            echo "<td>{$sectionDesignation}</td>";
            echo "<td>
                        <a href='details.php?id={$student->id}&page=Student'>Informations </a>";
            if($role=='admin')
            {
                echo   "<a href='Edit.php?id={$student->id}&page=Student'>Edit</a>
                        <a href='delete.php?id={$student->id}&page=Student'>Delete</a>";
            }
            echo "</td>";
            echo "</tr>";
        }
    }


    public function updateStudent($oldId,$id,$name,$image,$section,$bday)      //updates the info of an existing student
    {
        $this->checkEmpty($id,$name,$image,$section,$bday);
        try
        {
            $update="update etudiant set id=:id,name=:name,image=:image,section=:section,birthday=:bday where id=:idToChange ";
            $res=$this->bd->prepare($update);
            $res->execute([':idToChange'=>$oldId,':id'=>$id,':name'=>$name,':bday'=>$bday,':image'=>$image,':section'=>$section]);
            $_SESSION["editMessageEtudiant"]='S';      //S for Success
        }
        catch (PDOException $e)
        {
            $_SESSION["editMessageEtudiant"]='E';       //E for echec
        }
        header("Location:ListeEtudiants.php");
        exit;
    }

    public function addStudent($id,$name,$image,$section,$bday)     //adds a student to the database
    {
        $this->checkEmpty($id,$name,$image,$section,$bday);
        try
        {
            $insertion="insert into etudiant values(:id,:name, :birthday, :image, :section)";
            $res=$this->bd->prepare($insertion);
            $res->execute([':id'=>$id,':name'=>$name,':birthday'=>$bday,':image'=>$image,':section'=>$section]);
            $_SESSION["addMessageEtudiant"]='S';     //S for Success
        }
        catch (PDOException $e)
        {
            $_SESSION["addMessageEtudiant"]='E';   //E for Echec
        }
        header("Location:ListeEtudiants.php");
        exit;
    }

    public function checkEmpty($id,$name,$image,$section,$bday)         //checks if input is empty
    {
        if(empty($id) || empty($name) || empty($image) || empty($section) || empty($bday))
        {
            echo "Error : no input can be empty";
            exit;
        }
    }
    
};