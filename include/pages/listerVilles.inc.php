<h1>Liste des villes</h1>
<table id="listVilles">
<tr>
<th>Numero</th>
<th>Nom</th>
</tr>
<?php
use \Classes\UTI;

$managerVille = new UTI\VilleManager();
$villes = $managerVille->getAllVille();

foreach ($villes as $ville) {

?>
	<tr>
		<td><?php echo $ville->vil_num ?></td>
		<td><?php echo $ville->vil_nom ?></td>
	</tr>
<?php
}
?>
</table>
<br>
