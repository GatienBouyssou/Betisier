<?php
namespace Classes\UTI;

use Classes\App;

/**
 * Classe  qui gére les départements
 */

class DepManager
{

    public function getDepart($value)
    {
        return App::getDb()->prepare(
            'SELECT dep_nom, vil_num FROM departement WHERE dep_num= ?', [$value], true);

    }
    public function getDepartByVille($vil_num)
    {
        return App::getDb()->prepare(
            'SELECT dep_num  FROM departement WHERE vil_num= ?', [$vil_num], true);

    }

    public function getAllDepartements()
    {
        return App::getDb()->query('SELECT dep_num, dep_nom FROM departement');
    }

    public function supprimerDepartement($vil_num)
    {
        App::getDb()->prepare('DELETE FROM departement WHERE vil_num=?', [$vil_num]);
    }
}



 ?>
