<?php
$conn_str = '';
foreach($db as $key => $val) {
	$conn_str .= "$key=$val ";
}
function _l($str) {
	global $rel;
	return $rel.$str;
}
function _u($str) {echo _l($str);}

dbug("Connecting using \$conn_str=$conn_str");
$db_conn = pg_connect($conn_str);
function list_latest($num) {
	$result=db('SELECT "time","title","slug" from "public"."notes" ORDER BY "time" DESC LIMIT '.$num);
	include "tpl/post_list.php";
	print_list($result);
}
function db($str) {
	global $db_conn;
	dbug ("Executing: $str");
	return pg_query($db_conn, $str);
}
function tag_cloud (){
	include "tpl/tag_cloud.php";
}
function add_form(){
	include ("tpl/post_form.php");
}
function _die($err_str,$header='') {
	$err_arr=array(
		'404' => 'HTTP/1.0 404 Not Found',
		'bad' => 'HTTP/1.0 503 Bad Request'
		);
	if($header!='' && array_search($header,$err_arr)>=0)
		header($err_arr[$header]);
	include "tpl/error.php";
	die();
}
function show_posts($result) {
	require_once "tpl/post_show.php";
	show_archive($result);	
}
function dbug($str) {
	#echo $str."\n";
}
?>
