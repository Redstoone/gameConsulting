<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?>		<br />
		<?php echo $app->plugin_html_ap("body");?>
	</div>
	<div class="clear"></div>
</div>
<div class="foot" style="text-align:center;"><?php if($sys['debug']){ ?><?php echo debug_time();?><?php } ?></div>
<?php echo $app->plugin_html_ap("foot");?>
<script type="text/javascript">
$(document).ready(function(){
	var r_menu = [[{
		'text':'<?php echo P_Lang("刷新");?>',
		'func':function(){
			$.phpok.reload();
		}
	}],[{
		'text':"<?php echo P_Lang("清空缓存");?>",
		'func': function() {top.phpok_admin_clear();}
	},{
		'text':'<?php echo P_Lang("修改我的信息");?>',
		'func':function(){top.phpok_admin_control();}
	},{
		'text':'<?php echo P_Lang("访问网站首页");?>',
		'func':function(){
			var url = "<?php echo $sys['www_file'];?>?siteId=<?php echo $session['admin_site_id'];?>";
			url = $.phpok.nocache(url);
			window.open(url);
		}
	}],[{
		'text':'<?php echo P_Lang("网页属性");?>',
		'func':function(){
			var url = window.location.href;
			//去除随机数
			url = url.replace(/\_noCache=[0-9\.]+/g,'');
			if(url.substr(-1) == '&' || url.substr(-1) == '?'){
				url = url.substr(0,url.length-1);
			}
			top.$.dialog({
				'title':'<?php echo P_Lang("网址属性");?>',
				'content':'<?php echo P_Lang("网址：");?>'+url+'<br /><div style="text-indent:36px"><a href="'+url+'" target="_blank" class="red"><?php echo P_Lang("新窗口打开");?></a></div>',
				'lock':true,
				'drag':false,
				'fixed':true
			});
		}
	},{
		'text': "<?php echo P_Lang("新窗口打开");?>",
		'func': function() {
			var url = window.location.href;
			//去除随机数
			url = url.replace(/\_noCache=[0-9\.]+/g,'');
			if(url.substr(-1) == '&' || url.substr(-1) == '?'){
				url = url.substr(0,url.length-1);
			}
			window.open(url);
		}    
	},{
		'text': "<?php echo P_Lang("显示桌面");?>",
		'func': function() {top.$.desktop.tohome();}
	}],[{
		'text': "<?php echo P_Lang("帮助说明");?>",
		'func': function() {
			var url = window.location.href;
			//去除随机数
			url = url.replace(/\_noCache=[0-9\.]+/g,'');
			if(url.substr(-1) == '&' || url.substr(-1) == '?'){
				url = url.substr(0,url.length-1);
			}
			var tip = '<?php echo P_Lang("网址：");?>'+url+'<br /><div style="text-indent:36px"><a href="'+url+'" target="_blank" class="red"><?php echo P_Lang("新窗口打开");?></a></div>';
			tip += '<div style="text-indent:36px"><?php echo P_Lang("复制请按快捷键：CTRL+C，粘贴请使用：CTRL+V");?></div>';
			top.$.dialog({
				'title':'<?php echo P_Lang("帮助说明");?>',
				'content':tip,
				'lock':true,
				'drag':false,
				'fixed':true
			});
		}
	}]];
	$(window).smartMenu(r_menu,{
		'name':'smart',
		'textLimit':8
	});
});
</script>
<?php echo $app->plugin_html_ap("phpokbody");?></body>
</html>