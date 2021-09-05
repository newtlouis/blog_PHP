<?php

namespace App\Table\Exception;

class NotFoundException extends \Exception{

    public function __contruct(string $table, int $id){
        $this->message = "Aucun enregistreent ne correspond à l'id $id dans la table $table ";
    }
}

?>