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
        return App::getDb()->query('SELECT per_num, cit_num, cit_libelle, cit_date FROM citation');
    }

    public function getTop2Citation(){
        return App::getDb()->query('SELECT c.cit_num, c.per_num, cit_libelle, cit_date, AVG(vot_valeur) as moyenne FROM citation c
                                    JOIN vote v ON v.cit_num = c.cit_num
                                    GROUP BY c.cit_num
                                    ORDER BY moyenne DESC
                                    LIMIT 2');
    }

    public function addCitation($infoCitation){
        App::getDb()->prepare('INSERT INTO citation(per_num, per_num_etu, cit_libelle, cit_date) 
                                VALUES(?, ?, ?, ?)', $infoCitation);
    }

    public function getNumberCitation(){
        return App::getDb()->query('SELECT COUNT(*) as nbrCitations FROM citation', true);
    }
}


?>
