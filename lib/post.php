<?php
// Function for cleaning tags
// SELECT to_char('2008-04-11 05:52:09.234-04'::timestamp with time zone,'Day, Mon DD, YYYY HH12:MIam TZ')
function make_slug($title) {
	return substr(md5($title),0,5);
}
function untextile($text) {
	// unused now :)
}
?>
