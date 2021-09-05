<?php

namespace App\Table;
use App\PaginatedQuery;
use App\Model\Category;
use App\Connexion;

// importation base de donnée
require dirname(dirname(__DIR__)) . '/db/db.php';

class PostTable extends Table{ 

    public function findPaginatedQuery()
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT * FROM post ORDER BY created_at DESC",
            "SELECT COUNT(id) FROM post",
            $this->pdo,
        );
        $posts = $paginatedQuery->getItems();

       (new CategoryTable($this->pdo))->hydratePosts($posts);

        return [$posts, $paginatedQuery];
    }

    public function findPaginatedForCategory(int $categoryID)
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT p.* FROM post p JOIN post_category pc ON pc.post_id = p.id WHERE pc.category_id = {$categoryID} ORDER BY created_at DESC",
            "SELECT COUNT(post_id) FROM post_category WHERE category_id = {$categoryID}",
            (new Connexion())->getPDO(),
            12
        );
        // renvoie les posts de la catégorie
        $posts = $paginatedQuery->getItems();
       (new CategoryTable($this->pdo))->hydratePosts($posts);
       return [$posts, $paginatedQuery];


        
        
    }
}


?>