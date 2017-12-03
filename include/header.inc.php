<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php	$title = "Bienvenue sur le site du bétisier de l'IUT."; ?>
		<title>
		<?php echo $title ?>
		</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
        <?php
            use \Classes\UTI\PersManager;
            require_once('js/fonction.inc.php');
            $persManager = new PersManager();
        ?>

</head>
	<body>
	<div id="header">
        <?php
        if (empty($_SESSION['login'])) {
        ?>
            <button class="button buttonConnect" value="connexion" onclick="connect()">Connexion</button>
        <?php
        } else {

        ?>
            <button class="button buttonConnect" value="deconnexion" onclick="disconnect()">Utilisateur : <?= $_SESSION['login'] ?>Déconnexion</button>
        <?php
        }
        ?>
		<div id="entete">
			<div id="logo">
                <?php
                if (empty($_SESSION['login'])) {
                    ?>
                    <img src="image/lebetisier.gif" alt="le logo du betisier">
                    <?php
                } else {
                    ?>
                    <img src="image/smile.jpg" alt="le logo du betisier">
                    <?php
                }
                ?>
			</div>
			<div id="titre">
				Le bétisier de l'IUT,<br />Partagez les meilleures perles !!!
			</div>
		</div>
	</div>
