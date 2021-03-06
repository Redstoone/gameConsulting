<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title","程序升级"); ?><?php $this->output("head","file"); ?>
<div class="tips">欢迎您使用在线升级功能，本工具支持用户配置升级服务器</div>
<script type="text/javascript">
function zip_update()
{
	var url = get_url('update','zip');
	$.dialog.open(url,{
		'title':'<?php echo P_Lang("ZIP包离线升级");?>',
		'lock':true,
		'width':'500px',
		'height':'150px',
		'ok':function(){
			var iframe = this.iframe.contentWindow;
			if (!iframe.document.body) {
				alert(p_lang('iframe还没加载完毕呢'));
				return false;
			};
			iframe.save();
			return false;
		},
		'okVal':p_lang('上传离线包升级'),
		'cancelVal':p_lang('取消'),
		'cancel':function(){return true;}
	});
}
function check_it()
{
	var url = get_url('update','check');
	$.phpok.json(url,function(data){
		if(data.status == 'ok'){
			$.dialog.alert('系统检测到有更新包，建议您升级');
		}else{
			$.dialog.alert(data.content);
		}
	})
}

$(document).ready(function(){
	$("#project li").each(function(i){
		$(this).click(function(){
			var tips = $(this).attr('tips');
			var url = $(this).attr('href');
			var func = $(this).attr('func');
			if(url){
				if(tips){
					$.dialog.confirm(tips,function(){
						$.phpok.go(url);
					})
				}else{
					$.phpok.go(url);
				}
			}else{
				if(func){
					eval(func);
				}
			}
		});
	});
});
</script>
<ul class="project" id="project">
	<?php if($popedom['update']){ ?>
		<?php if($update['online']){ ?>
		<li title="升级PHPOK核心程序" href="<?php echo phpok_url(array('ctrl'=>'update','func'=>'main'));?>" tips="在线升级会连接远程服务器，响应较慢，请耐心等候！<br>不使用在线升级，请点“取消”">
			<div class="img"><img src="images/ico/update.png" /></div>
			<div class="txt">在线升级</div>
		</li>
		<?php } ?>
		<?php if($update['zip']){ ?>
		<li title="ZIP压缩包升级" func="zip_update()">
			<div class="img"><img src="images/ico/zip.png" /></div>
			<div class="txt">压缩包升级</div>
		</li>
		<?php } ?>
		<li title="远程检测是否有升级包" func="check_it()">
			<div class="img"><img src="images/ico/find.png" /></div>
			<div class="txt">远程检测</div>
		</li>

	<?php } ?>
	<?php if($popedom['set']){ ?>
	<li title="配置升级服务器环境" href="<?php echo phpok_url(array('ctrl'=>'update','func'=>'set'));?>">
		<div class="img"><img src="images/ico/setting.png" /></div>
		<div class="txt">升级配置</div>
	</li>
	<?php } ?>
</ul>
<div class="clear"></div>
<?php $this->output("foot","file"); ?>