<?php 
// importation base de donnée
require dirname(dirname(__DIR__)) . '/db/db.php';

// Importation namespace Text
use App\Model\Post;

$title = 'Mon blog';

// PAGINATION
// Est-ce que le numéro de l'url est bien un entier ?
$page = $_GET['page'] ?? 1;
if (!filter_var($page , FILTER_VALIDATE_INT)){
    throw new Exception('Numéro de page invalide');  
}

// // redirection page=1 vers home
// if($page ==='1'){
//     header('Location:' .$router->generate('home'));
//     http_response_code(301);
//     exit();
// }

// Est-ce que le numéro de l'url est bien un entier positif ?
$currentPage = (int)$page;
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

<!-- Pagination -->

<div class="d-flex justify-content-between my-4">
    <?php if($currentPage > 1): ?>
        <a class="btn btn-primary" href=" <?php $router->generate('home') ?>?page=<?= $currentPage -1 ?> ">Page précédente</a>
    <?php endif ?>
    <?php if($currentPage < $pages): ?>
        <a class="btn btn-primary ml-auto" href=" <?php $router->generate('home') ?>?page=<?= $currentPage + 1 ?> ">Page suivante</a>
    <?php endif ?>
</div>