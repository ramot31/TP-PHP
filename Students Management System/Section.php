<?php
class Section {
    public $bd;

    public function __construct($bd)
    {
        $this->bd = $bd;
    }

    public function printStudentsOfSection($sectionId)                    //prints all the students of a chosen section
    {
        $select="select id from etudiant where section=".$sectionId;
        $result=$this->bd->prepare($select);
        $result->execute();
        if ($result && $result->rowCount()>0) 
        {
            echo "<h1>The students of this section are :</h1><br><br>";
            echo "*******************************************<br>";
            $student=new Student($this->bd);
            $studentIds=$result->fetchAll(PDO::FETCH_OBJ);
            foreach($studentIds as $studentId)
            {
                $student->printStudent($studentId->id,0);
                echo "*******************************************<br>";
            }
        } 
        else
            echo "<h1>No students are in this section</h1><br>";
    }

    public function printSections($filterSearch,$role)    //prints all the sections 
    {                                                     //if $role is admin we print the delete and edit links
        $select = "select * from section";
        $params = [];

        if (!empty($filterSearch)) {
            $select .= " where designation like :filter or description like :filter";
            $params[':filter'] = '%' . $filterSearch . '%';
        }

        $reponse = $this->bd->prepare($select);
        $reponse->execute($params);
        $sections = $reponse->fetchAll(PDO::FETCH_OBJ);

        foreach ($sections as $section) 
        {
            echo "<tr>";
            echo "<td>{$section->id}</td>";
            echo "<td>" . htmlspecialchars($section->designation) . "</td>";
            echo "<td>" . htmlspecialchars($section->description) . "</td>";
            echo "<td>
                        <a href='details.php?id={$section->id}&page=Section'>Get Students </a>";
            if($role=='admin')
            {
                echo   "<a href='Edit.php?id={$section->id}&page=Section'>Edit</a>
                        <a href='delete.php?id={$section->id}&page=Section'>Delete</a>";
            }                    
            echo "</td>";
            echo "</tr>";
        }
    }
    
    public function updateSection($oldId,$id,$desig,$desc)       //updates an already existing section
    {
        $this->checkEmpty($id,$desig,$desc);
        try
        {
            $update="update section set id=:id,designation=:desig,description=:desc where id=:idToChange ";
            $res=$this->bd->prepare($update);
            $res->execute([':idToChange'=>$oldId,':id'=>$id,':desig'=>$desig,':desc'=>$desc]);
            $_SESSION["editMessageSection"]='S';          //S for success
        }
        catch (PDOException $e)
        {
            $_SESSION["editMessageSection"]='E';          //E for echec
        }
        header("Location:ListeSections.php");
        exit;
    }

    public function addSection($id,$desig,$desc)            //adds a new section
    {
        $this->checkEmpty($id,$desig,$desc);
        try
        {
            $insertion="insert into section values(:id,:designation, :description)";
            $res=$this->bd->prepare($insertion);
            $res->execute([':id'=>$id,':designation'=>$desig,':description'=>$desc]);
            $_SESSION["addMessageSection"]='S';        //S for success
        }
        catch (PDOException $e)
        {
            $_SESSION["addMessageSection"]='E';          //E for echec
        }
        header("Location:ListeSections.php");
        exit;
    }
    
    public function checkEmpty($id,$desig,$desc)       //check if input is empty
    {
        if(empty($id) || empty($desig) || empty($desc))
        {
            echo "Error : no input can be empty";
            exit;
        }
    }
};