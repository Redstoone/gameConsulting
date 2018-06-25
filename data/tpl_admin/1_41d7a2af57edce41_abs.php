<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><script type="text/javascript">
$(document).ready(function(){
	$("#_phpok_button_url_<?php echo $_rs['identifier'];?>").click(function(){
		var url = get_url("open","url") + "&id=<?php echo $_rs['identifier'];?>";
		$.dialog.open(url,{
			title: "网址管理器",
			lock : true,
			width: "700px",
			height: "70%",
			resize: false
		});
	});
});
</script>
<table cellpadding="0" cellspacing="0" style="width:auto;height:auto;border:0" border="0">
<tr>
	<td>
		<table>
		<tr>
			<td align="right">动态页：</td>
			<td><input type="text" id="<?php echo $_rs['identifier'];?>_default" name="<?php echo $_rs['identifier'];?>[default]" style="<?php echo $_rs['form_style'];?>;width:<?php echo $_rs['width'];?>px;" value="<?php echo $_rs['content']['default'];?>" /></td>
		</tr>
		<tr>
			<td align="right">伪静态页：</td>
			<td><input type="text" id="<?php echo $_rs['identifier'];?>_rewrite" name="<?php echo $_rs['identifier'];?>[rewrite]" style="<?php echo $_rs['form_style'];?>;width:<?php echo $_rs['width'];?>px;" value="<?php echo $_rs['content']['rewrite'];?>" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
			    <input type="button" value="首页" class="btn" onclick="$('#<?php echo $_rs['identifier'];?>_default').val('index.php');$('#<?php echo $_rs['identifier'];?>_rewrite').val('index.html');" />
				<input type="button" value="网址库" class="btn" id="_phpok_button_url_<?php echo $_rs['identifier'];?>" />
				<input type="button" value="无链接" class="btn" onclick="$('#<?php echo $_rs['identifier'];?>_default').val('javascript:;void(0)');$('#<?php echo $_rs['identifier'];?>_rewrite').val('javascript:;void(0)');" />
				<input type="button" value="清除" class="btn" onclick="$('#<?php echo $_rs['identifier'];?>_default').val('');$('#<?php echo $_rs['identifier'];?>_rewrite').val('');" />
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
