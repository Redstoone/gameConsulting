<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="Expires" content="wed, 26 feb 1997 08:21:57 GMT" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php if($config['title']){ ?><?php echo $config['title'];?> - <?php } ?><?php echo P_Lang("后台管理");?></title>
	<link rel="stylesheet" type="text/css" href="css/css.php?type=admin" />
	<script type="text/javascript" src="<?php echo phpok_url(array('ctrl'=>'js','ext'=>'admin.index'));?>"></script>
	<?php echo $app->plugin_html_ap("head");?>
<?php echo $app->plugin_html_ap("phpokhead");?></head>

<body>
<div class="header">
	<div class="logo"><a href="<?php echo $sys['admin_file'];?>" title="<?php echo $config['title'];?>"><img src="<?php echo $config['adm_logo29'] ? $config['adm_logo29'] : 'images/logo.jpg';?>" alt="<?php echo $config['title'];?>" height="45px" /></a></div>
	<div class="head_user head_tool" onclick="$.admin_index.logout()" title="<?php echo P_Lang("管理员退出");?>"><img class="head_user_img" src="images/logout.png" alt="<?php echo P_Lang("管理员退出");?>" /></div>
	<div class="head_tool head_list" id="top-menu-icon">
		<a href="javascript:;" class="head_list_link" id="top-menu-a" title="<?php echo P_Lang("功能菜单");?>"></a>
		<div class="header-tc-content" id="top-menu">
			<span class="header-tc-ct-bg"></span>
			<ul class="first_ul">
				<?php $menulist_id["num"] = 0;$menulist=is_array($menulist) ? $menulist : array();$menulist_id = array();$menulist_id["total"] = count($menulist);$menulist_id["index"] = -1;foreach($menulist as $key=>$value){ $menulist_id["num"]++;$menulist_id["index"]++; ?>
				<li<?php if($menulist_id['num'] == $menulist_id['total']){ ?> class="laster_line"<?php } ?> name="subtree">
					<a href="javascript:void(0);" ><?php echo P_Lang($value['title']);?></a>
					<div class="second_ul" style="display:none;">
						<span class="arrow_right"></span>
						<ul>
							<?php $sub_id["num"] = 0;$value['sublist']=is_array($value['sublist']) ? $value['sublist'] : array();$sub_id = array();$sub_id["total"] = count($value['sublist']);$sub_id["index"] = -1;foreach($value['sublist'] as $k=>$v){ $sub_id["num"]++;$sub_id["index"]++; ?>
							<li<?php if($sub_id['num'] == $sub_id['total']){ ?> class="laster_line"<?php } ?>><a href="javascript:$.win('<?php echo P_Lang($v['title']);?>','<?php echo $v['url'];?>');void(0);"><?php echo P_Lang($v['title']);?></a></li>
							<?php } ?>
						</ul>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div class="head_tool head_desktop"><a href="javascript:$.desktop.tohome();void(0);" class="head_desktop_link" title="<?php echo P_Lang("显示桌面");?>"></a></div>
	<div class="head_tool head_config"><a href="javascript:$.admin_index.me();void(0);" class="head_config_link" title="<?php echo P_Lang("修改个人信息");?>"></a></div>
	<div class="head_web">
		<span class="clear_cache" onclick="$.admin_index.clear()"><?php echo P_Lang("清空缓存");?></span>
		<span class="gohome"><a href="<?php echo $sys['www_file'];?>?siteId=<?php echo $session['admin_site_id'];?>" target="_blank" title="<?php echo P_Lang("访问网站");?>"><?php echo P_Lang("访问网站");?></a></span>
		<?php if($sitelist && count($sitelist)>1){ ?>
		<span class="leftspan"><?php echo P_Lang("网站：");?></span>
		<select class="web_select" name="top_site_id" id="top_site_id" onchange="goto_site(this.value,<?php echo $session['admin_site_id'];?>)">
			<?php $sitelist_id["num"] = 0;$sitelist=is_array($sitelist) ? $sitelist : array();$sitelist_id = array();$sitelist_id["total"] = count($sitelist);$sitelist_id["index"] = -1;foreach($sitelist as $key=>$value){ $sitelist_id["num"]++;$sitelist_id["index"]++; ?>
			<option value="<?php echo $value['id'];?>"<?php if($value['id'] == $session['admin_site_id']){ ?> selected<?php } ?>><?php echo $value['alias'] ? $value['alias'] : $value['title'];?></option>
			<?php } ?>
		</select>
			<?php if($session['admin_rs']['if_system'] && $session['adm_develop']){ ?><a href="javascript:add_site();void(0);" class="web_add" title="<?php echo P_Lang("添加新站点");?>"></a><?php } ?>
		<?php } ?>
		<ul class="head_tab" id="phpok-taskbar"></ul>
	</div>
</div>

<div class="content"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<?php if($iconlist){ ?>
	<td valign="top" width="180px">
	<div class="c_left">
		<ul>
			<?php $iconlist_id["num"] = 0;$iconlist=is_array($iconlist) ? $iconlist : array();$iconlist_id = array();$iconlist_id["total"] = count($iconlist);$iconlist_id["index"] = -1;foreach($iconlist as $k=>$v){ $iconlist_id["num"]++;$iconlist_id["index"]++; ?>
			<li appfile="<?php echo $v['appfile'];?>"><a href="javascript:$.win('<?php echo P_Lang($v['title']);?>','<?php echo $v['url'];?>');void(0);"><span class="icon-<?php echo $v['icon'];?>"></span><?php echo P_Lang($v['title']);?></a></li>
			<?php } ?>
		</ul>
	</div>
	</td>
	<?php } ?>
	<td valign="top"><div class="index_main"<?php if(!$iconlist){ ?> style="margin-left:10px"<?php } ?>>
		<?php if($all_info){ ?>
		<div class="sub_box" id="all_setting">
			<div class="box_item">
				<ul>
					<?php if($all_popedom['site']){ ?>
					<li><a title="<?php echo P_Lang("配置网站信息，包括网址域名，布全局关键字等");?>" href="javascript:$.win('<?php echo P_Lang("网站信息");?>','<?php echo phpok_url(array('ctrl'=>'all','func'=>'setting'));?>');void(0);">
						<div class="top_img"><img src="images/ico/setting.png" alt="<?php echo P_Lang("网站信息");?>" class="ie6png" width="48" height="48" /></div>
						<div class="name"><?php echo P_Lang("网站信息");?></div></a>
					</li>
						<?php if($show_vcode_setting){ ?>
						<li><a title="<?php echo P_Lang("验证码开启或关闭设置");?>" href="javascript:$.win('<?php echo P_Lang("验证码配置");?>','<?php echo phpok_url(array('ctrl'=>'all','func'=>'vcode'));?>');void(0);">
							<div class="top_img"><img src="images/ico/setting2.png" alt="<?php echo P_Lang("验证码配置");?>" class="ie6png" width="48" height="48" /></div>
							<div class="name"><?php echo P_Lang("验证码");?></div></a>
						</li>
						<?php } ?>
					<?php } ?>
					<?php if($all_popedom['domain']){ ?>
					<li><a title="<?php echo P_Lang("网站可以绑定的域名");?>" href="javascript:$.win('<?php echo P_Lang("网站域名");?>','<?php echo phpok_url(array('ctrl'=>'all','func'=>'domain'));?>');void(0);">
						<div class="top_img"><img src="images/ico/alias.png" alt="<?php echo P_Lang("网站域名");?>" class="ie6png" width="48" height="48" /></div>
						<div class="name"><?php echo P_Lang("网站域名");?></div></a>
					</li>
					<?php } ?>
					<?php if($site_popedom['order'] && $config['biz_status']){ ?>
					<li><a title="<?php echo P_Lang("订单常规配置");?>" href="javascript:$.win('<?php echo P_Lang("订单常规配置");?>','<?php echo phpok_url(array('ctrl'=>'site','func'=>'order_status'));?>');void(0);">
						<div class="top_img"><img src="images/ico/shopping_setting.png" alt="<?php echo P_Lang("订单常规配置");?>" class="ie6png" width="48" height="48" /></div>
						<div class="name"><?php echo P_Lang("订单常规配置");?></div></a>
					</li>
					<?php } ?>
					<?php $tmpid["num"] = 0;$plugin_alist=is_array($plugin_alist) ? $plugin_alist : array();$tmpid = array();$tmpid["total"] = count($plugin_alist);$tmpid["index"] = -1;foreach($plugin_alist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
					<li><a title="<?php echo $value['title'];?>" href="javascript:$.win('<?php echo $value['title'];?>','<?php echo $value['url'];?>');void(0);">
						<div class="top_img"><img src="<?php echo $value['ico'];?>" class="ie6png" alt="<?php echo $value['title'];?>" width="48" height="48" /></div>
						<div class="name"><?php echo $value['title'];?></div></a>
					</li>
					<?php } ?>
					<?php if($all_popedom['gset'] || $all_popedom['set']){ ?>
					<?php $all_rslist_id["num"] = 0;$all_rslist=is_array($all_rslist) ? $all_rslist : array();$all_rslist_id = array();$all_rslist_id["total"] = count($all_rslist);$all_rslist_id["index"] = -1;foreach($all_rslist as $key=>$value){ $all_rslist_id["num"]++;$all_rslist_id["index"]++; ?>
					<li><a title="<?php echo $value['title'];?>" href="javascript:$.win('<?php echo $value['title'];?>','<?php echo phpok_url(array('ctrl'=>'all','func'=>'set','id'=>$value['id']));?>');void(0);">
						<div class="top_img"><img src="<?php echo $value['ico'];?>" class="ie6png" alt="<?php echo $value['title'];?>" width="48" height="48" /></div>
						<div class="name"><?php echo $value['title'];?></div></a>
					</li>
					<?php } ?>
					<?php if($session['admin_rs']['if_system'] && $session['adm_develop']){ ?><li class="plus" onclick="$.win('<?php echo P_Lang("全局内容");?>','<?php echo phpok_url(array('ctrl'=>'all','func'=>'gset'));?>')"></li><?php } ?>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php } ?>
		<?php if($list_rslist){ ?>
		<div class="sub_box" id="list_setting">
			<div class="title"><span class="maintain"><?php echo P_Lang("内容管理");?></span></div>
			<div class="box_item">
				<ul>
					<?php $list_rslist_id["num"] = 0;$list_rslist=is_array($list_rslist) ? $list_rslist : array();$list_rslist_id = array();$list_rslist_id["total"] = count($list_rslist);$list_rslist_id["index"] = -1;foreach($list_rslist as $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
					<li pid="<?php echo $value['id'];?>"><a title="<?php echo $value['title'];?>" href="javascript:$.win('<?php echo $value['title'];?>','<?php echo $value['url'];?>');void(0);">
						<div class="top_img"><img src="<?php echo $value['ico'] ? $value['ico'] : 'images/ico/default.png';?>" class="ie6png" alt="<?php echo $value['title'];?>" width="48" height="48" /></div>
						<div class="name"><?php echo $value['nick_title'] ? $value['nick_title'] : $value['title'];?></div></a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php } ?>
		<?php if($sys['multiple_language'] && $langlist){ ?>
		<div style="float:right;"><?php echo P_Lang("语言");?>
			<select onchange="$.admin_index.lang(this.value)" style="padding:3px;">
				<?php $tmpid["num"] = 0;$langlist=is_array($langlist) ? $langlist : array();$tmpid = array();$tmpid["total"] = count($langlist);$tmpid["index"] = -1;foreach($langlist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
				<option value="<?php echo $key;?>"<?php if($key == $session['admin_lang_id']){ ?> selected<?php } ?>><?php echo $value;?></option>
				<?php } ?>
			</select>
		</div>
		<?php } ?>
		<div class="clear"></div>
	</div></td>
</tr>

</table>
	<?php echo $app->plugin_html_ap("body");?>
	<div class="clear"></div>
</div>
<?php echo $app->plugin_html_ap("foot");?>
<div class="foot">
	<div class="foot_left">
		<?php if($app->license_powered){ ?>
		Powered by <a href="http://www.phpok.com" target="_blank">phpok.com</a>,
		<?php } ?>
		CopyRight &copy; <?php echo $license_site;?> <?php echo license_date();?>, All Right Reserved.
		<br /><?php echo debug_time();?>
	</div>
	<div class="foot_right"><span class="darkblue"><?php echo $license;?></span><?php echo P_Lang("，版本：");?><?php echo $version;?></div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$.win2.init({'close_tip':'<?php echo $session['admin_rs']['close_tip'];?>'});
});
</script>
<?php echo $app->plugin_html_ap("phpokbody");?></body>
</html>
