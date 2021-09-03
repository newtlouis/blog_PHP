<?php require dirname(__DIR__) . '/vendor/autoload.php';

// microtime donne le temps actuel en ms
define('DEBUG_TIME' , microtime(true));

// Mise en page gestion des erreurs avec whoops, uniquement prod
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register(); 

if(isset($_GET['page']) && $_GET['page'] ==='1' ){
        // réécrire l'url sans le paramêtre page
        $uri = explode('?',$_SERVER['REQUEST_URI'])[0];
        // Si modification des $_GET/POST.. créer une variable intermédiaire
        $get = $_GET;
        unset($get['page']);
        $query = http_build_query(($get));
        if(!empty($get)){
                $uri = $uri . '?' . $query;
        }
        header('Location:' . $uri);
        http_response_code(301);
        exit();
}

$router = new App\Router(dirname(__DIR__) . '/views');
$router
        ->get('/','/post/index','home')
        ->get('/blog/[*:slug]-[i:id]','/post/show','post')
        ->get('/blog/category','/category/show','category')     
        ->run();




