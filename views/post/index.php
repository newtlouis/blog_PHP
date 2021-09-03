<?php 
// importation base de donnée
require dirname(dirname(__DIR__)) . '/db/db.php';

// Importation namespace Text
use App\Helpers\Text;

$title = 'Mon blog';

$query = $pdo->query('SELECT * FROM post ORDER BY created_at DESC LIMIT 12');
// On récupère sous forme d'objet
$posts = $query->fetchAll(PDO::FETCH_OBJ);

?>


<h1>Mon blog</h1>
<div class="row">
    <?php foreach($posts as $post) : ?>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"> <?= htmlentities( $post->name ) ?> </h5>
                <!-- nl2br pour respecter les paragraphes -->
                <p><?= nl2br(htmlentities(Text::excerpt($post->content))) ?></p>
                <p>
                    <a href="#" class="btn btn-primary">Voir plus</a>
                </p>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>

