<?php 
// Importation pdo database
require dirname(dirname(__DIR__)) . '/db/db.php';
use App\Model\Post;

$id = (int)$params['id'];
$slug = $params['slug'];

// POST

// Requête prépararer si insertion de variable venant de l'url (don't trust user)
$query = $pdo->prepare('SELECT * FROM post WHERE id = :id');
$query->execute(['id' => $id]);

// utiliser fetch() pour que l'erreur qui est renvoyé quand l'id est incorrect soit captée(false) puis envoyée dans une Exception et fetch() n'accepte qu'un paramêtre contrairement à fetchAll, d'où le setFetchMode()
$query->setFetchMode(PDO::FETCH_CLASS, Post::class);
/** @var Post|false */
$post = $query->fetch();

if ($post === false){
    throw new Exception('Aucun article ne correspond à cet id');
}


// A ACTIVER QUAND IL Y AURA DES VRAI SLUG DANS LA BDD ! Si le slug de l'url n'est pas celui dans la bd, redirection vers l'url créée à partir du slug de la bd (don't trust user)
// if( $post->getSlug() != $slug ){
//     $url = $router->generate('post', ['slug' => $post->getSlug() , 'id' => $id ]);
    // header('Location:' . $url);
    // http_response_code(301);
    // exit();
// }

// CATEGORIES
$query = $pdo->prepare('SELECT * FROM post_category pc JOIN category c ON pc.category_id = c.id WHERE pc.post_id = :id');
$query->execute(['id' => $post->getId()]);
$category = $query->fetchAll();
dd($category, $post->getId());

?>


<!-- HTML -->

<h1 class="card-title"> <?=htmlentities($post->getName()) ?> </h1>
    <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
    <p><?= $post->getFormatedContent() ?></p>
 