<?php

namespace Classes\UTI;
/**
 * classe qui gère les villes
 */
use Classes\App;

class VilleManager
{

    public function add($ville)
    {
        App::getDb()->prepare(
            'INSERT INTO ville(vil_nom) VALUES (?)',[$ville]);
    }

    public function getAllVille()
    {
        return App::getDb()->query('SELECT vil_num, vil_nom FROM ville');
    }

    public function getVille($value)
    {
        return App::getDb()->prepare('SELECT vil_nom FROM ville WHERE vil_num= ?', [$value], true);
    }

    public function supprimerVille($vil_num)
    {
        App::getDb()->prepare('DELETE FROM ville WHERE vil_num=?', [$vil_num]);
    }
}
?>
