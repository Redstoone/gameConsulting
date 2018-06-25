<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title","标签管理"); ?><?php $this->output("head","file"); ?>
<div class="tips">
	<?php echo P_Lang("您当前的位置：");?>
	<a href="<?php echo phpok_url(array('ctrl'=>'tag'));?>"><?php echo P_Lang("标签管理");?></a>
	&raquo; <?php echo P_Lang("标签列表");?>
	<?php if($popedom['add']){ ?><div class="action"><a href="javascript:$.phpok_tag.add();void(0);">添加标签</a></div><?php } ?>
	<?php if($session['admin_rs']['if_system']){ ?><div class="action"><a href="javascript:$.phpok_tag.config();void(0);">配置标签</a></div><?php } ?>
</div>
<div class="list">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<th class="id">ID</th>
	<th class="lft" width="160">名称</th>
	<th class="lft" width="160">链接提示文字</th>
	<th class="lft">自定义网址</th>
	<th width="95">是否新窗口</th>
	<th width="95">全局性</th>
	<th width="70">替换次数</th>
	<th width="90">主题数</th>
	<th width="90">点击数</th>
	<th class="action">操作</th>
</tr>
<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id = array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist as $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
<tr id="edit_<?php echo $value['id'];?>">
	<td class="center"><?php echo $value['id'];?></td>
	<td><?php echo $value['title'];?></td>
	<td><?php echo $value['alt'] ? $value['alt'] : '-';?></td>
	<td><?php echo $value['url'] ? $value['url'] : '-';?></td>
	<td class="center">
		<?php if($value['target']){ ?><span class="red">新窗口</span><?php } else { ?><span class="darkblue">当前窗口</span><?php } ?>
	</td>
	<td class="center">
		<?php if($value['is_global']){ ?><span class="darkblue">全局可用</span><?php } else { ?>-<?php } ?>
	</td>
	<td class="center"><?php echo $value['replace_count'];?></td>
	<td class="center"><?php echo $value['count'] ? $value['count'] : 0;?></td>
	<td class="center"><?php echo $value['hits'] ? $value['hits'] : 0;?></td>
	<td>
		<div class="button-group">
			<input type="button" value="<?php echo P_Lang("编辑");?>" onclick="$.phpok_tag.edit('<?php echo $value['id'];?>')" class="phpok-btn" />
			<input type="button" value="<?php echo P_Lang("删除");?>" onclick="$.phpok_tag.del('<?php echo $value['id'];?>','<?php echo $value['title'];?>')" class="phpok-btn" />
		</div>
	</td>
</tr>
<?php } ?>
</table>
</div>
<?php $this->output("pagelist","file"); ?>

<?php $this->output("foot","file"); ?>
