<?php

namespace App\Table;
use App\PaginatedQuery;
use App\Model\Category;
use \PDO;


class Table{

    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    } 

    

}

?>