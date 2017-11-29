<?php
/**
 * Created by PhpStorm.
 * User: gat
 * Date: 19/11/17
 * Time: 18:16
 */

namespace Classes;
use \PDO;

class Database
{
    private $dbName;
    private $dbUser;
    private $dbPasswd;
    private $dbHost;
    private $pdo;

    public function __construct()
    {
        $this->dbHost = DBHOST;
        $this->dbUser = DBUSER;
        $this->dbName = DBNAME;
        $this->dbPasswd = DBPASSWD;
    }

    public function getPDO(){
        if ($this->pdo === null) {
            $pdo = new PDO('mysql:dbname=' . DBNAME . ';host=' . DBHOST.';charset=utf8', DBUSER, DBPASSWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;

        }
        return $this->pdo;
    }

    public function query($statement, $one = false){
        $req = $this->getPDO()->query($statement);

        if (
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ){
            return $req;
        }


        if ($one){
            $data = $req->fetch(PDO::FETCH_OBJ);
        }else{
            $data = $req->fetchAll(PDO::FETCH_OBJ);
        }

        return $data;
    }

    public function prepare($statement, $attributes, $one = false){
        $req = $this->getPDO()->prepare($statement);
        $req->execute($attributes);

        if (
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ){
            return $req;
        }

        if ($one){
            $data = $req->fetch(PDO::FETCH_OBJ);
        }else{
            $data = $req->fetchAll(PDO::FETCH_OBJ);
        }
        return $data;
    }
}