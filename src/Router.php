<?php

namespace App;

class Router{

    private $viewPath;
    private $router;

    public function __construct( string $viewPath){
        $this->viewPath = $viewPath; 
        $this->router = new \AltoRouter();
    }

    // lier url avec chemin
    public function get(string $url , string $view , ?string $name = null ): self {
        $this->router->map('GET' , $url , $view , $name);

        return $this;
    }

    // Affiche la page s'il y a un match avec l'url
    // $router appeler dans  post/index pour créer des url
    public function run() :self {
        $match = $this->router->match();
        $view = $match['target'];
        $params = $match['params'];
        $router =$this->router;
        ob_start();
        require $this->viewPath . $view . '.php';
        $content = ob_get_clean();
        require $this->viewPath . '/layouts/default.php';

        return $this;
    }
}
 
?>
