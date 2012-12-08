<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="shortcut icon" type="image/ico" href="icon.png" />
<link rel="stylesheet" type="text/css" media="all" href="base.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
function cssgrid-resize(){
	$('div.container div.container').each(function(){
		var width = $(this).parent().width();
		$('.container-f', $(this).parent()).each(function(){
			width -= $(this).width();
		});
		//alert(width);
		$(this).css('width', width + 'px')
	});
}
jQuery(document).ready(function(){
	//cssgrid-resize();
});
</script>
</head>
<body>
<div class="container">
  <div class="grid-20"><br />
    Main Grid of 20<br />
    <div id="sidebar1" class="container-f bg2">Sidebar 1</div>
    <div class="container">
      <div class="grid-20 bg0">20</div>
      <br class="clear" />
      <?php for($i=1; $i < 20; $i++):?>
      <br />
      <div class="grid-<?php echo $i;?> bg<?php echo $i%3; ?>"><?php echo $i;?></div>
      <div class="grid-<?php echo 20-$i;?> bg<?php echo ($i+2)%3; ?>"><?php echo 20-$i;?></div>
      <br class="clear" />
      <?php endfor;?>
    </div>
    <div id="sidebar2" class="container-f bg1">Sidebar 2</div>
  </div>
  <br class="clear" />
  <br />
  <hr />
  <br />
  <div class="grid-20 bg0">20</div>
  <br class="clear" />
  <?php for($i=1; $i < 20; $i++):?>
  <br />
  <div class="grid-<?php echo $i;?> bg<?php echo $i%3; ?>"><?php echo $i;?></div>
  <div class="grid-<?php echo 20-$i;?> bg<?php echo ($i+2)%3; ?>"><?php echo 20-$i;?></div>
  <br class="clear" />
  <?php endfor;?>
  <br />
</div>
</body>
</html>
