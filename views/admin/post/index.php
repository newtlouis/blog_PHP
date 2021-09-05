<?php

use App\Connexion;
use App\Table\PostTable;
use App\Auth;

Auth::check();

$title = "Administration";
$pdo = Connexion::getPDO();
[$posts, $pagination] = (new PostTable($pdo))->findPaginatedQuery();

?>

<h1>Gerer mes articles</h1>

<?php if(isset($_GET['delete'])): ?>
    <div class="alert alert-success">L'article a bien été supprimé</div>    
<?php endif ?>

<table class="table">
    <thead>
        <th>#</th>
        <th>Titre</th>
        <th>Actions</th>
    </thead>

    <tbody>
        <?php foreach($posts as $post): ?>
            <tr>
                <td>#<?= $post->getId() ?></td>
                <td>
                    <a href="<?=$router->generate('admin_post', ['id' => $post->getId()])?>"><?= htmlentities($post->getName()) ?></a>
                </td>
                <td>
                    <a class="btn btn-primary" href="<?=$router->generate('admin_post', ['id' => $post->getId()])?>">Editer</a>
                    <form style="display:inline" onsubmit="return confirm('Voulez-vous supprimer cet article ?')" action="<?=$router->generate('admin_post_delete', ['id' => $post->getId()])?>" method="post">
                        <button class="btn btn-danger" type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<!-- Pagination -->
<?php 
$link = $router->generate('admin_posts'); 
?>
<div class="d-flex justify-content-between my-4">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
            