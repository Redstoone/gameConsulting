<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head_open","file"); ?>
<script type="text/javascript">
function select_input(val,title)
{
	var obj = $.dialog.opener;
	if(val == "index")
	{
		obj.$("#<?php echo $id;?>").val("index.php");
		obj.$("#<?php echo $id;?>_default").val("index.php");
		obj.$("#<?php echo $id;?>_rewrite").val("index.html");
	}
	else
	{
		var old = obj.$("#title").val();
		if(!old && old != 'undefined'){
			obj.$("#title").val(title)
		}
		obj.$("#<?php echo $id;?>,#<?php echo $id;?>_default").val("<?php echo $sys['www_file'];?>?id="+val);
		obj.$("#<?php echo $id;?>_rewrite").val(val+".html");
	}
	$.dialog.close();
}
function select_post(val,title)
{
	var obj = $.dialog.opener;
	obj.$("#<?php echo $id;?>,#<?php echo $id;?>_default").val("<?php echo $sys['www_file'];?>?<?php echo $sys['ctrl_id'];?>=post&id="+val);
	obj.$("#<?php echo $id;?>_rewrite").val("post/"+val+".html");
	var old = obj.$("#title").val();
	if(!old && old != 'undefined'){
		obj.$("#title").val(title)
	}
	$.dialog.close();
}
</script>
<div class="list">
<table width="100%" cellpadding="0" cellspacing="0" class="list">
<tr>
	<th class="id" height="30px">ID</th>
	<th class="title">项目名称</th>
	<th class="w60">分类</th>
	<th class="w60">内容</th>
	<th class='w60'>操作</th>
	<th class='w60'>表单</th>
</tr>
<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id = array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist as $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
<tr>
	<td class="center"><?php echo $value['id'];?></td>
	<td style="text-align: left;height:33px;">&nbsp;<?php echo $value['space'];?><?php echo $value['title'];?><span class="gray"> / <?php echo $value['identifier'];?></span></td>
	<td class="center">
		<?php if($value['cate']){ ?>
		<a href="<?php echo admin_url('open','url');?>&pid=<?php echo $value['id'];?>&type=cate&id=<?php echo $id;?>">进入</a>
		<?php } else { ?>
		-
		<?php } ?>
	</td>
	<td class="center">
		<?php if($value['module']){ ?>
		<a href="<?php echo admin_url('open','url');?>&pid=<?php echo $value['id'];?>&type=list&id=<?php echo $id;?>">进入</a>
		<?php } else { ?>
		-
		<?php } ?>
	</td>
	<td>
		<input type="button" value="提交" class="btn" onclick="select_input('<?php echo $value['identifier'];?>','<?php echo $value['title'];?>')" />
	</td>
	<td>
		<input type="button" value="表单" class="btn" onclick="select_post('<?php echo $value['identifier'];?>','<?php echo $value['title'];?>')" />
	</td>
</tr>
<?php } ?>
</table>
</div>
<?php $this->output("foot_open","file"); ?>
