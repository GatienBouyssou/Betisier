<div id="texte">
<?php
if (!empty($_GET["page"])){
	$page=$_GET["page"];
} else {
    $page=0;
}
switch ($page) {
//
// Personnes
//
// Attention $db = new Mypdo(); a été temporairement supprimé
case 0:
	// inclure ici la page accueil photo

    include_once('pages/accueil.inc.php');


	break;
case 1:
	// inclure ici la page insertion nouvelle personne
	include("pages/ajouterPersonne.inc.php");
    break;

case 2:
	// inclure ici la page liste des personnes
	include_once('pages/listerPersonnes.inc.php');
    break;
case 3:
	// inclure ici la page modification des personnes
	include("pages/ModifierPersonne.inc.php");
    break;
case 4:
	// inclure ici la page suppression personnes
	include_once('pages/supprimerPersonne.inc.php');
    break;
//
// Citations
//
case 5:
	// inclure ici la page ajouter citations
    include("pages/ajouterCitation.inc.php");
    break;

case 6:
	// inclure ici la page liste des citations
	include("pages/listerCitation.inc.php");
    break;
//
// Villes
//

case 7:
	// inclure ici la page ajouter ville
	include("pages/ajouterVille.inc.php");
    break;

case 8:
// inclure ici la page lister  ville

	include("pages/listerVilles.inc.php");
    break;

//

//
case 9:
	include("pages/connect.inc.php");
    break;
case 10:
    include("pages/disconnect.inc.php");
    break;

case 11:
    include("pages/rechercherCitation.inc.php");
    break;

case 12:
	include("pages/validerCitation.inc.php");
    break;

case 13:
    break;

case 14:
    break;
case 15:
    break;

default : 	include_once('pages/accueil.inc.php');
}

?>
</div>
