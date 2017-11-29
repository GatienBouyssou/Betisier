<?php
namespace Classes\UTI;

class DivisionManager{

    public function add($ville)
    {
        App::getDb()->prepare(
            'INSERT INTO division(div_nom) VALUES (?)',[$ville]);
    }

    public function getAllDivision()
    {
        return App::getDb()->query('SELECT div_num, div_nom FROM division');
    }

    public function getDivision($value)
    {
        return App::getDb()->prepare('SELECT div_nom FROM division WHERE div_num= ?', [$value], true);
    }

}

?>