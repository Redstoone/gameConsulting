<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php if($_rs['is_multiple']){ ?>
<script type="text/javascript">
function action_<?php echo $_rs['identifier'];?>_show()
{
	var tmp_id = $("#<?php echo $_rs['identifier'];?>").val();
	if(tmp_id)
	{
		var url = get_url("inp")+"&type=user&content="+$.str.encode(tmp_id);
		var rs = json_ajax(url);
		if(rs.status == "ok")
		{
			var lst = rs.content;
			var c = '';
			var m = 1;
			for(var i in lst)
			{
				var class_cate_id = "cate_"+(m%9).toString();
				c += '<li id="<?php echo $_rs['identifier'];?>_div_'+lst[i]['id']+'">';
				c += '<div class="cate '+class_cate_id+'"><a href="javascript:phpok_user_preview(\''+lst[i]['id']+'\');void(0);">'+lst[i]['user']+'</a></div>';
				c += '<div class="cate_add"><a href="javascript:phpok_user_delete(\'<?php echo $_rs['identifier'];?>\',\''+lst[i]['id']+'\');void(0);" title="删除"><img src="images/page_delete.png" border="0" alt="" /></a></div>';
				c += '</li>';
				m++;
			}
			$("#<?php echo $_rs['identifier'];?>_div").html(c);
		}
	}
}
$(document).ready(function(){
	$("#_phpok_button_user_<?php echo $_rs['identifier'];?>").click(function(){
		var url = get_url("open","user") + "&id=<?php echo $_rs['identifier'];?>&multi=1";
		$.dialog.data("phpok_user_<?php echo $_rs['identifier'];?>",$("#<?php echo $_rs['identifier'];?>").val());
		$.dialog.open(url,{
			title: "会员管理器",
			lock : true,
			width: "700px",
			height: "70%",
			resize: false
			,"ok":function(){
				var data = $.dialog.data("phpok_user_<?php echo $_rs['identifier'];?>");
				$("#<?php echo $_rs['identifier'];?>").val(data);
				action_<?php echo $_rs['identifier'];?>_show();
				$.dialog.data("phpok_user_<?php echo $_rs['identifier'];?>","");
			}
			,"okVal":"确定"
		});
	});
	action_<?php echo $_rs['identifier'];?>_show();
});
</script>
<input type="hidden" name="<?php echo $_rs['identifier'];?>" id="<?php echo $_rs['identifier'];?>" value="<?php echo $_rs_content;?>" />
<ul class="layout_user">
	<li style="margin-top:5px;"><input id="_phpok_button_user_<?php echo $_rs['identifier'];?>" type="button" value="请选择" class="button" /></li>
	<div id="<?php echo $_rs['identifier'];?>_div" class="user_selected_div"></div>
	<div class="clear"></div>
</ul>
<?php } else { ?>
<script type="text/javascript">
function action_<?php echo $_rs['identifier'];?>_show()
{
	var tmp_id = $("#<?php echo $_rs['identifier'];?>").val();
	if(tmp_id)
	{
		var url = get_url("inp")+"&type=user&content="+$.str.encode(tmp_id);
		var rs = json_ajax(url);
		if(rs.status == "ok")
		{
			var lst = rs.content;
			for(var i in lst)
			{
				$("#title_<?php echo $_rs['identifier'];?>").val(lst[i]['user']);
			}
		}
	}
}
$(document).ready(function(){
	$("#_phpok_button_user_<?php echo $_rs['identifier'];?>").click(function(){
		var url = get_url("open","user") + "&id=<?php echo $_rs['identifier'];?>";
		$.dialog.open(url,{
			title: "<?php echo P_Lang("会员管理器");?>",
			lock : true,
			width: "700px",
			height: "70%",
			resize: false
		});
	});
	action_<?php echo $_rs['identifier'];?>_show();
});
</script>
<input type="hidden" name="<?php echo $_rs['identifier'];?>" id="<?php echo $_rs['identifier'];?>" value="<?php echo $_rs_content;?>" />
<table cellpadding="0" cellspacing="0" border="0">
<tr>
	<td><input type="text" id="title_<?php echo $_rs['identifier'];?>" name="title_<?php echo $_rs['identifier'];?>" disabled /></td>
	<td>&nbsp;</td>
	<td>
		<div class="button-group" style="padding-top:3px;">
			<input type="button" value="<?php echo P_Lang("选择会员");?>" id="_phpok_button_user_<?php echo $_rs['identifier'];?>" class="phpok-btn" />
			<input type="button" value="<?php echo P_Lang("删除");?>" onclick="$('#<?php echo $_rs['identifier'];?>').val('');$('#title_<?php echo $_rs['identifier'];?>').val('')" class="phpok-btn" />
		</div>
	</td>
</tr>
</table>
<?php } ?>