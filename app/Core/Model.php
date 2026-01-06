<?php 
namespace App\core;
use PDO;

abstract class Model 
{
    protected PDO $db;
    protected string $table;
    protected string $primaryKey ='id';

    public function __construct(){
        $this->db = Database::getIntance();

    }
    public function find(int $id) {
        $stmt=$this->db->prepare(
            "SELECT * FROM{$this->table}WHERE {$this->primaryKey} = :id");
            $stmt->execute(['id'=> $id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS,'users');
        
        }
}