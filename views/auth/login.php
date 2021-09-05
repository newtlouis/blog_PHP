<?php 
use App\DotEnv;

(new DotEnv(__DIR__ . '/.env'))->load();
if(isset($_POST['password']) && isset($_POST['email'])){

    if(getenv('EMAIL') === $_POST['email'] && getenv('PASSWORD') === $_POST['password'] ){
        header('Location: ' . $router->generate('admin_posts') );
    }
    else{
        $errors = "email ou mot de passe incorrect";
    }
}
?>


<h1>Se connecter</h1>

<form action="" method="post">
<div class="form-group">
        <label for="email"><strong> Email</strong>  </label>
        <input type="text" class="form-control  <?= isset($errors) ? 'is-invalid' : ''  ?>  " name="email" placeholder="Insérez votre email" required >
        
        <?php if (isset($errors)): ?>
            <div class="invalid-feedback">
                <?= $errors ?>
            </div>
        <?php endif ?>
    </div>

    <div class="form-group">
        <label for="email"><strong> Email</strong>  </label>
        <input type="password" class="form-control  <?= isset($errors) ? 'is-invalid' : ''  ?>  " name="password" placeholder="Insérez votre mot de passe" required >
        
        <?php if (isset($errors['email'])): ?>
            <div class="invalid-feedback">
                <?= $errors ?>
            </div>
        <?php endif ?>
    </div>

    <button class="btn btn-primary my-4">Se connecter</button>
</form>