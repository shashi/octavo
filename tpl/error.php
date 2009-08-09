<html>
  <head>
	<title>Notebook &raquo; Error</title>
	<link rel="stylesheet" type="text/css" href="<?php _u('/css/skin.css')?>" />
  </head>
  <body>
	<h1>Notebook</h1>
	<div><?php if(is_file($err_str)) include $err_str; else echo $err_str;?>
	</div>
	<hr/>
	<p>&copy; 2009 Shashi Gowda</p>
  </body>
</html>
