<h1>Ajouter une ville</h1>
<?php
use Classes\UTI\VilleManager;

$managerVille = new VilleManager();
if (empty($_POST['nomVille'])) {
?>
    <form id="formConnect" action="index.php?page=7" method="post">
        <label>Nom :</label>
        <input class="boxDroite" type="text" name="nomVille" required>
        <br>
        <input class="boxDroite" type="submit" value="Valider">
    </form>
<?php
} else{
    $ville = $_POST['nomVille'];
    $managerVille->add($ville)
?>
    <p>La ville a été ajouté</p>
    <p>Veuillez patientez vous allez être rediriger dans deux secondes</p>
    <script>redirectionAccueil()</script>
<?php
}
?>