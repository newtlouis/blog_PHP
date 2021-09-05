<?php

namespace App\Table;
use App\PaginatedQuery;
use App\Connexion;
use App\Model\Post;
use Exception;

// importation base de donnée
require dirname(dirname(__DIR__)) . '/db/db.php';

class PostTable extends Table{ 

    protected $table = "post";
    protected $class = Post::class;

   
    
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

    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ? ");
        $query->execute([$id]);

        if($query===false){
            throw new \Exception("Impossible de supprimer l\'article $id dans la table {$this->table}");
        }
    }

    public function updatePost(Post $post): void
    {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name = :name, content = :content WHERE id = :id ");
        $query->execute([
            'id' => $post->getId(),
            'name' => $post->getName(),
            'content' => $post->getFormatedContent()
        ]);

        if($query===false){
            throw new \Exception("Impossible de modifier l\'article {$post->getId()} nommé {$post->getName()}");
        }
    }
}


?>