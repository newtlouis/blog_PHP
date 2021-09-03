<?php require '../vendor/autoload.php';

// microtime donne le temps actuel en ms
define('DEBUG_TIME' , microtime(true));

// Mise en page gestion des erreurs avec whoops, uniquement prod
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register(); 

$router = new App\Router(dirname(__DIR__) . '/views');
$router
        ->get('/blog','/post/index','blog')
        ->get('/blog/category','/category/show','category')     
        ->run();




