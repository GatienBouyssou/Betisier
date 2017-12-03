<?php
namespace Classes\UTI;

use Classes\App;

/**
 * Gestion des informations d'un étudiant
 */
class EtudiantManager extends PersManager
{

    public function getGeolocalisation($per_num)
    {
        return App::getDb()->prepare('SELECT dep_num FROM etudiant WHERE per_num= ?', [$per_num], true);
    }

    public function  addEtudiant($infoEtu){
        App::getDb()->prepare('INSERT INTO etudiant VALUES(:per_num,:departement,:division)', $infoEtu);
    }

    public function getEtudiant($per_num)
    {
        return App::getDb()->prepare('SELECT div_num, dep_num FROM etudiant WHERE per_num=?', [$per_num]);
    }

    public function modifyEtudiant($infoEtu)
    {
        App::getDb()->prepare('UPDATE etudiant SET 
                               dep_num=:departement, div_num=:division       
                               WHERE per_num=:per_num', $infoEtu);
    }

    public function supprimerEtudiant($per_num)
    {
        App::getDb()->prepare('DELETE FROM etudiant WHERE per_num=?', [$per_num]);
    }

    public function getEtudiantByDep($dep_num)
    {
        return App::getDb()->prepare('SELECT per_num FROM etudiant WHERE dep_num=?', [$dep_num]);
    }

    public function supprimerEtudiantByDep($dep_num)
    {
        App::getDb()->prepare('DELETE FROM etudiant WHERE dep_num=?', [$dep_num]);
    }

}


?>
