<?php
namespace Classes\UTI;

/*
 *
 * */
class Ville {

    private $vil_num;
    private $vil_nom;

    public function __construct($valeurs = array()){
    	$this->vil_num = $valeurs[vil_num];
        $this->vil_nom = $valeurs[vil_nom];
    }



	public function getVilNum(){
        return $this->vil_num;
	}

	public function setVilNum($id){
        $this->vil_num = $id;
	}

	public function getVilNom(){
        return $this->vil_nom;
	}

	public function setVilNom($nom){
         $this->vil_nom = $nom;
	}

}
?>
