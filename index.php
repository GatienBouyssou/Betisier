<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("include/functions.inc.php");
require_once("include/config.inc.php");
require_once("classes/Autoloader.class.php");
Classes\Autoloader::register();
require_once("include/header.inc.php");
?>
<div id="corps">
<?php
require_once("include/menu.inc.php");
require_once("include/texte.inc.php");
?>
</div>

<div id="spacer"></div>
<?php
require_once("include/footer.inc.php"); ?>
