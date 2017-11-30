<?php
namespace Classes\UTI;

use Classes\App;

/**
 * Class qui gère les info d'un salarié
 */
class SalarieManager extends PersManager
{

    public function getSal($value)
    {
        return App::getDb()->prepare('SELECT sal_telprof, fon_num FROM salarie WHERE per_num= ?', [$value], true);
    }

    public function addSalarie($salInfo){
        App::getDb()->prepare('INSERT INTO salarie VALUES(?,?,?)', $salInfo);
    }
}



 ?>
