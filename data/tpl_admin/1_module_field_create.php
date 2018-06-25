<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head_open","file"); ?>
<script type="text/javascript">
function field_form_opt(val,eid)
{
	if(!val || val == "undefined"){
		$("#form_type_ext").html('').hide();
		return false;
	}
	var url = get_url("form","config") + "&id="+$.str.encode(val);
	if(eid && eid != "undefined"){
		url += "&eid="+eid;
	}
	url += "&etype=fields";
	var html = get_ajax(url);
	if(html && html != 'exit'){
		$("#form_type_ext").html(html).show();
	}
}

function save()
{
	return $.admin_module.field_addok('<?php echo $mid;?>');
}
</script>
<form method="post" id="form_save" onsubmit="return false">
<div class="table">
	<div class="title">
		<?php echo P_Lang("字段名称：");?>
		<span class="note"><?php echo P_Lang("设置一个名称，该名称在表单的头部信息显示");?></span></span>
	</div>
	<div class="content">
		<input type="text" id="title" name="title" class="w99" value="<?php echo $rs['title'];?>" />
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("字段标识：");?>
		<span class="note"><?php echo P_Lang("要求");?><span class="darkblue"><?php echo P_Lang("字母、数字及下划线，且必须以字母开头");?></span></span>
	</div>
	<div class="content">
		<ul class="layout">
			<li><input type="text" id="identifier" name="identifier" class="default" value="<?php echo $rs['identifier'];?>" /></li>
			<li>
				<div class="button-group">
					<input type="button" value="<?php echo P_Lang("随机生成");?>" onclick="$('#identifier').val($.phpok.rand(10,'letter'))" class="phpok-btn" />
				</div>
			</li>
		</ul>		
	</div>
</div>


<div class="table">
	<div class="title">
		<?php echo P_Lang("字段备注");?>：
		<span class="note"><?php echo P_Lang("填写表单时，指定这个项目的注意事项");?></span></span>
	</div>
	<div class="content"><input type="text" id="note" name="note" class="w99" value="<?php echo $rs['note'];?>" /></div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("字段类型：");?><span class="note"><?php echo P_Lang("请慎重选择，一经确定后是不能修改的");?></span>
	</div>
	<div class="content">
		<select name="field_type" id="field_type" class="w99">
			<option value=""><?php echo P_Lang("请选择字段类型…");?></option>
			<?php $field_list_id["num"] = 0;$field_list=is_array($field_list) ? $field_list : array();$field_list_id = array();$field_list_id["total"] = count($field_list);$field_list_id["index"] = -1;foreach($field_list as $key=>$value){ $field_list_id["num"]++;$field_list_id["index"]++; ?>
			<option value="<?php echo $key;?>"<?php if($rs['field_type'] == $key){ ?> selected<?php } ?>><?php echo $value['title'];?><?php if($value['note']){ ?>（<?php echo $value['note'];?>）<?php } ?></option>
			<?php } ?>
		</select>
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("表单类型：");?>
		<span class="note"><?php echo P_Lang("请选择字段要使用的表单");?></span>
	</div>
	<div class="content">
		<select id="form_type" name="form_type" class="w99" onchange="$._configForm.option(this.value,'form_type_ext','<?php echo $id;?>','module')">
			<option value=""><?php echo P_Lang("请选择表单…");?></option>
			<?php $tmpid["num"] = 0;$form_list=is_array($form_list) ? $form_list : array();$tmpid = array();$tmpid["total"] = count($form_list);$tmpid["index"] = -1;foreach($form_list as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
			<option value="<?php echo $key;?>"<?php if($key == $rs['form_type']){ ?> selected<?php } ?>><?php echo $value['title'];?><?php if($value['note']){ ?>（<?php echo $value['note'];?>）<?php } ?></option>
			<?php } ?>
		</select>
	</div>
</div>

<div id="form_type_ext" style="display:none;"></div>
<div class="table">
	<div class="title">
		<span class="edit">
			<?php echo P_Lang("表单样式：");?>
			<span class="note"><?php echo P_Lang("不能超过250个字符，不熟悉CSS，请查相关手册");?></span>
		</span>
	</div>
	<div class="content"><input type="text" id="form_style" name="form_style" class="w99" value="<?php echo $rs['form_style'];?>" /></div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("表单默认值：");?>
		<span class="note"><?php echo P_Lang("设置表单默认值，如果表单中有多个值，请用英文逗号隔开");?></span>
	</div>
	<div class="content"><input type="text" id="content" name="content" class="w99" value="<?php echo $rs['content'];?>" /></div>
</div>

<div class="table">
	<div class="title">
		<?php echo P_Lang("接收数据格式化：");?>
		<span class="note"><?php echo P_Lang("设置文本常见格式，如HTML，整型，浮点型等");?></span>
	</div>
	<div class="content">
		<select name="format" id="format" class="w99">
			<?php $tmpid["num"] = 0;$format_list=is_array($format_list) ? $format_list : array();$tmpid = array();$tmpid["total"] = count($format_list);$tmpid["index"] = -1;foreach($format_list as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
			<option value="<?php echo $key;?>"<?php if($rs['format'] == $key){ ?> selected<?php } ?>><?php echo $value['title'];?><?php if($value['note']){ ?>（<?php echo $value['note'];?>）<?php } ?></option>
			<?php } ?>
		</select>
	</div>
</div>

<div class="table">
	<div class="title">
		<?php echo P_Lang("排序");?>：
		<span class="note"><?php echo P_Lang("值越小越往前靠，可选范围：1-255");?></span>
	</div>
	<div class="content">
		<input type="text" name="taxis" id="taxis" value="<?php echo $rs['taxis'] ? $rs['taxis'] : 255;?>" />
	</div>
</div>
<div class="table">
	<div class="title">
		<?php echo P_Lang("前端处理");?>：
		<span class="note"><?php echo P_Lang("设置前端是否可用，如果需要前端加载相应属性请在这里操作");?></span>
	</div>
	<div class="content">
		<table>
		<tr>
			<td><label><input type="radio" name="is_front" value="0"<?php if(!$rs['is_front']){ ?> checked<?php } ?> /><?php echo P_Lang("禁用");?></label></td>
			<td><label><input type="radio" name="is_front" value="1"<?php if($rs['is_front']){ ?> checked<?php } ?> /><?php echo P_Lang("使用");?></label></td>
		</tr>
		</table>
	</div>
</div>
<script type="text/javascript">
function search_set(val){
	if(val == 3){
		$("#search_separator_html").show();
	}else{
		$("#search_separator_html").hide();
	}
}
</script>
<div class="table">
	<div class="title">
		<?php echo P_Lang("搜索");?>：
		<span class="note"><?php echo P_Lang("指定该字段的搜索类型，使用区间搜索需要设置分隔符");?></span>
	</div>
	<div class="content">
		<table>
		<tr>
			<td><label><input type="radio" name="search" value="0" checked onclick="search_set(0)" /><?php echo P_Lang("不支持搜索");?></label></td>
			<td><label><input type="radio" name="search" value="1" onclick="search_set(1)" /><?php echo P_Lang("完全匹配搜索");?></label></td>
			<td><label><input type="radio" name="search" value="2" onclick="search_set(2)" /><?php echo P_Lang("部分匹配搜索");?></label></td>
			<td><label><input type="radio" name="search" value="3" onclick="search_set(3)" /><?php echo P_Lang("区间搜索");?></label></td>
			<td id="search_separator_html"  style="display:none">
				<input type="text" name="search_separator" id="search_separator" class="short" placeholder="<?php echo P_Lang("分隔符");?>" />
			</td>
		</tr>
		</table>
	</div>
</div>
</form>
<?php $this->output("foot_open","file"); ?>
