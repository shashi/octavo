<?php
if(isset($_POST['ID']))
	delete_note($_POST['ID']);
$id= $_GET['path'];
if((string)(int)$id!=$id)
	_die("Invalid ID");
$result=db("SELECT * FROM public.\"notes\" WHERE \"ID\" = ".pg_escape_string($_GET['path']));
if(pg_num_rows($result)==0) _die("Does not exists.", "404");

function delete_note($id) {
	if((string)(int)$id!=$id)
		_die("Invalid ID");
	require_once "lib/tags.php";
	$result=db("DELETE FROM public.\"notes\" WHERE \"ID\" = ".pg_escape_string($id));
	if($result) {
		if(rebuild_tags())
			 _die("Note was purged successfully.");
		else _die("There was an error building the tag cloud data. Please run make_tags.php to fix this.");
	}
	else _die("There was an unexpected error.");
}
?>
<html>
<html>
  <head>
	<title>Notebook &rarr; Delete Note</title>
	<link rel="stylesheet" type="text/css" href="<?php _u('/css/skin.css') ?>" />
	<link rel="stylesheet" type="text/css" href="<?php _u('/css/note.css') ?>" />
  </head>
  <body>
  <div class="title-date">delete | <span class="title-month">oh, really?</span></div>
<hr />
<p><strong>This cannot be undone! Here, take another good look at the note you are about to delete.</strong></p>
<?php show_posts($result); ?>
<p>
<hr />
<em>Now, are you sure you want to go along with this delete?</em>
<form action="<?php _u("/delete"); ?>" method="post">
	<input type="hidden" name="ID" value="<?php echo htmlentities($_GET['path']) ?>" />
	<input type="button" value="No" onClick="window.back()"/>
	<input type="submit" value="Yes" />
</form>
</p>
<em>&copy; Shashi Gowda</em>
</body>
</html>
