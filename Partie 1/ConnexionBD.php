<?php
class ConnexionBD
{
    public static $dbname="phpTP";
    public static $user="ali";
    public static $host="localhost";
    public static $pwd='ali';
    public static $bdd=null;
    private function __construct() 
    {
        try
        {
            self::$bdd=new PDO( "mysql:host=".self::$host.
                                ";dbname=".self::$dbname.
                                ";charset=utf8",self::$user,self::$pwd,
                                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
        }
        catch(PDOException $e )
        {
            die("Erreur : ".$e->getMessage());
        }
    }

    private static function createDB()
    {
        $conn=new mysqli(self::$host, self::$user, self::$pwd);      //conn=connexion
        if ($conn->connect_error) 
            die("Connection failed:".$conn->connect_error);


        $check = $conn->query("show databases like'" . self::$dbname . "'");
        if ($check && $check->num_rows > 0) 
        {
            $conn->close();
            return;
        }

        $sql="create database ".self::$dbname;
        if ($conn->query($sql)===TRUE) 
            echo "Database created successfully<br>";
        else 
            echo"Error creating database:".$conn->error."<br>";

        $conn->select_db(self::$dbname);

        $table="create table if not exists student (
            id int auto_increment primary key,
            name varchar(100),
            birthday date                         )";
        
        if ($conn->query($table)===TRUE) 
            echo "Table 'student' created successfully<br>";
        else 
            echo"Error creating table: ".$conn->error."<br>";
        
        $insert="insert into student (name, birthday) VALUES
            ('Ali Malamelli','2025-01-01'),
            ('Ahmed Malamelli','2024-01-01'),
            ('Sami Malamelli','2023-01-01'),
            ('Mourad Malamelli','2022-01-01'),
            ('Mohamed Malamelli','2021-01-01')";
        
        if ($conn->query($insert)===TRUE) 
            echo "Data inserted successfully.<br>";
        else 
            echo"Error inserting data: ".$conn->error."<br>";
        $conn->close();

    }
    public static function getInstance()
    {
        if (!self::$bdd) {
            self::createDB();
            new ConnexionBD();
        }
        return (self::$bdd);
    }
}
?>