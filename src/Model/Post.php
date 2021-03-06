<?php

namespace App\Model;
use App\Helpers\Text;
use DateTime;

class Post{

    private $id;
    private $name;
    private $slug;
    private $content;
    private $created_at;
    private $categories = [];

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getName(): ?string
    {
        return htmlentities( $this->name );
    }

    // tronque le texte en appellant la fonction excerpt de la classe Text
    public function getExcerpt(): ?string 
    {
        if($this->content == null){
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->content)));
    }

    public function getFormatedContent(): ?string
    {
        return nl2br(htmlentities($this->content));
    }

    public function getCreatedAt(): \DateTime
    {
        return new \DateTime($this->created_at);
    }

    public function getSlug(): ?string 
    {
        return $this->slug;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function addCategory(Category $category): void{
        $this->categories[] = $category;
    }

    public function getCategories():array
    {
        return $this->categories;
    }
}

?>