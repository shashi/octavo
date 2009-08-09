<?php
function delete_tags($id) {
	$tags=db("SELECT tags from public.notes WHERE \"ID\"=".pg_escape_string($id));
	if(pg_num_rows($tags)==0) _die("Does not exists.", "404");
	$row=pg_fetch_assoc($tags);
	$tags=trim($row['tags']);
	$tags=explode(' ',$tags);
	$tags_data=unserialize(file_get_contents("ser/tags.ser"));
	foreach($tags as $tag) {
		$tags_data['tags'][$tag]-=1;
		if($tags_data['tags'][$tag]==0)
			unset($tags_data['tags'][$tag]);
	}
	$tags_data['max']=max($tags_data);
	$tags_data['min']=min($tags_data);
	$tags_data['total']=array_sum($tags_data);
	file_put_contents("ser/tags.ser",serialize($tags_data));
}
function reform_tags($note_id,$new_tags) {
}
function add_tags($tags_str) {
	$tags=unserialize(file_get_contents("ser/tags.ser"));
	$tags_arr=explode(' ',trim($tags_str));  #need to trim here
	foreach($tags_arr as $tag) {
		@$tags['tags'][$tag]+=1;
		if($tags['tags'][$tag]>$tags['max']) $tags['max'] = $tags['tags'][$tag];
		if($tags['tags'][$tag]<$tags['min']) $tags['min'] = $tags['tags'][$tag];
	}
	$tags['total']+=count($tags_arr);
	return file_put_contents("ser/tags.ser",serialize($tags));
}
function clean_tags($tags_str) {
	$tags_str=strtolower($tags_str);
	$tags=explode(' ', $tags_str);
	$tags_str='';
	foreach($tags as $tag){
	   if($tag!='') {
		$arr=array("&","#",".","=","'","\"");
		foreach($arr as $char)
			$tag=str_replace($char,"",$tag);
		$tags_str.="$tag ";
	    }
	}
	return ' '.$tags_str; # DONT Trim this!!
}
function rebuild_tags() {
	$result=db('SELECT "tags" FROM "public"."notes"');
	$tags=array('tags'=>array(), 'max'=>1, 'min'=>0, 'total'=>0);
	while($row=pg_fetch_assoc($result)) {
		$post_tags=explode(' ',trim($row['tags']));
		foreach($post_tags as $tag){
			if($tag!='')
				@$tags['tags'][$tag]+=1;
		}
	}
	// Statistcs
	foreach($tags['tags'] as $count) {
		$tags['total']+=$count;
		if($count>$tags['max']) $tags['max']=$count;
		if($count<$tags['min']) $tags['min']=$count;
	}
	ksort($tags['tags']);
	if (file_put_contents("ser/tags.ser",serialize($tags)))
		return true;
	else return false;
}
?>
