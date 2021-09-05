<?php

use App\Connexion;
use App\Table\PostTable;
use App\Model\Post;


$success = false;
$errors=[];

if (!empty($_GET)){


    if(empty($_GET['name'])){
        $errors['name'][]='Le champs ne peut être vide';
    }

    if(mb_strlen($_GET['name'])<=3){
        $errors['name'][]='Le champs doit contenir plus de 3 charactères';
    }
    if(empty($_GET['content'])){
        $errors['content'][]='Le champs ne peut être vide';
    }

    if(mb_strlen($_GET['name'])<=3){
        $errors['content'][]='Le champs doit contenir plus de 3 charactères';
    }

    else{
        $post = new Post();
        $pdo = Connexion::getPDO();
        $pdo->prepare('INSERT INTO post SET name = :name, slug = :slug, content = :content, created_at = :created_at ')
            ->execute([
                'name' => htmlentities($_GET['name']),
                'slug' => htmlentities($_GET['slug']),
                'content' => htmlentities($_GET['content']),
                'created_at' => date("Y-m-d H:i:s"),
            ]);

        // $post->setName($_POST['name']);
        // $post->setContent($_POST['content']);
        // $postTable->updatePost($post);
        $success = true;
    }
    
}



?>


<h1>Créer un nouvel article</h1>

<?php if($success): ?>
    <div class="alert alert-success">L'article a bien été créé</div>
<?php endif ?>
<?php if($errors): ?>
    <div class="alert alert-danger">L'article n'a pas pu être créé</div>
<?php endif ?>

<form action="" method="get">
    <div class="form-group">
        <label for="name"><strong> Titre</strong>  </label>
        <input type="text" class="form-control  <?= isset($errors['name']) ? 'is-invalid' : ''  ?>  " name="name" placeholder="Insérez le titre d'article" required >
        
        <?php if (isset($errors['name'])): ?>
            <div class="invalid-feedback">
                <?= implode('<br/>', $errors['name']) ?>
            </div>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="slug"><strong> Slug</strong>  </label>
        <input type="text" class="form-control  <?= isset($errors['slug']) ? 'is-invalid' : ''  ?>  " name="slug"  placeholder="Renseignez les catégories" >
        
        <?php if (isset($errors['name'])): ?>
            <div class="invalid-feedback">
                <?= implode('<br/>', $errors['name']) ?>
            </div>
        <?php endif ?>
    </div>

    <br><br>

    <div class="form-group">
        <label for="content"><strong>Contenu</strong> </label>
        <textarea style="height: 400px;" type="text" class="form-control  <?= isset($errors['content']) ? 'is-invalid' : ''  ?>  " name="content"  placeholder="Ecrivez le contenu de l'article" required ></textarea>
       
        <?php if (isset($errors['name'])): ?>
            <div class="invalid-feedback">
                <?= implode('<br/>', $errors['name']) ?>
            </div>
        <?php endif ?>
    </div>

    <button class="btn btn-primary my-4">Créer</button>
</form>