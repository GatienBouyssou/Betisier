<?php
use Classes\UTI\PersManager;

$persManager = new Classes\UTI\PersManager();
if(empty($_SESSION['login'])){?>
    <div id="menu">
        <div id="menuInt">
            <p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>
            <p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
            <ul>
                <li><a href="index.php?page=2">Lister</a></li>
            </ul>
            <p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
            <ul>
                <li><a href="index.php?page=6">Lister</a></li>

            </ul>
            <p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
            <ul>
                <li><a href="index.php?page=8">Lister</a></li>
            </ul>
        </div>
    </div>
<?php
}elseif($persManager->isAdmin($_SESSION['login'])){
?>
    <div id="menu">
        <div id="menuInt">
            <p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>
            <p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
            <ul>
                <li><a href="index.php?page=2">Lister</a></li>
                <li><a href="index.php?page=1">Ajouter</a></li>
                <li><a href="index.php?page=4">Supprimer</a></li>
            </ul>
            <p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
            <ul>
                <li><a href="index.php?page=5">Ajouter</a></li>
                <li><a href="index.php?page=6">Lister</a></li>
                <li><a href="index.php?page=11">Rechercher</a></li>
                <li><a href="index.php?page=12">Valider</a></li>
                <li><a href="index.php?page=13">Supprimer</a></li>
            </ul>
            <p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
            <ul>
                <li><a href="index.php?page=8">Lister</a></li>
                <li><a href="index.php?page=7">Ajouter</a></li>
                <li><a href="index.php?page=14">Modifier</a></li>
                <li><a href="index.php?page=15">Supprimer</a></li>
            </ul>
        </div>
    </div>
<?php
} else {
?>
    <div id="menu">
        <div id="menuInt">
            <p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>
            <p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
            <ul>
                <li><a href="index.php?page=2">Lister</a></li>
                <li><a href="index.php?page=1">Ajouter</a></li>
            </ul>
            <p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
            <ul>
                <li><a href="index.php?page=5">Ajouter</a></li>
                <li><a href="index.php?page=6">Lister</a></li>
                <li><a href="index.php?page=11">Rechercher</a></li>
            </ul>
            <p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
            <ul>
                <li><a href="index.php?page=8">Lister</a></li>
                <li><a href="index.php?page=7">Ajouter</a></li>
                <li><a href="index.php?page=16">Modifier</a></li>
            </ul>
        </div>
    </div>
<?php
}
?>


