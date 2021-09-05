<?php 
// Importation pdo database
require dirname(dirname(__DIR__)) . '/db/db.php';
use App\Model\{Post,Category};
use App\URL;
use App\PaginatedQuery;

$id = (int)$params['id'];
$slug = $params['slug'];


// POST

// Requête prépararer si insertion de variable venant de l'url (don't trust user)
$query = $pdo->prepare('SELECT * FROM category WHERE id = :id');
$query->execute(['id' => $id]);

// utiliser fetch() pour que l'erreur qui est renvoyé quand l'id est incorrect soit captée(false) puis envoyée dans une Exception et fetch() n'accepte qu'un paramêtre contrairement à fetchAll, d'où le setFetchMode()
$query->setFetchMode(PDO::FETCH_CLASS, Category::class);
/** @var Category|false */
$category = $query->fetch();

if ($category === false){
    throw new Exception('Aucune catégorie ne correspond à cet id');
}


// A ACTIVER QUAND IL Y AURA DES VRAI SLUG DANS LA BDD ! Si le slug de l'url n'est pas celui dans la bd, redirection vers l'url créée à partir du slug de la bd (don't trust user)
if( $category->getSlug() != $slug ){
    $url = $router->generate('category', ['slug' => $category->getSlug() , 'id' => $id ]);
    header('Location:' . $url);
    http_response_code(301);
    exit();
}


// TITLE
$title = htmlentities($category->getName());


$paginatedQuery = new PaginatedQuery(
    "SELECT p.* FROM post p JOIN post_category pc ON pc.post_id = p.id WHERE pc.category_id = {$category->getID()} ORDER BY created_at DESC",
    "SELECT COUNT(post_id) FROM post_category WHERE category_id = {$category->getID()}",
    Post::class,
    $pdo,
    12
);
// renvoie les posts de la catégorie
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
       
