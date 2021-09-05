<?php

namespace App\Model;

use Faker\Guesser\Name;

class Category{

    private $id;
    private $slug;
    private $name;
    private $post_id;

    public function getID(): ?int  
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getName(): ?string 
    {
        return $this->name;
    }

    public function getPostId(): ?string 
    {
        return $this->post_id;
    }
}

?>