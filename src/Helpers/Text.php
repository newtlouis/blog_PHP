<?php 

namespace App\Helpers;

class Text {

    public static function excerpt( string $content, int $limit=60 , string $mode="..."): string{
            // mb_strlen compte la longueur de la chaine de charactères avec les emojis (mb_)
        if (mb_strlen($content) <= $limit){
            return $content;
        }
    // Pour ne pas couper en plein milieu d'un mot, on cherche le dernier espace avec la limite de charactères et emojis (mb_) et on tronque à cet endroit
    $lastSpace = mb_strpos($content , ' ' , $limit );
    return mb_substr( $content , $lastSpace ) . $mode;
    }
}

?>