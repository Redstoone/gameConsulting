<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Expires" content="wed, 26 feb 1997 08:21:57 gmt" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Cache-Control" content="no-cache" />
	<title><?php echo P_Lang("管理员登录");?></title>
	<meta name="author" content="phpok.com" />
	<link rel="stylesheet" type="text/css" href="css/login.css" />
	<link rel="stylesheet" type="text/css" href="css/artdialog.css" />
	<script type="text/javascript" src="<?php echo phpok_url(array('ctrl'=>'js','ext'=>'admin.login.js'));?>"></script>
<?php echo $app->plugin_html_ap("phpokhead");?></head>
<body>
<div class="top">
	<div class="logo"><img src="<?php echo $logo;?>" border="0" alt="<?php echo $config['title'];?>" /></div>
</div>
<div class="main">
	<div class="box">
		<form method="post" id="adminlogin" onsubmit="return admlogin()">
		<table width="360" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td height="30"><?php echo P_Lang("管理员账号");?></td>
			<td colspan="2"><?php if($multiple_language){ ?><?php echo P_Lang("语言");?><?php } ?></td>
		</tr>
		<tr>
			<td height="40"><input name="user" type="text" class="user user_bg1" tabindex="1" /></td>
			<td colspan="2">
				<?php if($multiple_language){ ?>
				<select name="langid" id="langid" onchange="update_lang(this.value)" style="padding:3px;border:1px solid #7ea3b8;line-height:27px;height:27px;">
					<?php $langlist_id["num"] = 0;$langlist=is_array($langlist) ? $langlist : array();$langlist_id = array();$langlist_id["total"] = count($langlist);$langlist_id["index"] = -1;foreach($langlist as $key=>$value){ $langlist_id["num"]++;$langlist_id["index"]++; ?>
					<option value="<?php echo $key;?>"<?php if($key == $langid){ ?> selected<?php } ?>><?php echo $value;?></option>
					<?php } ?>
				</select>
				<?php } ?>
			</td>
		</tr>
			<tr>
				<td width="209" height="30"><?php echo P_Lang("管理员密码");?></td>
				<td colspan="2"><?php if($vcode){ ?><?php echo P_Lang("验证码");?><?php } ?></td>
			</tr>
			<tr>
				<td height="40"><input name="pass" type="password" class="user user_bg2" tabindex="2" /></td>
				<?php if($vcode){ ?>
				<td width="72"><input name="_code" type="text" class="user user_bg3" id="code_id" tabindex="3" /></td>
				<td width="79"><img src="images/blank.gif" border="0" align="absmiddle" style="cursor:pointer;" id="src_code"></td>
				<?php } ?>
			</tr>
		<tr>
			<td height="50" colspan="3"><input type="submit" value="<?php echo P_Lang("管理员登录");?>" class="but" /></td>
		</tr>
		<tr>
			<td height="30" colspan="3"><?php echo P_Lang("推荐使用：傲游/谷歌/火狐/IE9-12等浏览器访问本系统");?></td>
		</tr>
		</table>
		</form>
	</div>
	<div class="bottom"></div>
</div>
<?php if($vcode){ ?>
<script type="text/javascript">
$(document).ready(function(){
	login_code('admin');
	$("#src_code").click(function(){
		login_code('admin');
	})
});
</script>
<?php } ?>
<?php echo $app->plugin_html_ap("phpokbody");?></body>
</html>
