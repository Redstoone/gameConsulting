<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<form method="post" id="module_submit_post" onsubmit="return false;">
<?php if($id){ ?><input type="hidden" id="id" name="id" value="<?php echo $id;?>" /><?php } ?>
<div class="table">
	<div class="title">
		<?php echo P_Lang("名称：");?>
		<span class="note"><?php echo P_Lang("设置一个名称，该名称将在应用中读取，不受站点影响");?></span></span>
	</div>
	<div class="content">
		<table cellpadding="0" cellspacing="0">
		<tr>
			<td><input type="text" id="title" name="title" class="long" value="<?php echo $rs['title'];?>" /></td>
			<td><div id="title_note"></div></td>
		</tr>
		</table>
	</div>
</div>

<div class="table">
	<div class="title">
		<?php echo P_Lang("备注：");?>
		<span class="note"><?php echo P_Lang("仅限后台管理使用，用于查看该模块主要做什么");?></span></span>
	</div>
	<div class="content"><input type="text" id="note" name="note" class="long" value="<?php echo $rs['note'];?>" /></div>
</div>
<?php if(!$id){ ?>
<div class="table">
	<div class="title">
		<?php echo P_Lang("独立运行：");?><span class="note"><?php echo P_Lang("启用独立运行后，需要设置相应的标识，且不支持项目关联，功能比较简单");?></span>
	</div>
	<div class="content">
		<ul class="layout">
			<li><label><input type="radio" name="mtype" value="0"<?php if(!$rs['mtype']){ ?> checked<?php } ?> />否</label></li>
			<li><label><input type="radio" name="mtype" value="1"<?php if($rs['mtype']){ ?> checked<?php } ?> />是</label></li>
		</ul>
	</div>
</div>
<?php } else { ?>
<div class="table">
	<div class="title">
		<?php echo P_Lang("后台字段布局：");?>
		<span class="note"><?php echo P_Lang("在这里设置要显示的字段属性");?></span>
	</div>
	<div class="content">
		<ul class="layout">
			<?php if(!$rs['mtype']){ ?>
			<li><label><input type="checkbox" name="layout[]" value="hits"<?php if(in_array("hits",$layout)){ ?> checked<?php } ?> /><?php echo P_Lang("查看次数");?></label></li>
			<li><label><input type="checkbox" name="layout[]" value="dateline"<?php if(in_array("dateline",$layout)){ ?> checked<?php } ?> /><?php echo P_Lang("发布时间");?></label></li>
			<li><label><input type="checkbox" name="layout[]" value="user_id"<?php if(in_array("user_id",$layout)){ ?> checked<?php } ?> /><?php echo P_Lang("会员账号");?></label></li>
			<li><label><input type="checkbox" name="layout[]" value="sort"<?php if(in_array("sort",$layout)){ ?> checked<?php } ?> /><?php echo P_Lang("排序");?></label></li>
			<?php } ?>
			<?php $used_list_id["num"] = 0;$used_list=is_array($used_list) ? $used_list : array();$used_list_id = array();$used_list_id["total"] = count($used_list);$used_list_id["index"] = -1;foreach($used_list as $key=>$value){ $used_list_id["num"]++;$used_list_id["index"]++; ?>
			<li><label><input type="checkbox" name="layout[]" id="layout_<?php echo $value['identifier'];?>" value="<?php echo $value['identifier'];?>"<?php if(in_array($value['identifier'],$layout)){ ?> checked<?php } ?> /><?php echo $value['title'];?></label></li>
			<?php } ?>
		</ul>
	</div>
</div>
<?php } ?>
<div class="table">
	<div class="title">
		<?php echo P_Lang("排序：");?>
		<span class="note"><?php echo P_Lang("值越小越往前靠，最小值为0，最大值为255");?></span>
	</div>
	<div class="content"><input type="text" id="taxis" name="taxis" class="short" value="<?php echo $rs['taxis'];?>" /></div>
</div>
</form>

<?php $this->output("foot_open","file"); ?>