<?php

namespace App;
use \PDO;
use App\Model\{Post,Category};




class PaginatedQuery{

    private $query;
    private $queryCount;
    private $classMapping;
    private $pdo;
    private $perPage;

    public function __construct(
        string $query,
        string $queryCount, 
        string $classMapping, 
        \PDO $pdo, 
        int $perPage = 12
        )
    {
        $this->query = $query;
        $this->queryCount = $queryCount;
        $this->classMapping = $classMapping;
        $this->perPage = $perPage;
        $this->pdo = $pdo;

    }

    public function getItems(): array
    {   
        $currentPage = $this->getCurrentPage();
        $pages = $this->getPages();
        if ($currentPage > $pages){
            throw new \Exception('Cette page n\'existe pas');
        }
        // On récupère les posts qui ont cette catégorie de page et on les insère dans la class Post
        $offset = $this->perPage *($currentPage - 1);
        return $this->pdo->query($this->query . " LIMIT $this->perPage OFFSET $offset ") ->fetchAll(PDO::FETCH_CLASS, Post::class);
        
        
    }

    private function getCurrentPage(): int
    {
        return URL::getPositivInt('page', 1);
    }

    private function getPages():int
    {
        $count = (int)($this->pdo->query($this->queryCount)->fetch(PDO::FETCH_NUM)[0]);
        return ceil($count/$this->perPage);
    }

    public function previousLink(string $link): ?string
    {
        $currentPage = $this->getCurrentPage();
        if ($currentPage <=1) return null;
        $linkPrevious = $link . "?page=" . ($currentPage -1);
        return <<<HTML
            <a class="btn btn-primary" href=" {$linkPrevious} ">Page précédente</a>
        HTML;
    }

    public function nextLink(string $link): ?string
    {
        $currentPage = $this->getCurrentPage();
        $pages = $this->getPages();
        if ($currentPage >= $pages) return null;
        $linkNext = $link . "?page=" . ($currentPage +1);
        return <<<HTML
            <a class="btn btn-primary" href=" {$linkNext} ">Page suivante</a>
        HTML;
    }
}

?>