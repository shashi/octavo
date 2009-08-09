<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('conf.php');
require_once('templates.php');
if(isset($_GET['redir']) && $_GET['redir']!='') {
  if(is_file('inc/'.$_GET['redir'].'.php')) {
	include 'inc/'.$_GET['redir'].'.php';
	die();
  }
  else {
	_die("<p><strong>Not Found</strong></p>","404");
  }
}
?>
<html>
  <head>
	<title>Notebook</title>
	<link rel="stylesheet" type="text/css" href="<?php _u('/css/skin.css') ?>" />
  </head>
  <body>
	<h1>Notebook</h1>
	<?php list_latest(12); ?>
<?php pg_close($db_conn); ?>
	<div class="tag-cloud">
	<?php tag_cloud(); ?>
	</div>
	<div class="clr"></div>
	<div classs="form">
	<?php add_form(); ?>
	</div>
	<hr/>
	<p>&copy; 2009 Shashi Gowda</p>
  </body>
</html>
