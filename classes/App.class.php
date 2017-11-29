<?php

namespace Classes;
/**
 *Classe app qui renvoie la base de donnée
 */
class App{

    private static $database;

    public static function getDb(){

        if(self::$database === null){
            self::$database = new Database();
        }
        return self::$database;
    }
}


?>