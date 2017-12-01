<?php
namespace Classes\UTI;

use Classes\App;

/**
 * Class gérant les citations
 */

class CitationManager
{

    public function getDeuxCitations()
    {
        # code...
    }

    public function addCitation($infoCitation){
        App::getDb()->prepare('INSERT INTO citation(per_num, per_num_etu, cit_libelle, cit_date) 
                                VALUES(?, ?, ?, ?)', $infoCitation);
    }
}


?>
