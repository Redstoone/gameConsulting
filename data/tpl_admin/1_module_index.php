<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<div class="tips">
	<?php if($popedom['set']){ ?>
	<div class="action"><a href="javascript:$.admin_module.create();void(0);">添加模块</a></div>
	<div class="action"><a href="javascript:$.admin_module.input();void(0);">模块导入</a></div>
	<?php } ?>
	您当前的位置：
	<a href="<?php echo phpok_url(array('ctrl'=>'module'));?>">模块管理</a>
	&raquo; 模块列表<?php if($rslist){ ?><span class="red">(<?php echo count($rslist);?>)</span><?php } ?>
</div>
<div class="list">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<th width="50px">ID</th>
	<th width="30px">&nbsp;</th>
	<th class="lft">名称</th>
	<th>运行模式</th>
	<th>排序</th>
	<th>操作</th>
</tr>
<?php $tmpid["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$tmpid = array();$tmpid["total"] = count($rslist);$tmpid["index"] = -1;foreach($rslist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
<tr>
	<td align="center"><?php echo $value['id'];?></td>
	<td><span class="status<?php echo $value['status'];?>" id="status_<?php echo $value['id'];?>" <?php if($popedom['set']){ ?>onclick="$.admin_module.status(<?php echo $value['id'];?>)"<?php } else { ?> style="cursor:default"<?php } ?> value="<?php echo $value['status'];?>"></span></td>
	<td><label for="tid_<?php echo $value['id'];?>"><?php echo $value['title'];?><?php if($value['note']){ ?><span class="gray i">（<?php echo $value['note'];?>）</span><?php } ?></label></td>
	<td class="center"><?php if($value['mtype']){ ?>独立<?php } else { ?>集成<?php } ?></td>
	<td class="center"><div class="gray i hand center" title="<?php echo P_Lang("点击调整排序");?>" name="taxis" data="<?php echo $value['id'];?>" onclick="$.admin_module.taxis('<?php echo $value['id'];?>','<?php echo $value['taxis'];?>')"><?php echo $value['taxis'];?></div></td>
	<td class="center">
		<?php if($popedom['set']){ ?>
		<div class="button-group">
			<input type="button" value="<?php echo P_Lang("编辑");?>" onclick="$.admin_module.edit('<?php echo $value['id'];?>')" class="phpok-btn" />
			<input type="button" value="<?php echo P_Lang("删除");?>" onclick="$.admin_module.del('<?php echo $value['id'];?>','<?php echo $value['title'];?>')" class="phpok-btn" />
			<input type="button" value="<?php echo P_Lang("字段管理");?>" onclick="$.phpok.go('<?php echo phpok_url(array('ctrl'=>'module','func'=>'fields','id'=>$value['id']));?>')" class="phpok-btn" />
			<input type="button" value="<?php echo P_Lang("复制模块");?>" onclick="$.admin_module.copy('<?php echo $value['id'];?>','<?php echo $value['title'];?>')" class="phpok-btn" />
			<input type="button" value="<?php echo P_Lang("导出");?>" onclick="$.admin_module.export('<?php echo $value['id'];?>')" class="phpok-btn" />
		</div>
		<?php } ?>
	</td>
</tr>
<?php } ?>
</table>
</div>
<div class="tips">
	<ul>
		<li>模块功能用于扩展主题字段</li>
		<li class="red">模块支持导入导出，仅限基本配置，如关联其他数据，请手动再配置</li>
	</ul>
	<div class="clear"></div>
</div>

<?php $this->output("foot","file"); ?>