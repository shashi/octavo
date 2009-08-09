<?php

// A simple example
function init_tex(){
	require_once('lib/textile.php');
	global $tex;
	$tex = new Textile();
}
function show_post($row) {
	global $tex;
	echo "
	<div class=\"note\" id=\"{$row['slug']}\">
	<h2>{$row['title']}</h2>";
	echo '<div class="note-meta">'.date("M j g:ma e",strtotime($row['time'])).
		' tags:';
	tags_linked($row['tags']); echo 
		" (<a title=\"Slug Link\" href=\""._l("/archive/{$row['slug']}").
		"\">link</a>|<a title=\"Permalink\" href=\""._l("/archive/{$row['ID']}/id").
		"\">p</a>|<a title=\"Edit\" href=\""._l("/edit/{$row['ID']}").
		"\">e</a>|<a title=\"Delete\" href=\""._l("/delete/{$row['ID']}")."\">d</a>)</div>";

	echo '<div class="note-content">'.$tex->TextileThis($row['contents']).'</div></div>';
}
function tags_linked($str) {
	$tags=explode(' ', $str);
	foreach($tags as $tag)
		echo " <a href=\""._l("/tag/$tag")."\">$tag</a>";
}
function show_archive($result) {
	init_tex();
	while($row=pg_fetch_assoc($result))
		show_post($row);
}
#echo $textile->TextileThis($in);

// For untrusted user input, use TextileRestricted instead:
// echo $textile->TextileRestricted($in);


?>
