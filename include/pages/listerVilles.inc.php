<h1>Liste des villes</h1>
<?php
use \Classes\UTI;

$managerVille = new UTI\VilleManager();
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
            </tr>
            <?php
        }
        ?>
    </table>
    <br>
    <?php
} else {
    ?>
    <em id="messageErreur">Il n'y a aucune ville</em>
    <?php

}
?>