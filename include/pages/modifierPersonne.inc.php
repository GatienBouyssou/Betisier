<h1>Modifier une personne</h1>
<?php
use Classes\UTI\EtudiantManager;
use Classes\UTI\SalarieManager;
use Classes\UTI\PersManager;
use Classes\UTI\DepManager;
use Classes\UTI\FonctionManager;
use Classes\UTI\DivisionManager;
use Classes\UTI\CitationManager;
use Classes\UTI\VoteManager;

$voteManager = new VoteManager();
$managerEtu = new EtudiantManager();
$depManager = new DepManager();
$divManager = new DivisionManager();
$salarieManager = new SalarieManager();
$fonctionManager = new FonctionManager();
$managerPers = new PersManager();
$citationManager = new CitationManager();

$personnes = $managerEtu->getAllPers();
$per_num = $_GET['per_num'];
if(!empty($personnes) && empty($per_num)) {

    ?>
    <table id="listPers">

        <tr>
            <th>Numéro</th>
            <th>Nom</th>
            <th>Prenom</th>
        </tr>
        <?php


        foreach ($personnes as $pers) {
            ?>
            <tr>
                <td><?php echo $pers->per_nom ?></td>
                <td><?php echo $pers->per_prenom ?></td>
                <td><img src="image/modifier.png" alt="valider" onclick="modifierPers(<?= $pers->per_num ?>)" onmouseover="style.cursor = 'pointer';"></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
} elseif (!empty($per_num) && !empty($personnes)) {
    $personne = $managerEtu->getPers($per_num);

    $patternTel = " pattern=\"[0-9]{10}\"";

    if (empty($_POST['fonction']) && empty($_POST['division']) && empty($_POST['etat']) ) {

        ?>

        <form id="formConnect" action="index.php?page=3&per_num=<?=$per_num?>" method="post">
            <label class="labelGauche">Nom :</label>
            <input class="boxDroite" type="text" name="nom" value="<?= $personne->per_nom ?>" required>
            <br>
            <label class="labelGauche">Prénom :</label>
            <input class="boxDroite" type="text" name="prenom" value="<?= $personne->per_prenom ?>" required>
            <br>
            <label class="labelGauche">Téléphone :</label>
            <input class="boxDroite" type="tel" <?= $patternTel ?> name="telephone" value="<?= $personne->per_tel ?>" required>
            <br>
            <label class="labelGauche">Mail :</label>
            <input class="boxDroite" type="email" name="email" value="<?= $personne->per_mail ?>" required>
            <br>
            <label class="labelGauche">Login :</label>
            <input class="boxDroite" type="text" name="login" value="<?= $personne->per_login ?>" required>
            <br>
            <label class="labelGauche">Mot de passe :</label>
            <input class="boxDroite" type="password" name="mdp" value="blabla" required>
            <br>
            <label class="labelGauche">Categorie :</label>
            <?php
            $isEtudiant = $managerEtu->getGeolocalisation($per_num);
            if (empty($isEtudiant)){
            ?>
                <label class="boxDroite">
                    Etudiant<input type="radio"  name="etat" value="etudiant">
                    Salarié <input type="radio" checked="checked" name="etat" value="salarie">
                </label>
            <?php
            } else {
            ?>

                <label class="boxDroite">
                    Etudiant<input type="radio" checked="checked" name="etat" value="etudiant">
                    Salarié <input type="radio" name="etat" value="salarie">
                </label>
            <?php
            }
            ?>


            <input class="boxDroite" type="submit" value="Valider">
        </form>
        <?php
    } elseif (!empty($_POST['etat']) && empty($_POST['fonction']) && empty($_POST['division'])) {

        $infoPers = $_POST;
        if ($infoPers['mdp'] === "blabla"){
            $mdp = $managerPers->getMdp($per_num);
            $infoPers['mdp'] = $mdp->per_pwd;
        }

        unset($infoPers['etat']);
        $managerPers->modifyPersonne(array_merge(["per_num" => $per_num],$infoPers));

        if ($_POST['etat'] === 'etudiant'){


            $divisions = $divManager->getAllDivision();
            $departements = $depManager->getAllDepartements();
            $infoEtu = $managerEtu->getEtudiant($per_num);

            ?>
            <form id="formConnectEtudiant" action="index.php?page=3&per_num=<?=$per_num?>" method="post">
                <label class="labelGauche">Année :</label>
                <select class="boxDroite" name="division">
                    <?php
                    foreach ($divisions as $division){
                        if ($infoEtu->div_num !== $division->div_num){
                    ?>
                        <option value=<?='"'.$division->div_num.'"'?>><?='"'.$division->div_nom.'"'?></option>
                        <?php
                        }else {
                            ?>
                            <option selected="selected" value=<?= '"' . $division->div_num . '"' ?>><?= '"' . $division->div_nom . '"' ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <br>
                <label class="labelGauche">Département :</label>
                <select class="boxDroite" name="departement">
                    <?php
                    foreach ($departements as $departement){
                        if ($infoEtu->dep_num !== $departement->dep_num){
                            ?>
                            <option value=<?='"'.$departement->dep_num.'"'?>><?='"'.$departement->dep_nom.'"'?></option>
                            <?php
                        }else {
                            ?>
                            <option selected="selected" value=<?= '"' . $departement->dep_num . '"' ?>><?= '"' . $departement->dep_nom . '"' ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <br>
                <input class="boxDroite" type="submit" value="Valider">
            </form>
            <?php
        } else {


            $fonctions = $fonctionManager->getAllFonctions();
            $infoSal = $salarieManager->getSal($per_num);
            if (!$infoSal){
                $infoSal = (object) ["sal_telprof" => ""];
            }

            ?>
            <form id="formConnectSalarie" action="index.php?page=3&per_num=<?=$per_num?>" method="post">
                <label class="labelGauche">Téléphone professionnel :</label>
                <input class="boxDroite" type="tel" <?= $patternTel ?> name="telephone" value="<?= $infoSal->sal_telprof ?>" required>
                <br>
                <label class="labelGauche">Fonction :</label>
                <select class="boxDroite" name="fonction">
                    <?php
                    foreach ($fonctions as $fonction){
                        if ($infoSal->fon_num !== $fonction->fon_num){
                            ?>
                            <option value=<?='"'.$fonction->fon_num.'"'?>><?='"'.$fonction->fon_libelle.'"'?></option>
                            <?php
                        }else {
                            ?>
                            <option selected="selected" value=<?= '"' . $fonction->fon_num . '"' ?>><?= '"' . $fonction->fon_libelle . '"' ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <br>
                <input class="boxDroite" type="submit" value="Valider">
            </form>
            <?php
        }
    } else {


        if (!empty($_POST['departement'])){
            $existSal = $salarieManager->getSal($per_num);

            if ($existSal){

                $citations = $citationManager->getCitationsByPersonne($per_num);
                foreach ($citations as $citation){
                    $voteManager->supprimerNote($citation->cit_num);
                }

                $citationManager->supprimerCitationBySal($per_num);


                $salarieManager->supprimerSal($per_num);


                $managerEtu->addEtudiant(array_merge(["per_num" => $per_num],$_POST));
            } else {
                $managerEtu->modifyEtudiant(array_merge(["per_num" => $per_num],$_POST));
            }

        } else {
            $existEtudiant = $managerEtu->getEtudiant($per_num);
            if ($existEtudiant){
                var_dump($citationManager);
                $citations = $citationManager->getCitationsByEtudiant($per_num);
                foreach ($citations as $citation){
                    $voteManager->supprimerNote($citation->cit_num);
                }
                $voteManager->supprimerNoteByPers($per_num);

                $citationManager->supprimerCitationByEtu($per_num);

                $managerEtu->supprimerEtudiant($per_num);

                $salarieManager->addSalarie(array_merge(["per_num" => $per_num],$_POST));
            } else {

                $salarieManager->modifySalarie(array_merge(["per_num" => $per_num],$_POST));
            }
        }
        ?>
        <img src="image/valid.png" alt="valider">
        <p>Votre personne a été modifié avec succès</p>
        <script>redirectionAccueil()</script>

        <?php
    }

}else {
?>
    <em id="messageErreur">Il n'y a aucune personne à modifier</em>
<?php
}
?>