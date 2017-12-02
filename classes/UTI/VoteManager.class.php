<?php

namespace Classes\UTI;

use \Classes\App;

class VoteManager{

    public function getNotesCitation($cit_num){
        return App::getDb()->prepare('SELECT vot_valeur FROM vote WHERE cit_num=?', [$cit_num]);
    }

    public function getMoyenneCitation($cit_num){
        return App::getDb()->prepare('SELECT AVG(vot_valeur) as moyenne FROM vote WHERE cit_num=? GROUP BY cit_num', [$cit_num], true);
    }

    public function getVote($per_num, $cit_num)
    {
       return App::getDb()->prepare('SELECT vot_valeur FROM vote WHERE per_num=? AND cit_num=?', [$per_num, $cit_num], true);
    }

    public function setVote( $cit_num, $per_num, $val_vote){
        $vote = $this->getVote($per_num, $cit_num);
        if (empty($vote->val_vote)){
          App::getDb()->prepare('INSERT INTO vote VALUE(?,?,?)', [$cit_num, $per_num, $val_vote]);
        } else {
          App::getDb()->prepare('UPDATE vote SET val_vote=? WHERE cit_num=? AND per_num=?', [$cit_num, $per_num, $val_vote]);
        }
    }
}

?>