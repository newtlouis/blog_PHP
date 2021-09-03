<?php 


// importation base de donnée
require dirname(dirname(__DIR__)) . '/db/db.php';

// Importation namespace Text
use App\Helpers\Text;
use App\Model\Post;

$title = 'Mon blog';

$query = $pdo->query('SELECT * FROM post ORDER BY created_at DESC LIMIT 12');
// On récupère les datas et on les insère dans la class Post
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);

?>


<h1>Mon blog</h1>
<div class="row">
    <?php foreach($posts as $post) : ?>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"> <?= $post->getName() ?> </h5>
                <p><?= $post->getExcerpt() ?></p>
                <p>
                    <a href="#" class="btn btn-primary">Voir plus</a>
                </p>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>

