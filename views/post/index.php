<?php 
// importation base de donnée
require dirname(dirname(__DIR__)) . '/db/db.php';

// Importation namespace Text

use App\Model\Category;
use App\Model\Post;
use App\URL;
use App\PaginatedQuery;
use App\Table\PostTable;

$title = 'Mon blog';

$table = new PostTable($pdo);
[$posts, $pagination] = $table->findPaginatedQuery();

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
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
       
