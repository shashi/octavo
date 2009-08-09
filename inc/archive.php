<?php
$path = $_GET['path'];
$id = explode('/',$path);
if(@$id[1]=='id') {
	if((string)(int)$id[0]!=$id[0])
		_die("Invalid ID");
	else {
		$id=$id[0];
		$result=db("SELECT * FROM public.\"notes\" WHERE \"ID\" = $id");
		$title=db("SELECT \"title\" FROM public.\"notes\" WHERE \"ID\" = $id");
	}
}
elseif(count($id)==1) {
	// Show post by slug
	$result=db("SELECT * FROM public.\"notes\" WHERE \"slug\" = '".pg_escape_string($id[0])."'");
	$title=db("SELECT \"title\" FROM public.\"notes\" WHERE \"slug\" = '".pg_escape_string($id[0])."'");

}
else _die("Bad Request","bad");
if(pg_num_rows($result)==0) _die("Does not exists.", "404");
?>
<html>
<html>
  <head>
	<title>Notebook &rarr; <?php while($row=pg_fetch_assoc($title)) {$title=$row['title'];break;} echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php _u('/css/skin.css') ?>" />
	<link rel="stylesheet" type="text/css" href="<?php _u('/css/note.css') ?>" />
  </head>
  <body>
  <div class="title-date">post | <span class="title-month"><?php echo $id[0] ?></span></div>
<hr />
<?php show_posts($result); ?>
<em>&copy; Shashi Gowda</em>
</body>
</html>
