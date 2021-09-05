<?php 
// importation base de donnée
require dirname(dirname(__DIR__)) . '/db/db.php';

// Importation namespace Text

use App\Model\Category;
use App\Model\Post;
use App\URL;
use App\PaginatedQuery;


$title = 'Mon blog';

$paginatedQuery = new PaginatedQuery(
    "SELECT * FROM post ORDER BY created_at DESC",
    "SELECT COUNT(id) FROM post",
    Post::class,
    $pdo,
    12
);
// renvoie l'ensemble des posts
$posts = $paginatedQuery->getItems();
$postById = [];
foreach($posts as $post){
    $postById[$post->getId()] = $post;
}


// Logique affichage des catégories dans les cards des posts
$ids = [];
foreach($posts as $post){
    $ids[] = $post->getId();
}
// On récupère les catégories des posts 
// implode pour casser un tableau et rassembler en string avec un séparateur
$categories = $pdo  ->query('SELECT c.*, pc.post_id FROM post_category pc JOIN category c ON pc.category_id = c.id WHERE pc.post_id IN ( ' . implode(',',array_keys($postById)) . ' ) ')
                    ->fetchAll(PDO::FETCH_CLASS, Category::class);
// dump($categories);

foreach($categories as $category){
    $postById[$category->getPostId()]->addCategory( $category);
}

?>

<!-- HTML -->

<h1>Mes posts</h1>

<div class="row">
    <?php foreach($posts as $post) : ?>
    <div class="col-md-3">
        <?php require 'card.php' ?>
    </div>
    <?php endforeach ?>
</div>


<!-- Pagination -->
<?php 
$link = $router->generate('home'); 
?>
<div class="d-flex justify-content-between my-4">
    <?= $paginatedQuery->previousLink($link) ?>
    <?= $paginatedQuery->nextLink($link) ?>
       
