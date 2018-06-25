<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript" src="<?php echo include_js('all.js');?>"></script>
<div class="tips">
	<?php echo P_Lang("您当前的位置：");?>
	<a href="<?php echo phpok_url(array('ctrl'=>'all'));?>"><?php echo P_Lang("全局维护");?></a>
	&raquo; <?php echo P_Lang("网站域名");?>
</div>

<div class="list">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<th class="id">ID</th>
	<th width="400"><?php echo P_Lang("域名");?></th>
	<th><?php echo P_Lang("操作");?></th>
</tr>
<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id = array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist as $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
<tr>
	<td class="center"><?php echo $value['id'];?></td>
	<td><input type="text" id="domain_<?php echo $value['id'];?>" value="<?php echo $value['domain'];?>" class="default" /></td>
	<td>
		<div class="button-group">
			<input type="button" value="<?php echo P_Lang("更新");?>" onclick="domain_update(<?php echo $value['id'];?>)" class="phpok-btn" />
			<?php if($value['id'] != $rs['domain_id']){ ?>
				<input type="button" value="<?php echo P_Lang("设主域名");?>" class="phpok-btn" onclick="domain_default(<?php echo $value['id'];?>)" />
				<?php if($value['is_mobile']){ ?>
				<input type="button" value="<?php echo P_Lang("取消手机版专用");?>" class="phpok-btn" onclick="unset_mobile(<?php echo $value['id'];?>)" />
				<?php } else { ?>
				<input type="button" value="<?php echo P_Lang("设为手机版专用");?>" class="phpok-btn" onclick="set_mobile(<?php echo $value['id'];?>)" />
				<?php } ?>
				<input type="button" value="<?php echo P_Lang("删除");?>" class="phpok-btn" onclick="domain_delete(<?php echo $value['id'];?>)" />
			<?php } ?>
		</div>
	</td>
</tr>
<?php } ?>
<tr>
	<td class="center"><?php echo P_Lang("添加");?></td>
	<td><input type="text" id="domain_0" class="default" /></td>
	<td><input type="button" value="<?php echo P_Lang("添加");?>" class="phpok-btn" onclick="domain_add()" /></td>
</tr>
</table>
</div>


<?php $this->output("foot","file"); ?>