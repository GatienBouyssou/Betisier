<?php

namespace Classes\UTI;

use Classes\App;

/**
 * classe gérant les personnes de la BD
 */
class PersManager
{

    public function getAllPers()
    {
        return App::getDb()->query('SELECT per_num, per_nom, per_prenom FROM personne');
    }

    public function getPers($value)
    {
        return App::getDb()->prepare('SELECT per_nom, per_mail ,per_tel FROM personne WHERE per_num= ?', [$value], true);
    }

    /**
     * @return mixed
     */
    public function getPersByLoginMdp($login,$passwd)
    {
        return App::getDb()->prepare('SELECT per_login FROM personne WHERE per_login= ? AND per_pwd= ?', [$login, $passwd], true);
    }

    public function isAdmin($login)
    {
        $varAdmin = App::getDb()->prepare('SELECT per_admin FROM personne WHERE per_login= ?', [$login], true);
        if ($varAdmin === 1){
            return true;
        }
        return false;
    }

    public function addPersonne($array)
    {
        unset($array['etat']);
        App::getDb()->prepare('INSERT INTO personne(per_nom, per_prenom, per_tel, per_mail, 
                                                              per_admin, per_login, per_pwd) 
                                 VALUES( :nom , :prenom , :telephone , :email, 0, :login , :mdp )', $array);
    }


}


?>
