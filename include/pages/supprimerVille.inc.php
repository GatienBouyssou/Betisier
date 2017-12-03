<h1>Supprimer une ville</h1>

<table id="listVilles">
<tr>
<th>Numero</th>
<th>Nom</th>
</tr>
<?php
use \Classes\UTI\VilleManager;
use \Classes\UTI\DepManager;
use \Classes\UTI\EtudiantManager;
use \Classes\UTI\CitationManager;

$depManager = new DepManager();
$managerVille = new VilleManager();
$etuManager = new EtudiantManager();
$citationManager = new CitationManager();

$villes = $managerVille->getAllVille();

$vil_num = $_GET['vil_num'];
if(!empty($vil_num)){
    $dep_num = $depManager->getDepartByVille($vil_num);
    $etudiants = $etuManager->getEtudiantByDep($dep_num);
    foreach ($etudiants as $etudiant){
        $citationManager->supprimerCitationByEtu($per_num);
    }
    $etuManager->supprimerEtudiantByDep($dep_num);
    $depManager->supprimerDepartement($vil_num);
    $managerVille->supprimerVille($vil_num);
}

foreach ($villes as $ville) {

?>
	<tr>
		<td><?php echo $ville->vil_num ?></td>
		<td><?php echo $ville->vil_nom ?></td>
        <td><img src="image/erreur.png" alt="invalider" onclick="supprimerVille(<?= $ville->vil_num
            ?>)" onmouseover="style.cursor = 'pointer';"></td>
	</tr>
<?php
}
?>
</table>
<br>