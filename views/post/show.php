<?php 
// Importation pdo database
require dirname(dirname(__DIR__)) . '/db/db.php';
use App\Model\{Post,Category};
use App\Table\CategoryTable;
use App\Table\PostTable;

$id = (int)$params['id'];
$slug = $params['slug'];

// POST

$post = (new PostTable($pdo))->find($id);
(new CategoryTable($pdo))->hydratePosts([$post]);


// A ACTIVER QUAND IL Y AURA DES VRAI SLUG DANS LA BDD ! Si le slug de l'url n'est pas celui dans la bd, redirection vers l'url créée à partir du slug de la bd (don't trust user)
// if( $post->getSlug() != $slug ){
//     $url = $router->generate('post', ['slug' => $post->getSlug() , 'id' => $id ]);
//     header('Location:' . $url);
//     http_response_code(301);
//     exit();
// }

// CATEGORIES
$query = $pdo->prepare('SELECT * FROM post_category pc JOIN category c ON pc.category_id = c.id WHERE pc.post_id = :id');
$query->execute(['id' => $post->getId()]);
$query->setFetchMode(PDO::FETCH_CLASS, Category::class);

/** @var Category[] */
$categories = $query->fetchAll();

?>


<!-- HTML -->

<h1 class="card-title"> <?=htmlentities($post->getName()) ?> </h1>
    <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>

    <?php foreach($post->getCategories() as $k=>$category): ?>
        <?php if($k>0): ?>
            ,       
        <?php endif ?>    
        <a href="<?= $router->generate('category',['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>"> <?= htmlentities($category->getName())  ?> </a>
    <?php endforeach ?>

    <p><?= $post->getFormatedContent() ?></p>
 