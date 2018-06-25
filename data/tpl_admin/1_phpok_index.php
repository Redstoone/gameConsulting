<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript" src="<?php echo add_js('call.js');?>"></script>
<div class="tips">
	<?php if($popedom['add']){ ?>
	<div class="action"><a href="<?php echo phpok_url(array('ctrl'=>'call','func'=>'set'));?>"><?php echo P_Lang("添加调用");?></a></div>
	<?php } ?>
	<?php echo P_Lang("您当前的位置：");?><a href="<?php echo phpok_url(array('ctrl'=>'call'));?>" title="<?php echo P_Lang("调用列表");?>"><?php echo P_Lang("调用列表");?></a>
</div>
<div class="list">
<table class="list" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<th class="w50">ID</th>
	<th class="lft"><?php echo P_Lang("名称");?></th>
	<th class="lft"><?php echo P_Lang("类型");?></th>
	<th class="lft"><?php echo P_Lang("关联的项目");?></th>
	<th class="lft"><?php echo P_Lang("关联的分类");?></th>
	<th class="lft"><?php echo P_Lang("参数变量");?></th>
	<th width="110">&nbsp;</th>
</tr>
<?php $tmpid["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$tmpid = array();$tmpid["total"] = count($rslist);$tmpid["index"] = -1;foreach($rslist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
<tr>
	<td class="center"><?php echo $value['id'];?></td>
	<td><?php echo $value['title'];?></td>
	<td><?php echo $phpok_type_list[$value['type_id']]['title'];?></td>
	<td><?php echo $value['project'] ? $value['project'] : '-';?></td>
	<td><?php echo $value['cate'] ? $value['cate'] : '-';?></td>
	<td><?php echo $value['identifier'];?></td>
	<td>
		<div class="button-group">
			<?php if($popedom['modify']){ ?><input type="button" value="<?php echo P_Lang("编辑");?>" onclick="$.phpok.go('<?php echo phpok_url(array('ctrl'=>'call','func'=>'set','id'=>$value['id']));?>')" class="phpok-btn" /><?php } ?>
			<?php if($popedom['delete']){ ?><input type="button" value="<?php echo P_Lang("删除");?>" onclick="call_del('<?php echo $value['id'];?>','<?php echo $value['title'];?>')" class="phpok-btn" /><?php } ?>
		</div>
	</td>
</tr>
<?php } ?>
</table>
</div>
<div class="table"><?php $this->output("pagelist","file"); ?></div>
<?php $this->output("foot","file"); ?>