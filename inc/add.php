<?php
/* Adds a post to the database */
if(!(isset($_POST) && @$_POST['title']!='')) {
	_die("tpl/post_form.html");
}
include "lib/post.php";
include "lib/tags.php";
$post_data = &$_POST;
foreach(array('title','contents','tags','time','slug') as $key)
	$post_data[$key]=pg_escape_string(@$post_data[$key]);

$post_data['tags']=clean_tags($post_data['tags']);
if(trim($post_data['slug'])=='')
	$post_data['slug']=make_slug($post_data['title']);
if(!$time=strtotime(@$post_data['time']))
	$time=date("Y-m-d H:i:s O",time());
else $time=date("Y-m-d H:i:s O",$time);

if(db('INSERT INTO "public"."notes" ("title", "contents", "slug", "tags", "time") VALUES ('."
	'{$post_data['title']}','{$post_data['contents']}','{$post_data['slug']}','{$post_data['tags']}','{$time}' )")) {
	add_tags($post_data['tags']);
	header('Location: '._l("/archive/{$_POST['slug']}"));
}
else _die("Some error occoured. Try again.");
?>
