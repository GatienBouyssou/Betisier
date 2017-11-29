<?php
use \Classes\UTI\ConnexionManager;
use \Classes\UTI\PersManager;
$nomUti = $_POST["nomUti"];
$mdpUti = $_POST["mdp"];
$connexionManager = new ConnexionManager($persManager);


if (empty($nomUti) || empty($mdpUti) || $_SESSION['resultat'] != $_POST['resultat']) {
    $image1 = $connexionManager->generateImage();
    $image2 = $connexionManager->generateImage();
    $_SESSION['resultat'] = $image1 + $image2;
?>
    <h1>Pour vous connecter</h1>
    <form id="formConnect" action="index.php?page=9" method="post">
        Nom d'utilisateur :
        <input id="boxUti" type="text" name="nomUti">
        <br>
        Mot de passe :
        <input id="boxMdp" type="password" name="mdp">
        <br>
        <img class="imageCo" src=<?= '"./image/nb/'.$image1.'.jpg"'?> >
        <em>+</em>
        <img class="imageCo" src=<?= '"./image/nb/'.$image2.'.jpg"'?> >
        <input id="boxCalc" type="text" name="resultat">
        <br>
        <input id="valider" type="submit" name="validation" value="Valider">
    </form>
<?php
    if (!empty($_POST['resultat'])){
?>
        <em id="messageErreur">Attention au prochain contrôle de math !</em>
<?php
    }
} else {
    $persManager = new PersManager();
    $checkPasswd = $connexionManager->isInformationGood($nomUti, $mdpUti);

    if ($checkPasswd) {
        $_SESSION['login'] = $nomUti;

?>
        <p>Veuillez patientez vous allez être rediriger dans deux secondes</p>
        <script>redirectionAccueil()</script>


<?php
    } else {
        $image1 = $connexionManager->generateImage();
        $image2 = $connexionManager->generateImage();
        $_SESSION['resultat'] = $image1 + $image2;
?>
        <form id="formConnect" action="index.php?page=9" method="post">
            Nom d'utilisateur :
            <input id="boxUti" type="text" name="nomUti">
            <br>
            Mot de passe :
            <input id="boxMdp" type="password" name="mdp">
            <br>
            <img class="imageCo" src=<?= '"./image/nb/'.$image1.'.jpg"'?> >
            <em>+</em>
            <img class="imageCo" src=<?= '"./image/nb/'.$image2.'.jpg"'?> >
            <input id="boxCalc" type="text" name="resultat">
            <br>
            <input id="valider" type="submit" name="validation" value="Valider">
        </form>
        <em id="messageErreur">Erreur dans les informations relatives à la connexion</em>
<?php
    }
}
?>