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


}


?>
