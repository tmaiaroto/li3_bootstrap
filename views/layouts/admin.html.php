<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
	<?php echo $this->html->charset();?>
	<?php $title = $this->title() ? $this->title():''; ?>
	<title><?=$title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<?php 
		echo $this->html->style(array('bootstrap.min.css', 'bootstrap-responsive.min.css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css', 'jquery/tipsy.css', 'admin'), array('inline' => false));	
	?>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>!window.jQuery && document.write('<script src="/js/jquery/jquery-1.7.2.min.js"><\/script>')</script>	
	<?php
		echo $this->html->script(array('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js', 'jquery/jquery.tipsy.js', 'tiny_mce/jquery.tinymce.js', 'bootstrap.min.js', 'tiny_mce/jquery.tinymce.js'), array('inline' => false));
	?>
	<?php
		echo $this->scripts();
		echo $this->styles();
	?>
	<?php // because there is a navbar. this adds spacing ?>
	<style type="text/css">
		body {
			padding-top: 60px;
			padding-bottom: 40px;
		}
	</style>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body>
	<?=$this->_render('element', 'admin_navbar', array('user' => $this->request()->user)); ?>
	<div class="container">
		<?php echo $this->content(); ?>
		<?=$this->_render('element', 'footer'); ?>
	</div><!--/.container-->
	<script type="text/javascript">
		$(function() {
			$('.dropdown-toggle').dropdown()
			
			$('textarea.tinymce').tinymce({
				// Location of TinyMCE script
				script_url : '/js/tiny_mce/tiny_mce.js',
				// General options
				theme : "advanced",
				plugins : "style,table,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,xhtmlxtras",
				// Theme options
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,|,code,fullscreen",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,
				theme_advanced_resize_horizontal : false,
				
				width: '675',
				
				// Example content CSS (should be your site CSS)
				content_css : "css/content.css,/css/content.css"
			});
		});
	</script>
	<?=$this->html->flash(); ?>
</body>
</html>