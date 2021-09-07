<?php

namespace App\Table;
use App\Model\{Category,Post};
use App\Table\NotFoundException;


class Table{

    protected $pdo;

    protected $table= null;
    protected $class= Post::class;


    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    } 

    public function find(int $id)
    {
        // Requête prépararer si insertion de variable venant de l'url (don't trust user)
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $query->execute(['id' => $id]);

        // utiliser fetch() pour que l'erreur qui est renvoyé quand l'id est incorrect soit captée(false) puis envoyée dans une Exception et fetch() n'accepte qu'un paramêtre contrairement à fetchAll, d'où le setFetchMode()
        $query->setFetchMode(\PDO::FETCH_CLASS, Post::class);
        $result = $query->fetch();
        if($result=== false){
            throw new NotFoundException($this->table , $id);
        }
        return $result;
    }

    

}

?>