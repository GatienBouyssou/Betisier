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
            require_once('js/fonction.inc.php');
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
            Utilisateur :<em> <?php echo $_SESSION['login'] ?></em>
            <button class="button buttonConnect" value="deconnexion" onclick="disconnect()">Déconnexion</button>
        <?php
        }
        ?>
		<div id="entete">
			<div id="logo">

			</div>
			<div id="titre">
				Le bétisier de l'IUT,<br />Partagez les meilleures perles !!!
			</div>
		</div>
	</div>
