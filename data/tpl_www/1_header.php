<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
	<meta http-equiv="Cache-control" content="no-cache,no-store,must-revalidate" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="-1" />
	<meta name="renderer" content="webkit">
	<title><?php if($title){ ?><?php echo $title;?> - <?php } ?><?php echo $config['title'];?><?php if($seo['title']){ ?> - <?php echo $seo['title'];?><?php } ?></title>
	<?php if($seo['keywords']){ ?><meta name="keywords" content="<?php echo $config['keywords'];?>" /><?php } ?>
	<?php if($seo['desc']){ ?><meta name="description" content="<?php echo $config['desc'];?>" /><?php } ?>
	<meta name="toTop" content="true" />
	<base href="<?php echo $sys['url'];?>" />
	<link rel="stylesheet" type="text/css" href="tpl/www/css/amazeui.min.css" />
	<link rel="stylesheet" type="text/css" href="css/artdialog.css" />
	<link rel="stylesheet" type="text/css" href="tpl/www/css/style.css" />
	<?php if($css){ ?>
	<?php $csslist = explode(",",$css);?>
	<?php $tmpid["num"] = 0;$csslist=is_array($csslist) ? $csslist : array();$tmpid = array();$tmpid["total"] = count($csslist);$tmpid["index"] = -1;foreach($csslist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $value;?>" />	
	<?php } ?>
	<?php } ?>
	<script type="text/javascript" src="<?php echo phpok_url(array('ctrl'=>'js','ext'=>'jquery.artdialog'));?>" charset="utf-8"></script>
	<script type="text/javascript" src="tpl/www/js/amazeui.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="tpl/www/js/global.js" charset="utf-8"></script>
	<?php if($js){ ?>
	<?php $jslist = explode(",",$js);?>
	<?php $tmpid["num"] = 0;$jslist=is_array($jslist) ? $jslist : array();$tmpid = array();$tmpid["total"] = count($jslist);$tmpid["index"] = -1;foreach($jslist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
	<script type="text/javascript" src="<?php echo $value;?>" charset="utf-8"></script>
	<?php } ?>
	<?php } ?>
<?php echo $app->plugin_html_ap("phpokhead");?></head>
<body>