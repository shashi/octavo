<?php
$tag=strtolower(trim(htmlentities($_GET['path'])));
$tag=pg_escape_string($tag);
?>
<html>
  <head>
	<title>Notebook &rarr; <?php echo $tag?></title>
	<link rel="stylesheet" type="text/css" href="<?php _u('/css/skin.css') ?>" />
	<link rel="stylesheet" type="text/css" href="<?php _u('/css/archive.css') ?>" />
  </head>
  <body>
  <div class="title-date"><span class="title-month">tag | </span><?php echo $tag ?> <em class="permalink">
	<a href="<?php _u("/tag/$tag") ?>">&deg;</a></em></div>
<hr />
<?php
$result = db('SELECT * FROM public.notes WHERE "tags" ~ \' '.$tag.' \'');
if(pg_num_rows($result)>0)
	show_posts($result);
else {
if($tag!='')
	echo "<p><em>No note tagged so.</em></p><div>";
tag_cloud();
echo "</div>";
}
?>
</body>
</html>
