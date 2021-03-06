<?php require dirname(__DIR__) . '/vendor/autoload.php';

// microtime donne le temps actuel en ms
define('DEBUG_TIME' , microtime(true));

// Mise en page gestion des erreurs avec whoops, uniquement prod
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register(); 

// réécrire l'url sans le paramêtre page=1
if(isset($_GET['page']) && $_GET['page'] ==='1' ){
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
        ->match('/login','/auth/login','login')
        ->get('/blog/category/[*:slug]-[i:id]','/category/show','category')     
        ->get('/blog/[*:slug]-[i:id]','/post/show','post')
        ->get('/admin','/admin/post/index','admin_posts')
        ->match('/admin/post/[i:id]','/admin/post/edit','admin_post')
        ->post('/admin/post/[i:id]/delete','/admin/post/delete','admin_post_delete')
        ->get('/admin/post/new','/admin/post/new','admin_post_new')
        ->run();




