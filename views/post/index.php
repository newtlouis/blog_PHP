<?php 
// importation base de donnée
require dirname(dirname(__DIR__)) . '/db/db.php';

// Importation namespace Text
use App\Model\Post;

$title = 'Mon blog';

// Pagination
$currentPage = (int)($_GET['page'] ?? 1 );
if ($currentPage <= 0){
    throw new Exception('Numéro de page invalide');
}
$count = (int)($pdo->query('SELECT COUNT(id) FROM post')->fetch(PDO::FETCH_NUM)[0]);
$perPage = 12;
$pages = ceil($count/$perPage);
if ($currentPage > $pages){
    throw new Exception('Cette page n\'existe pas');
}

// On récupère les datas et on les insère dans la class Post
$offset = $perPage *($currentPage - 1);
// dd($offset);
$query = $pdo->query("SELECT * FROM post ORDER BY created_at DESC LIMIT $perPage OFFSET $offset");
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);

?>


<h1>Mon blog</h1>
<div class="row">
    <?php foreach($posts as $post) : ?>
    <div class="col-md-3">
        <?php require 'card.php' ?>
    </div>
    <?php endforeach ?>
</div>

