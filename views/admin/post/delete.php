<?php 

use App\Connexion;
use App\Table\PostTable;
use App\Auth;

Auth::check();

$pdo = Connexion::getPDO();
$table = new PostTable($pdo);
$table->delete($params['id']);

header('Location: ' . $router->generate('admin_posts') . '?delete=1');

?>

<h1>Suppression de l'article <?=$params['id'] ?></h1>