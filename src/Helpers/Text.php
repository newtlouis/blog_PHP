<?php 

namespace App\Helpers;

class Text {

    public static function excerpt( string $content, int $limit=150 , string $mode="..."): string{
            // mb_strlen compte la longueur de la chaine de charactères avec les emojis (mb_)
        if (mb_strlen($content) <= $limit){
            return $content;
        }
         // Met la portion de chaine dans $chaine
        $chaine=substr($content,0,$limit); 
        // position du dernier espace
        $espace=strrpos($chaine," "); 
        // test si il ya un espace
        if($espace)
        // si ya 1 espace, coupe de nouveau la chaine
        $chaine=substr($chaine,0,$espace);
        // Ajoute ... à la chaine
        $chaine .= '...';
        
        return $chaine;
    }   
}

?>