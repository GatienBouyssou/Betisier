<?php

namespace Classes\UTI;

use \Classes\App;

class VoteManager{

    public function getNotesCitation($cit_num){
        return App::getDb()->prepare('SELECT vot_valeur FROM vote WHERE cit_num=?', [$cit_num]);
    }

    public function getMoyenneCitation($cit_num){
        $moyenne = App::getDb()->prepare('SELECT AVG(vot_valeur) as moyenne FROM vote WHERE cit_num=? GROUP BY cit_num', [$cit_num], true);
        if (empty($moyenne)){
            $moyenne = (object) ['moyenne' => 'N/A'];
        }
        return $moyenne;
    }

    public function getVote($per_num, $cit_num)
    {
       return App::getDb()->prepare('SELECT vot_valeur FROM vote WHERE per_num=? AND cit_num=?', [$per_num, $cit_num], true);
    }

    public function setVote( $cit_num, $per_num, $vot_valeur){
        $vote = $this->getVote($per_num, $cit_num);
        if (empty($vote)){
          App::getDb()->prepare('INSERT INTO vote VALUE(?,?,?)', [$cit_num, $per_num, $vot_valeur]);
        } else {
          App::getDb()->prepare('UPDATE vote SET vot_valeur=? WHERE cit_num=? AND per_num=?', [$vot_valeur, $cit_num, $per_num ]);
        }
    }

    public function getByNote($vot_valeur){
        return App::getDb()->prepare('SELECT cit_num 
                                      FROM (SELECT cit_num, AVG(vot_valeur) as moyenne FROM vote
                                            GROUP BY cit_num)T
                                      WHERE T.moyenne=? 
                                      GROUP BY cit_num', [$vot_valeur]);
    }

    public function supprimerNote($cit_num)
    {
        App::getDb()->prepare('DELETE FROM vote WHERE cit_num=?', [$cit_num]);
    }

    public function supprimerNoteByPers($per_num)
    {
        App::getDb()->prepare('DELETE FROM vote WHERE per_num=?', [$per_num]);
    }
}

?>