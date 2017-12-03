<h1>Modifier une ville</h1>
<?php
use \Classes\UTI\VilleManager;
use \Classes\UTI\DepManager;
use \Classes\UTI\EtudiantManager;
use \Classes\UTI\CitationManager;

$depManager = new DepManager();
$managerVille = new VilleManager();
$etuManager = new EtudiantManager();
$citationManager = new CitationManager();



$vil_num = $_GET['vil_num'];
$vil_nom=$_GET['vil_nom'];
$ville = $managerVille->villeExiste($vil_nom);
if($ville){
    ?>
    <em id="messageErreur">La ville existe déja</em>
    <?php
} else {
    $managerVille->modifyVille($vil_nom, $vil_num);
}

$villes = $managerVille->getAllVille();
if ($villes) {
    ?>
    <table id="listVilles">
        <tr>
            <th>Numero</th>
            <th>Nom</th>
        </tr>
        <?php


        foreach ($villes as $ville) {

            ?>
            <tr>
                <td><?php echo $ville->vil_num ?></td>
                <td><?php echo $ville->vil_nom ?></td>
                <td><img src="image/modifier.png" alt="invalider" onclick="modifierVille(<?= $ville->vil_num
                    ?>)" onmouseover="style.cursor = 'pointer';"></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <br>
    <?php
} else {
    ?>
    <em id="messageErreur">Il n'y a aucunes villes à modifier</em>
    <?php
}