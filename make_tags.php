<?php
/*
 * This script should be run once in a while to make sure that
 * tag cloud cache is intact.
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('conf.php');
require_once('templates.php');
require_once('lib/tags.php');
if (rebuild_tags())
	echo "Done.";
else echo "Fail.";
?>
