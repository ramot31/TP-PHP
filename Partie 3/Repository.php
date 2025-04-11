<?php

include "../autoloader.php";

abstract class Repository implements IRepository
{
    protected $db;

    protected $table;

    public function __construct($tableName)
    {
        $this->table = $tableName;
        $this->db = ConnexionDB::getInstance();
    }

    public function findAll()
    {
        $query = 'SELECT * FROM '.$this->table;
        $response = $this->_conn->query($query);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $query="SELECT * FROM {$this->table} WHERE id = :id";
        $response = $this->db->prepare($query);
        $response->execute([':id' => $id]);
        return  $response->fetch(PDO::FETCH_ASSOC);


    }
    public function create($params)
    {
        $keys = array_keys($params);
        $keyString = implode(",", $keys);
        $paramselements = array_fill(0, count($keys), '?');
        $paramString = implode(",", $paramselements);
        $request = "INSERT INTO $this->table (`id`, $keyString) VALUES (NULL, $paramString);";
        $reponse = $this->db->prepare($request);
        $reponse->execute(array_values($params));
        return $reponse->fetch(PDO::FETCH_OBJ);
        
    }
    
    public function delete($id)
    {
        $query = "delete * from {$this->tableName} where id = :id";
        /* Un objet de type Mysql non utilisable */
        $response = $this->db->prepare($query);
        $response->execute(['id' => $id]);
    }
    
    
}