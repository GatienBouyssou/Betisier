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

    public function getPers($per_num)
    {
        return App::getDb()->prepare('SELECT per_prenom, per_nom, per_mail ,per_tel, per_login FROM personne WHERE per_num= ?', [$per_num], true);
    }

    public function getPersByLogin($per_login)
    {
        return App::getDb()->prepare('SELECT per_num FROM personne WHERE per_login= ?', [$per_login], true);
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

        if ($varAdmin->per_admin == 1){
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

    public function getAllEnseignants(){
        return App::getDb()->query('SELECT p.per_num, per_nom FROM personne p 
                                        JOIN salarie s ON s.per_num=p.per_num 
                                        JOIN fonction f ON f.fon_num=s.fon_num');
    }

    public function getEnseignantByNom($per_nom){
        return App::getDb()->prepare('SELECT p.per_num FROM personne p 
                                        JOIN salarie s ON s.per_num=p.per_num 
                                        JOIN fonction f ON f.fon_num=s.fon_num
                                        WHERE per_nom=?', [$per_nom]);
    }

    public function getMdp($per_num)
    {
        return App::getDb()->prepare('SELECT per_pwd FROM personne WHERE per_num=?', [$per_num], true);
    }

    public function modifyPersonne($infosPers)
    {
        App::getDb()->prepare('UPDATE personne SET per_nom=:nom, per_prenom=:prenom, 
                              per_tel=:telephone, per_mail=:email, per_login=:login, per_pwd=:mdp
                              WHERE per_num=:per_num', $infosPers);
    }

    public function supprimerPersonne($per_num)
    {
        App::getDb()->prepare('DELETE FROM personne WHERE per_num=?', [$per_num]);
    }
}


?>
