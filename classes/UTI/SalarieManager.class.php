<?php
namespace Classes\UTI;

use Classes\App;

/**
 * Class qui gère les info d'un salarié
 */
class SalarieManager extends PersManager
{

    public function getSal($per_num)
    {
        return App::getDb()->prepare('SELECT sal_telprof, fon_num FROM salarie WHERE per_num= ?', [$per_num], true);
    }

    public function addSalarie($salInfo){
        App::getDb()->prepare('INSERT INTO salarie VALUES(:per_num,:telephone,:fonction)', $salInfo);
    }

    public function supprimerSal($per_num)
    {
        App::getDb()->prepare('DELETE FROM salarie WHERE per_num=?', [$per_num]);
    }

    public function modifySalarie($infoSalarie)
    {
        App::getDb()->prepare('UPDATE salarie SET 
                               sal_telprof=:telephone, fon_num=:fonction       
                               WHERE per_num=:per_num', $infoSalarie);
    }
}



 ?>
