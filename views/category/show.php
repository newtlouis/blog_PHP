<?php 
// Importation pdo database
require dirname(dirname(__DIR__)) . '/db/db.php';
use App\Model\{Post,Category};
use App\URL;
use App\PaginatedQuery;
use App\Table\CategoryTable;
use App\Table\PostTable;

$id = (int)$params['id'];
$slug = $params['slug'];


// POST
$category =(new CategoryTable($pdo))->find($id);

// Si le slug de l'url n'est pas celui dans la bd, redirection vers l'url créée à partir du slug de la bd (don't trust user)
if( $category->getSlug() != $slug ){
    $url = $router->generate('category', ['slug' => $category->getSlug() , 'id' => $id ]);
    header('Location:' . $url);
    http_response_code(301);
    exit();
}


// TITLE
$title = htmlentities($category->getName());

[$posts , $paginatedQuery] = (new PostTable($pdo))->findPaginatedForCategory($category->getID());

?>



<!-- HTML -->
<h1>Catégorie <?= $title ?> </h1>

<div class="row">
    <?php foreach($posts as $post) : ?>
    <div class="col-md-3">
        <?php require dirname(__DIR__) . '/post/card.php' ?>
    </div>
    <?php endforeach ?>
</div>

<!-- Pagination -->
<?php 
$link = $router->generate('category' , ['id' => $category->getID(), 'slug' => $category->getSlug()]); 
?>
<div class="d-flex justify-content-between my-4">
    <?= $paginatedQuery->previousLink($link) ?>
    <?= $paginatedQuery->nextLink($link) ?>
       
