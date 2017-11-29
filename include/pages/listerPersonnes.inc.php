<h1>Liste des personnes enregistrées</h1>

<table id="listPers" >

<tr>
<th>Numéro</th>
<th>Nom</th>
<th>Prenom</th>
</tr>
<?php
use Classes\UTI\EtudiantManager;
use Classes\UTI\SalarieManager;
use Classes\UTI\VilleManager;
use Classes\UTI\DepManager;

$managerEtu = new EtudiantManager();
$personnes = $managerEtu->getAllPers();

foreach ($personnes as $pers) {
?>
	<tr>
	<td class="listPers" ><?php echo $pers->per_num ?></td>
	<td><?php echo $pers->per_nom ?></td>
	<td><?php echo $pers->per_prenom ?></td>
	</tr>
<?php
}
?>
</table>
<p>Cliquez sur un numéro pour plus d'informations</p>
<br>
<br>
<?php

if (!empty($_GET['idPers']) && $managerEtu->getPers($idPers) != NULL ) {

    $idPers = $_GET['idPers'];
	$locPers = $managerEtu->getGeolocalisation($idPers);
	if ($locPers->dep_num == NULL) {
		$managerSal = new SalarieManager();
		$managerFonction = new FonctionManager();
		$sal = $manager->getSal($pers->per_num);
		$fon = $managerFonction->getFonction($sal->fon_num);
?>

		<table id="listPers">

		<tr>
			<th>Prenom</th>
			<th>Mail</th>
			<th>Tel</th>
			<th>Tel pro</th>
			<th>Fonction</th>
		</tr>

		<tr>
			<td><?php echo $pers->per_prenom ?></td>
			<td><?php echo $pers->per_mail ?></td>
			<td><?php echo $pers->per_tel ?></td>
			<td><?php echo $sal->sal_telprof ?></td>
			<td><?php echo $ville->vil_nom ?></td>
		</tr>

<?php
	}else {
		$managerDep = new DepManager();
		$managerVille = new VilleManager();

		$dep = $managerDep->getDepart($locPers->dep_num);
		$ville = $managerVille->getVille($dep->vil_num);
?>
		<table id="listPers">

		<tr>
		<th>Prenom</th>
		<th>Mail</th>
		<th>Tel</th>
		<th>Département</th>
		<th>Ville</th>
		</tr>
		<tr>
		<td><?php echo $pers->per_prenom ?></td>
		<td><?php echo $pers->per_mail ?></td>
		<td><?php echo $pers->per_tel ?></td>
		<td><?php echo $dep->dep_nom ?></td>
		<td><?php echo $ville->vil_nom ?></td>
		</tr>
<?php
	}
}

?>
