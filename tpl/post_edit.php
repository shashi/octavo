<style>
#edit_options{display:none}
.point {cursor:pointer}
input[name=title] {height:30px;font-size:20px;}
</style>
<form action="<?php _u("/edit"); ?>" method="post">
	<input type="hidden" name="ID" value="<?php echo htmlentities($id) ?>" />
		<em>title *</em><br/>
	<input type="text" style="width:80%" name="title" value="<?php echo $old['title'] ?>" />
	<br/><em>* content | </em><small>textile enabled</small><br/>
	<textarea name="contents" style="width:100%;height:100px" id="contents"
		onFocus="this.style.height='200px'"
		onblur="this.style.height='100px'" ><?php echo $old['contents'] ?></textarea>
	<br/><em>tags | </em><small>space seperated</small><br/>
	<input type="text" style="width:80%" name="tags" value="<?php echo $old['tags'] ?>" /><br/>
	<em><a class="point" onClick="document.getElementById('edit_options').style.display='block'">&rarr;</a></em>
	<div id="edit_options">
		<em>slug</em><br/>
		<input type="text" name="slug" style="width:80%" value="<?php echo $old['slug'] ?>" />
		<br/><em>time</em><br/>
		<input type="text" name="time" style="width:80%" value="<?php echo $old['time'] ?>" />
	</div><br/><br/>
	<input type="button" value="Cancel" onClick="window.back()"/>
	<input type="submit" value="Save" />
</form>
