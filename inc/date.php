<?php
$time=strtotime($_GET['path']);
if(!$time) _die("Invalid Date.");
?>
<html>
  <head>
	<title>Notebook &rarr; <?php echo date("d, M, Y",$time);?></title>
	<link rel="stylesheet" type="text/css" href="<?php _u('/css/skin.css') ?>" />
	<link rel="stylesheet" type="text/css" href="<?php _u('/css/archive.css') ?>" />
  </head>
  <body>
  <div class="title-date"><?php echo date('d',$time); ?><span class="title-month"><?php echo date('M',$time); ?></span><em class="permalink"> <a href="<?php _u("/date/".date("ymd",$time)) ?>">&rarr;</a></em></div>
<hr />
<?php
$result = db('SELECT * FROM public.notes WHERE "time">\''.date('Y-m-d',$time).'\'
		AND "time"<\''.date('Y-m-d',$time+60*60*24).'\'');
show_posts($result);
?>
</body>
</html>
