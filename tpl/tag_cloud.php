<?php
$tags=unserialize(file_get_contents("ser/tags.ser"));
$threshold=15;
$max=30;
foreach($tags['tags'] as $tag => $count) {
	$size=(int)((($count-$tags['min']) *($max-$threshold) / $tags['max'])+$threshold);
	echo " <span style='font-size:{$size}px;'><a href=\""._l("/tag/$tag")."\">$tag</a></span>";
}
?>
