<h1>Ajouter une ville</h1>
<?php
use Classes\UTI\VilleManager;

$managerVille = new VilleManager();
$nomVille = $_POST['nomVille'];
$ville = $managerVille->villeExiste($nomVille);
if ($ville) {
?>
    <form id="formConnect" action="index.php?page=7" method="post">
        <label>Nom :</label>
        <input class="boxDroite" type="text" name="nomVille" required>
        <br>
        <input class="boxDroite" type="submit" value="Valider">
    </form>
<?php
    if (!empty($nomVille)){
    ?>
        <em id="messageErreur">La ville existe déjà</em>
    <?php
    }
} else{
    $managerVille->add($nomVille)
?>
    <img src="image/valide.png" alt="validé">
    <p>La ville a été ajouté</p>
    <br>
    <p>Veuillez patientez vous allez être rediriger dans deux secondes</p>
    <script>redirectionAccueil()</script>
<?php
}
?>