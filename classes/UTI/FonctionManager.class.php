<?php
namespace Classes\UTI;

use Classes\App;

/**
 * Classe qui gère les salariés
 */

class FonctionManager
{

    public function getFonction($value)
    {
        return App::getDb()->prepare('SELECT fon_libelle FROM fonction WHERE fon_num=?', [$value], true);
    }

    public function getAllFonctions()
    {
        return App::getDb()->query('SELECT fon_num, fon_libelle FROM fonction');
    }
}


 ?>
