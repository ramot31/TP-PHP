<?php
class User {
    public $bd;

    public function __construct($bd)
    {
        $this->bd = $bd;
    }

    public function login($mail,$pass)
    {
        $select="select * from utilisateur where email=:email and password =:password";
        $res=$this->bd->prepare($select);
        $res->execute([':email'=> $mail,':password'=>$pass]);
        $user=$res->fetch(PDO::FETCH_ASSOC);
        if($user)
        {
            $_SESSION['mail']=$mail;
            $_SESSION['role']=$this->getRole($mail);
            header('Location:index.php');
            exit;
        }
        else
            echo "Please verify your login informations<br>";
    }


    public function getRole($mail)
    {
        $select="select role from utilisateur where email=:email";
        $res=$this->bd->prepare($select);
        $res->execute([':email'=>$mail]);
        $role=$res->fetch(PDO::FETCH_ASSOC);
        return $role['role'];
        
    }

    public function deleteStudent($id)
    {
        $delete="delete from etudiant where id=:id";
        $res=$this->bd->prepare($delete);
        $res->execute([':id'=>$id]);
        $_SESSION["deleteMessageEtudiant"]='S';
    }

    public function deleteSection($id)
    {
        $delete="delete from section where id=:id";
        $res=$this->bd->prepare($delete);
        $res->execute([':id'=>$id]);
        $_SESSION['deleteMessageSection']='S';
    }    
    
};