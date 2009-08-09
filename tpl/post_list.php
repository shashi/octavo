<?php
function print_list($result){
?>
<ul class="archives">
<?php
	while ($row = pg_fetch_assoc($result)) {
		$time=strtotime($row['time']);
		$slug_time=date("y-m-d",$time);
		$title_time=date("D, m/d h:m:a",$time);
		echo "\t<li><a title='$title_time' href='"._l("/date/$slug_time#{$row['slug']}")."'>{$row['title']}</a></li>";
	}
?>
</ul>
<?php }?>
