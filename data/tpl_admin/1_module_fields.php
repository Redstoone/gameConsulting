<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript">
function update_taxis(val,id)
{
	$.ajax({
		'url':get_url('module','field_taxis','taxis='+val+"&id="+id),
		'dataType':'json',
		'cache':false,
		'async':true,
		'beforeSend': function (XMLHttpRequest){
			XMLHttpRequest.setRequestHeader("request_type","ajax");
		},
		'success':function(rs){
			if(rs.status){
				$.phpok.reload();
			}else{
				$.dialog.alert(rs.info);
				return false;
			}
		}
	});
}
$(document).ready(function(){
	$("div[name=taxis]").click(function(){
		var oldval = $(this).text();
		var id = $(this).attr('data');
		$.dialog.prompt('<?php echo P_Lang("请填写新的排序：");?>',function(val){
			if(val != oldval){
				update_taxis(val,id);
			}
		},oldval);
	});
});
</script>

<div class="tips">
	<div class="action"><a href="javascript:$.admin_module.field_create('<?php echo $id;?>');void(0);" title="添加字段">添加字段</a></div>
	您当前的位置：
	<a href="<?php echo phpok_url(array('ctrl'=>'module'));?>">模块管理</a>
	&raquo; <span class="red"><?php echo $rs['title'];?></span>字段管理器
</div>

<?php if($used_list){ ?>
<div class="list">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<th class="id">ID</th>
	<th class="lft">&nbsp;字段名</th>
	<th class="lft">名称</th>
	<th class="lft">备注</th>
	<th>字段类型</th>
	<th>表单</th>
	<th>格式化</th>
	<th class="lft">排序</th>
	<th></th>
</tr>
<?php $tmpid["num"] = 0;$used_list=is_array($used_list) ? $used_list : array();$tmpid = array();$tmpid["total"] = count($used_list);$tmpid["index"] = -1;foreach($used_list as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
<tr>
	<td class="center"><?php echo $value['id'];?></td>
	<td><?php echo $value['identifier'];?></td>
	<td><?php echo $value['title'];?></td>
	<td><?php echo $value['note'];?></td>
	<td class="center"><?php echo $value['field_type_name'];?></td>
	<td class="center"><?php echo $value['form_type_name'];?></td>
	<td class="center"><?php echo $value['format_type_name'];?></td>
	<td><div class="gray i hand center" title="<?php echo P_Lang("点击调整排序");?>" name="taxis" data="<?php echo $value['id'];?>"><?php echo $value['taxis'];?></div></td>
	<td>
		<div class="button-group">
			<input type="button" value="<?php echo P_Lang("编辑");?>" onclick="$.admin_module.field_edit('<?php echo $value['id'];?>')" class="phpok-btn" />
			<input type="button" value="<?php echo P_Lang("删除");?>" onclick="$.admin_module.field_del('<?php echo $value['id'];?>','<?php echo $value['title'];?>')" class="phpok-btn" />
		</div>
	</td>
</tr>
<?php } ?>
</table>
</div>
<?php } ?>
<?php if($fields_list){ ?>
<div class="tips">常见字段快速添加</div>
<ul class="layout fields_quick_add">
	<?php $tmpid["num"] = 0;$fields_list=is_array($fields_list) ? $fields_list : array();$tmpid = array();$tmpid["total"] = count($fields_list);$tmpid["index"] = -1;foreach($fields_list as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
	<li>
		<div class="left">
			<div class="title"><?php echo $value['title'];?></div>
			<div class="gray i"><?php echo $value['identifier'];?></div>
		</div>
		<div class="right">
			<input type="button" value="<?php echo P_Lang("添加");?>" onclick="$.admin_module.field_add('<?php echo $id;?>','<?php echo $value['identifier'];?>')" class="phpok-btn" />
		</div>
	</li>
	<?php } ?>
</ul>
<?php } ?>

<?php $this->output("foot","file"); ?>