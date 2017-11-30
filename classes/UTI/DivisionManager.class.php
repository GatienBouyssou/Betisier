<?php
namespace Classes\UTI;

use Classes\App;
class DivisionManager{

    public function add($div_nom)
    {
        App::getDb()->prepare(
            'INSERT INTO division(div_nom) VALUES (?)',[$div_nom]);
    }

    public function getAllDivision()
    {
        return App::getDb()->query('SELECT div_num, div_nom FROM division');
    }

    public function getDivision($value)
    {
        return App::getDb()->prepare('SELECT div_num, div_nom FROM division WHERE div_num= ?', [$value], true);
    }

}

?>