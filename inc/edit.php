<?php
if(isset($_POST['ID']))
	edit_note($_POST['ID']);
$id= $_GET['path'];
if((string)(int)$id!=$id)
	_die("Invalid ID");
$result=db("SELECT * FROM public.\"notes\" WHERE \"ID\" = ".pg_escape_string($_GET['path']));
if(pg_num_rows($result)==0) _die("Does not exists.", "404");
$old=array();
while($row=pg_fetch_assoc($result))
	$old=$row;
function edit_note($id) {
	if((string)(int)$id!=$id)
		_die("Invalid ID");
	include "lib/tags.php";
	$post_data = &$_POST;
	foreach(array('ID','title','contents','tags','time','slug') as $key)
		$post_data[$key]=pg_escape_string(@$post_data[$key]);
	$post_data['tags']=clean_tags($post_data['tags']);
	if(trim($post_data['slug'])=='')
		$post_data['slug']=make_slug($post_data['title']);
	if(!$time=strtotime(@$post_data['time']))
		$time=date("Y-m-d H:i:s O",time());
	else $time=date("Y-m-d H:i:s O",$time);
	$result=db("UPDATE public.\"notes\" SET \"title\" = '{$post_data['title']}',
			\"contents\" ='{$post_data['contents']}', \"tags\" = '{$post_data['tags']}',
			\"slug\" ='{$post_data['slug']}'
			WHERE \"ID\" = ".pg_escape_string($id));
	if($result) {
		if(!rebuild_tags())
			_die("There was an error rebuilding the tag cloud data.
				<a href=\""._l("/edit/$id")."\">Go back &rarr;");
		_die("Edit successfull. <a href=\""._l("/edit/$id")."\">continue editing &rarr;");
	}
	else _die("There was an unexpected error.");
}
?>
<html>
<html>
  <head>
	<title>Notebook &rarr; Edit Note</title>
	<link rel="stylesheet" type="text/css" href="<?php _u('/css/skin.css') ?>" />
	<link rel="stylesheet" type="text/css" href="<?php _u('/css/note.css') ?>" />
  </head>
  <body>
  <div class="title-date">edit</div>
<hr />
<p>
<?php include "tpl/post_edit.php" ?>
</p>
<em>&copy; Shashi Gowda</em>
</body>
</html>
