<?php

use App\Connexion;
use App\Table\PostTable;

$pdo = Connexion::getPDO();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$success = false;
$errors=[];

if (!empty($_POST)){

    if(empty($_POST['name'])){
        $errors['name'][]='Le champs ne peut être vide';
    }

    if(mb_strlen($_POST['name'])<=3){
        $errors['name'][]='Le champs doit contenir plus de 3 charactères';
    }

    else{
    $post->setName($_POST['name']);
    $post->setContent($_POST['content']);
    $postTable->updatePost($post);
    $success = true;
    }
    
}



?>


<h1>Editer l'article <?= $params['id'] ?></h1>

<?php if($success): ?>
    <div class="alert alert-success">L'article a bien été modifié</div>
<?php endif ?>
<?php if($errors): ?>
    <div class="alert alert-danger">L'article n'a pas pu être modifié</div>
<?php endif ?>

<form action="" method="post">
<div class="form-group">
        <label for="name"><strong> Titre</strong>  </label>
        <input type="text" class="form-control  <?= isset($errors['name']) ? 'is-invalid' : ''  ?>  " name="name" value="<?= htmlentities($post->getName())  ?> " required >
        
        <?php if (isset($errors['name'])): ?>
            <div class="invalid-feedback">
                <?= implode('<br/>', $errors['name']) ?>
            </div>
        <?php endif ?>
    </div>

    <br><br>

    <div class="form-group">
        <label for="content"><strong>Contenu</strong> </label>
        <textarea style="height: 400px;" type="text" class="form-control  <?= isset($errors['content']) ? 'is-invalid' : ''  ?>  " name="content"  required ><?= htmlentities($post->getFormatedContent())  ?></textarea>
       
        <?php if (isset($errors['name'])): ?>
            <div class="invalid-feedback">
                <?= implode('<br/>', $errors['name']) ?>
            </div>
        <?php endif ?>
    </div>

    <button class="btn btn-primary my-4">Modifier</button>
</form>