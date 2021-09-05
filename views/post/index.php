<?php 
// importation base de donnée
require dirname(dirname(__DIR__)) . '/db/db.php';

// Importation namespace Text
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
$posts = $paginatedQuery->getItems() ;

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
       
