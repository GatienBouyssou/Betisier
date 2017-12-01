<?php

namespace Classes\UTI;

use \Classes\App;

class VoteManager{

    public function getNotesCitation($cit_num){
        return App::getDb()->prepare('SELECT vot_valeur FROM vote WHERE cit_num=?', [$cit_num]);
    }

    public function getMoyenneCitation($cit_num){
        return App::getDb()->prepare('SELECT AVG(vot_valeur) as moyenne FROM vote WHERE cit_num=?', [$cit_num]);
    }

}

?>