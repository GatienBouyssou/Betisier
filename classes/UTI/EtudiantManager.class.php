<?php
namespace Classes\UTI;

use Classes\App;

/**
 * Gestion des informations d'un étudiant
 */
class EtudiantManager extends PersManager
{

    public function getGeolocalisation($value)
    {
        return App::getDb()->prepare('SELECT dep_num FROM etudiant WHERE per_num= ?', [$value], true);
    }

}


?>
