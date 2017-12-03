<?php
namespace Classes\UTI;

use Classes\App;

/**
 * Class gérant les citations
 */

class CitationManager
{

    public function getAllCitations()
    {
        return App::getDb()->query('SELECT per_num, cit_num, cit_libelle, cit_date FROM citation
                                       WHERE cit_valide = 1 AND cit_date_valide IS NOT NULL');
    }

    public function addCitation($infoCitation){
        App::getDb()->prepare('INSERT INTO citation(per_num, per_num_etu, cit_libelle, cit_date) 
                                VALUES(?, ?, ?, ?)', $infoCitation);
    }

    public function getNumberCitation(){
        return App::getDb()->query('SELECT COUNT(*) as nbrCitations FROM citation', true);
    }

    public function getCitation($cit_num){
        return App::getDb()->prepare('SELECT per_num, cit_libelle, cit_date FROM citation 
                                      WHERE cit_num=?', [$cit_num], true);
    }

    public function  getBydate($cit_date){
        return App::getDb()->prepare('SELECT cit_num FROM citation
                                      WHERE cit_date=?', [$cit_date]);
    }

    public function getCitationsByPersonne($per_num){
        return App::getDb()->prepare('SELECT cit_num FROM citation 
                                      WHERE per_num=?', [$per_num]);
    }

    public function getCitationAValider()
    {
        return App::getDb()->query('SELECT per_num, cit_num, cit_libelle, cit_date FROM citation
                                       WHERE cit_valide = 0 AND cit_date_valide IS NULL');
    }

    public function validerCitation($cit_num, $date)
    {
        App::getDb()->prepare('UPDATE citation SET cit_valide=1, cit_date_valide=?  
                                WHERE cit_num=?', [$date, $cit_num]);
    }

    public function supprimerCitation($cit_num)
    {
        App::getDb()->prepare('DELETE FROM citation WHERE cit_num=?', [$cit_num]);
    }

    public function supprimerCitationByEtu($per_num)
    {
        App::getDb()->prepare('DELETE FROM citation WHERE per_num_etu=?', [$per_num]);
    }

    public function getCitationsByEtudiant($per_num)
    {
        return App::getDb()->prepare('SELECT cit_num FROM citation 
                                      WHERE per_num_etu=?', [$per_num]);
    }

}


?>
