<?php
namespace Classes\UTI;


use Classes\App;

class MotManager{

    public function getAllMots(){
        return App::getDb()->query('SELECT mot_interdit FROM mot');
    }
}

?>

