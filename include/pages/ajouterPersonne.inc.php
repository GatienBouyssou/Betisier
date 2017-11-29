<h1>Ajouter une personne</h1>
<?php
use \Classes\UTI\PersManager;
use \Classes\UTI\ConnexionManager;
use \Classes\UTI\DepManager;
use \Classes\UTI\DivisionManager;

$isComplete = true;
$boxEmpty = [];
foreach ($_POST as $key => $value){
    if (empty($value)){
        $boxEmpty[] = $key;
        $isComplete = false;
    }
}
var_dump($_POST);
if (!$isComplete || empty($_POST)) {
    ?>
    <form id="formConnect" action="index.php?page=1" method="post">
        <label class="lbAjPers">Nom :</label>
        <input class="boxAjPers" type="text" name="nom">
        <br>
        <label class="lbAjPers">Prénom :</label>
        <input class="boxAjPers" type="text" name="prenom">
        <br>
        <label class="lbAjPers">Téléphone :</label>
        <input class="boxAjPers" type="number" name="telephone">
        <br>
        <label class="lbAjPers">Mail :</label>
        <input class="boxAjPers" type="email" name="email">
        <br>
        <label class="lbAjPers">Login :</label>
        <input class="boxAjPers" type="text" name="login">
        <br>
        <label class="lbAjPers">Mot de passe :</label>
        <input class="boxAjPers" type="password" name="mdp">
        <br>
        <label class="lbAjPers">Categorie :</label>
        <label class="boxAjPers">
            Etudiant<input type="radio" checked="checked" name="etat" value="etudiant">
            Salarié <input type="radio" name="etat" value="salarie">
        </label>

        <input class="boxAjPers" type="submit" value="Valider">
    </form>
<?php
    $httpPage = "http://localhost/BetisierEtu/index.php?page=1";
    if (!$isComplete && $_SERVER['HTTP_REFERER'] === $httpPage) {
?>
    <em id="messageErreur">Les champs :</em>

    <?php
    foreach ($boxEmpty as $value) {
        echo $value . ' ,';
    }
    ?>
    <em>sont vides</em>
<?php
    }
} else {
    $managerPers = new PersManager();
    $connexionManager = new ConnexionManager($managerPers);
    $_POST['mdp'] = $connexionManager->tradMdp($_POST['mdp']);
    $managerPers->addPersonne($_POST);
    if ($_POST['etat'] === 'etudiant'){
        $depManager = new DepManager();
        $divManager = new DivisionManager();
        $divisions = $divManager->getAllDivision();
        $departements = $depManager->getAllDepartements();
?>
        <form id="formConnectEtudiant" action="index.php?page=1" method="post">
            <label class="lbAjPers">Année :</label>
            <select id="boxAjPers" name="annee">
                <?php
                foreach ($divisions as $division){
                    ?>
                    <option value=<?='"'.$division->div_nom.'"'?>><?='"'.$division->div_nom.'"'?></option>
                    <?php
                }
                ?>
            </select>

            <label class="lbAjPers">Département :</label>
            <select id="boxAjPers" name="annee">
                <?php
                foreach ($departements as $departement){
                ?>
                    <option value=<?='"'.$departement->dep_nom.'"'?>><?='"'.$departement->dep_nom.'"'?></option>
                <?php
                }
                ?>
            </select>

        </form>
<?php
    } else {

    }
}
?>