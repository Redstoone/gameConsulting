<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $code_editor_info = form_edit('meta',$rs['meta'],'code_editor','width=650&height=200');?>
<?php $this->output("head","file"); ?>
<script type="text/javascript" src="<?php echo include_js('all.js');?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	top.$.desktop.title('<?php echo P_Lang("网站信息");?>');
});
function rand_click()
{
	var $chars = 'ABCDEFGHIJKMNOPQRSTUVWXYZabcdefghijkmnopqrstuwxyz0123456789!@#%-_*';
	var maxPos = $chars.length;
	var pwd = '';
	for (i = 0; i < 16; i++) {
		pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
	}
	$("#api_code").val(pwd);
}
</script>
<div class="tips clearfix">
	<?php echo P_Lang("您当前的位置：");?>
	<a href="<?php echo admin_url('all');?>"><?php echo P_Lang("全局维护");?></a>
	&raquo; <?php echo P_Lang("编辑网站信息");?>
</div>
<div class="body">
<ul class="group">
	<li class="on" onclick="$.admin.group(this)" name="main" title="<?php echo P_Lang("网站基本信息");?>"><?php echo P_Lang("基本设置");?></li>
	<li onclick="$.admin.group(this)" name="admin" title="<?php echo P_Lang("开关网站，设置风格，语言等功能");?>"><?php echo P_Lang("扩展信息");?></li>
	<li onclick="$.admin.group(this)" name="seo" title="<?php echo P_Lang("全站SEO信息设置");?>"><?php echo P_Lang("SEO优化");?></li>
	<li onclick="$.admin.group(this)" name="biz" title="<?php echo P_Lang("启用电子商务功能");?>"><?php echo P_Lang("电子商务");?></li>
	<li onclick="$.admin.group(this)" name="upload" title="<?php echo P_Lang("配置游客和会员的上传属性");?>"><?php echo P_Lang("上传配置");?></li>
</ul>

<form method="post" id="cate_post" action="<?php echo admin_url('all','save');?>" onsubmit="return all_setting_check();">
<div id="main_setting">
<div class="table">
	<div class="title">
		<?php echo P_Lang("网站名称：");?>
		<span class="note"><?php echo P_Lang("即在前台使用的名称信息");?></span></span>
	</div>
	<div class="content">
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><input type="text" id="title" name="title" class="default" value="<?php echo $rs['title'];?>" /></td>
			<td><div id="title_note"></div></td>
		</tr>
		</table>
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("域名：");?>
		<span class="note"><?php echo P_Lang("网站域名，不用填写http://，也不能填写 / 结束符");?></span></span>
	</div>
	<div class="content"><input type="text" id="domain" name="domain" class="default" value="<?php echo $rs['domain'];?>" /></div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("安装目录");?>
		<span class="note"><?php echo P_Lang("根目录请用 /，其他目录请写目录名且要求以 / 结束，如：/phpok/");?></span></span>
	</div>
	<div class="content">
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><input type="text" id="dir" name="dir" class="default" value="<?php echo $rs['dir'];?>" /></td>
			<td><div id="title_note"></div></td>
		</tr>
		</table>
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("网站版LOGO");?>
		<span class="note"><?php echo P_Lang("绑定网站的LOGO信息");?></span></span>
	</div>
	<div class="content">
		<ul class="layout">
			<li><input type="text" id="logo" name="logo" class="default" value="<?php echo $rs['logo'];?>" /></li>
			<li>
				<div class="button-group">
					<input type="button" value="<?php echo P_Lang("选择");?>" onclick="phpok_pic('logo')" class="phpok-btn" />
					<input type="button" value="<?php echo P_Lang("预览");?>" onclick="phpok_pic_view('logo')" class="phpok-btn" />
					<input type="button" value="<?php echo P_Lang("清空");?>" onclick="$('#logo').val('');" class="phpok-btn" />
				</div>
			</li>
		</ul>
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("手机版LOGO");?>
		<span class="note"><?php echo P_Lang("绑定网站的手机版Logo");?></span></span>
	</div>
	<div class="content">
		<ul class="layout">
			<li><input type="text" id="logo_mobile" name="logo_mobile" class="default" value="<?php echo $rs['logo_mobile'];?>" /></li>
			<li>
				<div class="button-group">
					<input type="button" value="<?php echo P_Lang("选择");?>" onclick="phpok_pic('logo_mobile')" class="phpok-btn" />
					<input type="button" value="<?php echo P_Lang("预览");?>" onclick="phpok_pic_view('logo_mobile')" class="phpok-btn" />
					<input type="button" value="<?php echo P_Lang("清空");?>" onclick="$('#logo_mobile').val('');" class="phpok-btn" />
				</div>
			</li>
		</ul>
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("API验证串：");?>
		<span class="note"><?php echo P_Lang("用于数据加密通迅时使用，建议定期更改");?></span>
	</div>
	<div class="content">
		<input type="text" id="api_code" name="api_code" class="default" value="<?php echo $rs['api_code'];?>" />
		<input type="button" value="<?php echo P_Lang("随机生成");?>" onclick="rand_click()" class="phpok-btn" />
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("网页扩展说明：");?>
		<span class="note"><?php echo P_Lang("添加页头信息，如添加google验证，百度验证等，支持HTML");?></span>
	</div>
	<div class="content">
		<?php echo $code_editor_info;?>
	</div>
</div>
</div>
<div id="seo_setting" class="hide">
<div class="table">
	<div class="title">
		网址优化：
		<span class="note">本系统全面支持网址优化，您可以根据自身条件进行设置</span>
	</div>
	<div class="content">
		<table>
		<tr>
			<td><label><input type="radio" name="url_type" value="default"<?php if($rs['url_type'] == "default" || !$rs['url_type']){ ?> checked<?php } ?> /> <?php echo P_Lang("默认，动态网址");?></label></td>
			<td class="gray"><?php echo P_Lang("示例：");?>http://www.domain.com/index.php?id=<?php echo P_Lang("标识或数字ID");?></td>
		</tr>
		<tr>
			<td><label><input type="radio" name="url_type" value="rewrite"<?php if($rs['url_type'] == "rewrite"){ ?> checked<?php } ?> /> <?php echo P_Lang("伪静态页");?></label></td>
			<td class="gray"><?php echo P_Lang("示例：");?>http://www.domain.com/<?php echo P_Lang("标识或数字ID");?>.html</td>
		</tr>
		</table>
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("SEO标题：");?>
		<span class="note"><?php echo P_Lang("针对HTML里的Title属性进行优化，建议使用英文竖线分割开来，不超过80字");?></span></span>
	</div>
	<div class="content">
		<input type="text" id="seo_title" name="seo_title" class="long100" value="<?php echo $rs['seo_title'];?>" />
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("SEO关键字：");?>
		<span class="note"><?php echo P_Lang("简单明了用几个词来描述您的网站，多个词用英文逗号隔开");?></span></span>
	</div>
	<div class="content">
		<input type="text" id="seo_keywords" name="seo_keywords" class="long100" value="<?php echo $rs['seo_keywords'];?>" />
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("SEO摘要：");?>
		<span class="note"><?php echo P_Lang("针对您的网站，简单描述其作用，目标群体，未来方向等信息，建议不超过100字");?></span>
	</div>
	<div class="content"><textarea id="seo_desc" name="seo_desc" class="long100"><?php echo $rs['seo_desc'];?></textarea></div>
</div>
</div>
<input type="hidden" name="api" id="" value="0" />

<div id="admin_setting" class="hide">
<div class="table">
	<div class="title">
		<?php echo P_Lang("网站状态：");?>
		<span class="note"><?php echo P_Lang("要停止此网站运行，请在这里关闭");?></span>
	</div>
	<div class="content">
		<table>
		<tr>
			<td><label id="status_0"><input type="radio" id="status_0" name="status" value="0" <?php if(!$rs['status']){ ?> checked<?php } ?> /> <?php echo P_Lang("关闭");?></label></td>
			<td><label id="status_1"><input type="radio" id="status_1" name="status" value="1" <?php if($rs['status']){ ?> checked<?php } ?> /> <?php echo P_Lang("开启");?></label></td>
		</tr>
		</table>
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("网站关闭说明：");?>
		<span class="note"><?php echo P_Lang("简单说明关闭网站的通知信息");?></span>
	</div>
	<div class="content"><textarea id="content" name="content" class="long"><?php echo $rs['content'];?></textarea></div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("默认风格：");?>
		<span class="note"><?php echo P_Lang("指定网站要使用的默认风格，注意，风格不区分语言和站点，请仔细选择");?></span>
	</div>
	<div class="content">
		<select id="tpl_id" name="tpl_id">
			<?php if($tpl_list){ ?>
				<?php $tpl_list_id["num"] = 0;$tpl_list=is_array($tpl_list) ? $tpl_list : array();$tpl_list_id = array();$tpl_list_id["total"] = count($tpl_list);$tpl_list_id["index"] = -1;foreach($tpl_list as $key=>$value){ $tpl_list_id["num"]++;$tpl_list_id["index"]++; ?>
				<option value="<?php echo $value['id'];?>"<?php if($rs['tpl_id'] == $value['id']){ ?> selected<?php } ?>><?php echo $value['title'];?></option>
				<?php } ?>
			<?php } else { ?>
			<option value=""><?php echo P_Lang("未安装风格包，请先安装");?></option>
			<?php } ?>
		</select>
		<input type="button" value="自定义风格" onclick="$.admin_all.setting_style('<?php echo $rs['id'];?>')" class="phpok-btn" />
	</div>
</div>
<?php if($multiple_language){ ?>
<div class="table">
	<div class="title">
		<?php echo P_Lang("默认语言：");?>
		<span class="note"><?php echo P_Lang("未设置语言包时，将调用系统默认语言包");?></span>
	</div>
	<div class="content">
		<select id="lang" name="lang">
		<?php $langlist_id["num"] = 0;$langlist=is_array($langlist) ? $langlist : array();$langlist_id = array();$langlist_id["total"] = count($langlist);$langlist_id["index"] = -1;foreach($langlist as $key=>$value){ $langlist_id["num"]++;$langlist_id["index"]++; ?>
		<option value="<?php echo $key;?>"<?php if($rs['lang'] == $key){ ?> selected<?php } ?>><?php echo $value;?></option>
		<?php } ?>
		</select>
	</div>
</div>
<?php } else { ?>
<input type="hidden" name="lang" id="lang" value="cn" />
<?php } ?>
<div class="table">
	<div class="title">
		<?php echo P_Lang("注册：");?>
		<span class="note"><?php echo P_Lang("关闭注册功能请在这里设置");?></span>
	</div>
	<div class="content">
		<table>
		<tr>
			<td><label><input type="radio" name="register_status" value="1" <?php if($rs['register_status']){ ?> checked<?php } ?> onclick="$('#register_close_note').hide()" /> <?php echo P_Lang("开启");?></label></td>
			<td><label><input type="radio" name="register_status" value="0" <?php if(!$rs['register_status']){ ?> checked<?php } ?> onclick="$('#register_close_note').show()" /> <?php echo P_Lang("关闭");?></label></td>
		</tr>
		</table>
	</div>
</div>
<div class="table<?php if($rs['register_status']){ ?> hide<?php } ?>" id="register_close_note">
	<div class="title">
		<?php echo P_Lang("注册关闭说明：");?><span class="note"><?php echo P_Lang("简单一句话说明关掉网站会员注册的原因");?></span>
	</div>
	<div class="content">
		<textarea id="register_close" name="register_close" class="long"><?php echo $rs['register_close'];?></textarea>
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("登录：");?>
		<span class="note"><?php echo P_Lang("关闭登录功能请在这里设置");?></span>
	</div>
	<div class="content">
		<table>
		<tr>
			<td><label><input type="radio" name="login_status" value="1" <?php if($rs['login_status']){ ?> checked<?php } ?> onclick="$('#login_status_1').show();$('#login_status_0').hide()" /> <?php echo P_Lang("开启");?></label></td>
			<td><label><input type="radio" name="login_status" value="0" <?php if(!$rs['login_status']){ ?> checked<?php } ?> onclick="$('#login_status_1').hide();$('#login_status_0').show()" /> <?php echo P_Lang("关闭");?></label></td>
		</tr>
		</table>
	</div>
</div>
<div class="table<?php if($rs['login_status']){ ?> hide<?php } ?>" id="login_status_0">
	<div class="title">
		<?php echo P_Lang("登录关闭说明：");?><span class="note"><?php echo P_Lang("简单一句话说明关掉网站会员登录的原因");?></span>
	</div>
	<div class="content">
		<textarea id="login_close" name="login_close" class="long"><?php echo $rs['login_close'];?></textarea>
	</div>
</div>
<div id="login_status_1"<?php if(!$rs['login_status']){ ?> class="hide"<?php } ?>>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("默认登录方式：");?><span class="note"><?php echo P_Lang("设置一个会员登录的默认方式");?></span>
		</div>
		<div class="content">
			<ul class="layout">
				<li><label><input type="radio" name="login_type" value="0"<?php if(!$rs['login_type']){ ?> checked<?php } ?> /><?php echo P_Lang("普通登录（即账号密码登录方式）");?></label></li>
				<?php if($gateway_email){ ?>
				<li><label><input type="radio" name="login_type" value="email"<?php if($rs['login_type'] == 'email'){ ?> checked<?php } ?> /><?php echo P_Lang("Email验证登录");?></label></li>
				<?php } ?>
				<?php if($gateway_sms){ ?>
				<li><label><input type="radio" name="login_type" value="sms"<?php if($rs['login_type'] == 'sms'){ ?> checked<?php } ?> /><?php echo P_Lang("短信验证登录");?></label></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
<?php if($gateway_email){ ?>
<div class="table">
	<div class="title">
		<?php echo P_Lang("邮件验证码模板：");?><span class="note"><?php echo P_Lang("请配置好邮件验证码模板，不然系统无法支持邮件验证码登录或注册");?></span>
	</div>
	<div class="content">
		<select name="login_type_email">
			<option value=""><?php echo P_Lang("请选择…");?></option>
			<?php $tmpid["num"] = 0;$email_tplist=is_array($email_tplist) ? $email_tplist : array();$tmpid = array();$tmpid["total"] = count($email_tplist);$tmpid["index"] = -1;foreach($email_tplist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
			<option value="<?php echo $value['identifier'];?>"<?php if($rs['login_type_email'] == $value['identifier']){ ?> selected<?php } ?>><?php echo $value['title'];?><?php if($value['note']){ ?>（<?php echo $value['note'];?>）<?php } ?></option>
			<?php } ?>
		</select>
	</div>
</div>
<?php } ?>
<?php if($gateway_sms){ ?>
<div class="table">
	<div class="title">
		<?php echo P_Lang("短信验证码模板：");?><span class="note"><?php echo P_Lang("请配置好短信验证码模板，不然系统无法支持短信登录或注册");?></span>
	</div>
	<div class="content">
		<select name="login_type_sms">
			<option value=""><?php echo P_Lang("请选择…");?></option>
			<?php $tmpid["num"] = 0;$sms_tplist=is_array($sms_tplist) ? $sms_tplist : array();$tmpid = array();$tmpid["total"] = count($sms_tplist);$tmpid["index"] = -1;foreach($sms_tplist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
			<option value="<?php echo $value['identifier'];?>"<?php if($rs['login_type_sms'] == $value['identifier']){ ?> selected<?php } ?>><?php echo $value['title'];?><?php if($value['note']){ ?>（<?php echo $value['note'];?>）<?php } ?></option>
			<?php } ?>
		</select>
	</div>
</div>
<?php } ?>

<div class="table">
	<div class="title">
		<?php echo P_Lang("后台LOGO");?>
		<span class="note"><?php echo P_Lang("显示在后台管理左上方的LOGO，高度限制在45px");?></span></span>
	</div>
	<div class="content">
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><input type="text" id="adm_logo29" name="adm_logo29" class="default" value="<?php echo $rs['adm_logo29'];?>" /></td>
			<td><input type="button" value="<?php echo P_Lang("选择");?>" onclick="phpok_pic('adm_logo29')" class="btn" /></td>
			<td><input type="button" value="<?php echo P_Lang("预览");?>" onclick="phpok_pic_view('adm_logo29')" class="btn" /></td>
			<td><input type="button" value="<?php echo P_Lang("清空");?>" onclick="$('#adm_logo29').val('');" class="btn" /></td>
		</tr>
		</table>
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("后台登录LOGO");?>
		<span class="note"><?php echo P_Lang("显示在居中登录框上，建议使用PNG透明图片，高度限制在180px");?></span></span>
	</div>
	<div class="content">
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><input type="text" id="adm_logo180" name="adm_logo180" class="default" value="<?php echo $rs['adm_logo180'];?>" /></td>
			<td><input type="button" value="<?php echo P_Lang("选择");?>" onclick="phpok_pic('adm_logo180')" class="btn" /></td>
			<td><input type="button" value="<?php echo P_Lang("预览");?>" onclick="phpok_pic_view('adm_logo180')" class="btn" /></td>
			<td><input type="button" value="<?php echo P_Lang("清空");?>" onclick="$('#adm_logo180').val('');" class="btn" /></td>
		</tr>
		</table>
	</div>
</div>
</div>
<script type="text/javascript">
function insert_input(val)
{
	var info = $("#biz_sn").val();
	if(info){
		val = info + '-' +val;
	}
	$("#biz_sn").val(val);
}
</script>
<div id="biz_setting" class="hide">
<div class="table">
	<div class="title">
		<?php echo P_Lang("电子商务");?>：
		<span class="note"><?php echo P_Lang("仅限这里启用电商后，整个平台才支持电商化");?></span>
	</div>
	<div class="content">
		<ul class="layout">
			<li><label><input type="radio" name="biz_status" value="0"<?php if(!$rs['biz_status']){ ?> checked<?php } ?> /><?php echo P_Lang("禁用");?></label></li>
			<li><label><input type="radio" name="biz_status" value="1"<?php if($rs['biz_status']){ ?> checked<?php } ?> /><?php echo P_Lang("启用");?></label></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("产品主要特点");?>：
		<span class="note"><?php echo P_Lang("请勾选实物或服务，以方便在录入产品时优先选中项");?></span>
	</div>
	<div class="content">
		<ul class="layout">
			<li><label><input type="radio" name="biz_main_service" value="0"<?php if(!$rs['biz_main_service']){ ?> checked<?php } ?> /><?php echo P_Lang("实物");?></label></li>
			<li><label><input type="radio" name="biz_main_service" value="1"<?php if($rs['biz_main_service']){ ?> checked<?php } ?> /><?php echo P_Lang("服务");?></label></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("订单号生成规则");?>：
		<span class="note">
			<?php echo P_Lang("支持以下常用选项（年-月-日-时-分-秒-随机数-序号-时间戳）");?>
		</span>
	</div>
	<div class="content">
		<input type="text" id="biz_sn" name="biz_sn" class="long" value="<?php echo $rs['biz_sn'];?>" />
		<input type="button" value="清空" onclick="$('#biz_sn').val('')" class="phpok-btn" />
		<div style="padding-top:5px">
			<div class="button-group">
				<input type="button" value="<?php echo P_Lang("前缀");?>" onclick="insert_input('prefix[P]')" class="phpok-btn" />
				<input type="button" value="<?php echo P_Lang("年");?>" onclick="insert_input('year')" class="phpok-btn" />
				<input type="button" value="<?php echo P_Lang("月");?>" onclick="insert_input('month')" class="phpok-btn" />
				<input type="button" value="<?php echo P_Lang("日");?>" onclick="insert_input('date')" class="phpok-btn" />
				<input type="button" value="<?php echo P_Lang("时");?>" onclick="insert_input('hour')" class="phpok-btn" />
				<input type="button" value="<?php echo P_Lang("分");?>" onclick="insert_input('minute')" class="phpok-btn" />
				<input type="button" value="<?php echo P_Lang("秒");?>" onclick="insert_input('second')" class="phpok-btn" />
				<input type="button" value="<?php echo P_Lang("随机");?>" onclick="insert_input('rand')" class="phpok-btn" />
				<input type="button" value="<?php echo P_Lang("时间戳");?>" onclick="insert_input('time')" class="phpok-btn" />
				<input type="button" value="<?php echo P_Lang("序号");?>" onclick="insert_input('number')" class="phpok-btn" />
				<input type="button" value="<?php echo P_Lang("订单ID");?>" onclick="insert_input('id')" class="phpok-btn" />
				<input type="button" value="<?php echo P_Lang("会员ID");?>" onclick="insert_input('user')" class="phpok-btn" />
			</div>
		</div>
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("电商货币：");?>
		<span class="note"><?php echo P_Lang("若您的网站启用电子商务功能，请开启前台默认货币设置，注意，前台不支持货币符号选择");?></span>
	</div>
	<div class="content">
		<select id="currency_id" name="currency_id">
		<option value=""><?php echo P_Lang("不使用");?></option>
		<?php $currency_list_id["num"] = 0;$currency_list=is_array($currency_list) ? $currency_list : array();$currency_list_id = array();$currency_list_id["total"] = count($currency_list);$currency_list_id["index"] = -1;foreach($currency_list as $key=>$value){ $currency_list_id["num"]++;$currency_list_id["index"]++; ?>
		<option value="<?php echo $value['id'];?>"<?php if($rs['currency_id'] == $value['id']){ ?> selected<?php } ?>><?php echo $value['title'];?>(<?php echo P_Lang("标识：");?><?php echo $value['code'];?>, <?php echo P_Lang("汇率：");?><?php echo $value['val'];?>)</option>
		<?php } ?>
		</select>
	</div>
</div>

<div class="table">
	<div class="title">
		<?php echo P_Lang("默认支付方式：");?>
		<span class="note"><?php echo P_Lang("结算订单后会自动绑定支付方式，当然，客户可以自行更换其他支付方式");?></span>
	</div>
	<div class="content">
	<select name="biz_payment">
		<option value="0"><?php echo P_Lang("不指定");?></option>
		<?php $payment_id["num"] = 0;$payment=is_array($payment) ? $payment : array();$payment_id = array();$payment_id["total"] = count($payment);$payment_id["index"] = -1;foreach($payment as $key=>$value){ $payment_id["num"]++;$payment_id["index"]++; ?>
		<option value="<?php echo $value['id'];?>"<?php if($rs['biz_payment'] == $value['id']){ ?> selected<?php } ?>><?php echo $value['title'];?></option>
		<?php } ?>
	</select>
	</div>
</div>
<div class="table">
	<div class="title">
		运费：
		<span class="note">请选择电商平台运费计算方法</span>
	</div>
	<div class="content">
		<select name="biz_freight">
			<option value="0">不使用运费</option>
			<?php $tmpid["num"] = 0;$freight=is_array($freight) ? $freight : array();$tmpid = array();$tmpid["total"] = count($freight);$tmpid["index"] = -1;foreach($freight as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
			<option value="<?php echo $value['id'];?>"<?php if($rs['biz_freight'] == $value['id']){ ?> selected<?php } ?>><?php echo $value['title'];?></option>
			<?php } ?>
		</select>
	</div>
</div>


</div>

<div id="upload_setting" class="hide">
<div class="table">
	<div class="title">
		<?php echo P_Lang("游客上传权限：");?>
		<span class="note"><?php echo P_Lang("启用上传权限后，游客仅可以上传JPG，GIF，PNG，JPEG，ZIP，RAR这几种类型的附件");?></span>
	</div>
	<div class="content">
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><label><input type="radio" name="upload_guest" value="0" <?php if(!$rs['upload_guest']){ ?> checked<?php } ?> /><?php echo P_Lang("禁用");?></label></td>
			<td><label><input type="radio" name="upload_guest" value="1" <?php if($rs['upload_guest']){ ?> checked<?php } ?> /><?php echo P_Lang("启用");?></label></td>
		</tr>
		</table>
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("会员上传权限：");?>
		<span class="note"><?php echo P_Lang("支持类型有：JPG，GIF，PNG，JPEG，ZIP，RAR，PPT，PPTX，TXT，RTF，CSV，XLS，XLSX，DOC，DOCX，WPS");?></span>
	</div>
	<div class="content">
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><label><input type="radio" name="upload_user" value="0" <?php if(!$rs['upload_user']){ ?> checked<?php } ?> /><?php echo P_Lang("禁用");?></label></td>
			<td><label><input type="radio" name="upload_user" value="1" <?php if($rs['upload_user']){ ?> checked<?php } ?> /><?php echo P_Lang("启用");?></label></td>
		</tr>
		</table>
	</div>
</div>
</div>

<div class="submit-info"><input type="submit" value="<?php echo P_Lang("提交");?>" class="submit2" /></div>

</form>
</div>

<?php $this->output("foot","file"); ?>