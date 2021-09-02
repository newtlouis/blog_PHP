<?php require '../vendor/autoload.php';

// Démarrage router
$router = new AltoRouter();

// cst
define('VIEW_PATH' , dirname(__DIR__) . '/views');

// Création url
$router -> map('GET','/blog', function () {
    require VIEW_PATH . '/post/index.php';
});
$router -> map('GET','/blog/category', function () {
    require VIEW_PATH . '/category/show.php';
});

// url correspond à une des routes ? target = la fonction callback
$match = $router->match();
$match['target']();

