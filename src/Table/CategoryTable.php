<?php

namespace App\Table;
use App\PaginatedQuery;
use App\Model\Category;
use App\Table\Exception\NotFoundException;
use \PDO;

class CategoryTable extends Table {

    public function find(int $id): Category
    {
        // Requête prépararer si insertion de variable venant de l'url (don't trust user)
        $query = $this->pdo->prepare('SELECT * FROM category WHERE id = :id');
        $query->execute(['id' => $id]);

        // utiliser fetch() pour que l'erreur qui est renvoyé quand l'id est incorrect soit captée(false) puis envoyée dans une Exception et fetch() n'accepte qu'un paramêtre contrairement à fetchAll, d'où le setFetchMode()
        $query->setFetchMode(\PDO::FETCH_CLASS, Category::class);
        $result = $query->fetch();
        if($result=== false){
            throw new NotFoundException('category' , $id);
        }
        return $result;
    }

    public function hydratePosts ( array $posts): void
    {
        $postById = [];
        foreach($posts as $post){
            $postById[$post->getId()] = $post;
        }
        
        $categories = $this->pdo->query('SELECT c.*, pc.post_id FROM post_category pc JOIN category c ON pc.category_id = c.id WHERE pc.post_id IN ( ' . implode(',',array_keys($postById)) . ' ) ')
                                ->fetchAll(\PDO::FETCH_CLASS, Category::class);
        

        foreach($categories as $category){
            $postById[$category->getPostId()]->addCategory( $category);
        }
    }
    

}