<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript" src="<?php echo add_js('call.js');?>"></script>
<div class="tips">
	您当前的位置：<a href="<?php echo admin_url('call');?>" title="调用列表">调用列表</a>
	&raquo; <?php if($id){ ?>编辑<?php } else { ?>添加新<?php } ?>调用
</div>
<form method="post" action="<?php echo phpok_url(array('ctrl'=>'call','func'=>'save'));?>" onsubmit="return check_save()">
<input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
<div class="table">
	<div class="title">
		标题：
		<span class="note">填写该调用的基本说明，不超过80汉字</span>
	</div>
	<div class="content">
		<input type="text" id="title" name="title" class="long" value="<?php echo $rs['title'];?>" />
	</div>
</div>
<div class="table">
	<div class="title">标识串：<span class="note">此标识串将在模板中被调用，支持小写字母、数字及下划线且必须是小写字母开头</span></div>
	<div class="content">
		<input type="text" id="identifier" name="identifier" class="default" value="<?php echo $rs['identifier'];?>" />
		<input type="button" value="随机生成" onclick="random_string(10)" class="btn" />
		<span id="identifier_ext_btn"></span>
	</div>
</div>
<div class="table">
	<div class="title">
		调用类型：
		<span class="note">请选择要调用的数据类型，注意，不同的调用类型会展现出不同的数据条件，请仔细阅读</span>
	</div>
	<div class="content">
		<ul class="layout">
			<?php $tmpid["num"] = 0;$phpok_type_list=is_array($phpok_type_list) ? $phpok_type_list : array();$tmpid = array();$tmpid["total"] = count($phpok_type_list);$tmpid["index"] = -1;foreach($phpok_type_list as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
			<li style="width:120px;"><label><input type="radio" name="type_id" onclick="update_type_id(this.value)" value="<?php echo $key;?>"<?php if($rs['type_id'] == $key){ ?> checked<?php } ?> showid="<?php echo $value['showid'];?>" ajax="<?php echo $value['ajax'];?>" /><?php echo $value['title'];?></label></li>
			<?php } ?>
		</ul>
		<div class="clear"></div>
	</div>
</div>
<div class="table hide" ext="param" name="ext_pid">
	<div class="title">
		关联项目ID<span class="darkblue">[pid]</span>：
		<span class="note">动态改变使用方法“<span class="darkblue">pid=项目ID</span>”</span>
	</div>
	<div class="content">
		<select id="pid" name="pid" onchange="update_param(this.value)">
		<option value="">请选择…</option>
		<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id = array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist as $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
		<option value="<?php echo $value['id'];?>"<?php if($rs['pid'] == $value['id']){ ?> selected<?php } ?> module="<?php echo $value['module'];?>" rootcate="<?php echo $value['cate'];?>" parentid="<?php echo $value['parent_id'];?>"><?php echo $value['space'];?><?php echo $value['title'];?></option>
		<?php } ?>
		</select>
	</div>
</div>
<div class="table hide" id="html_cateid" name="ext_cateid" ext="param">
	<div class="title">分类：<span class="note">请选择要绑定的分类</span></div>
	<div class="content">
		<select name="cateid" id="cateid">
			<option value="<?php echo $rs['cateid'];?>">.</option>
		</select>
	</div>
</div>
<div class="table hide" id="html_psize" name="ext_psize" ext="param">
	<div class="title">调用数量：<span class="note">设置调用的最大值，设为0表示不限制数量</span></div>
	<div class="content"><input type="text" id="psize" name="psize" class="short" value="<?php echo $rs['psize'] ? $rs['psize'] : 0;?>" /></div>
</div>
<div class="table hide" name="ext_offset" ext="param">
	<div class="title">开始位置：<span class="note">不设置将使用0开始调用（即第一条开始）</span></div>
	<div class="content"><input type="text" id="offset" name="offset" class="short" value="<?php echo $rs['offset'] ? $rs['offset'] : 0;?>" /></div>
</div>
<div class="table hide" name="ext_is_list" ext="param">
	<div class="title">
		列表模式：<span class="note">启用列表您需要循环将数据显示（推荐使用），反之则只显示一条数据</span>
	</div>
	<div class="content">
		<ul class="layout">
			<li><label><input type="radio" name="is_list" value="0"<?php if($id && !$rs['is_list']){ ?> checked<?php } ?> /> 只读一条<span class="gray i">（使用此项请将数量设置为1）</span></label></li>
			<li><label><input type="radio" name="is_list" value="1"<?php if($rs['is_list'] || !$id){ ?> checked<?php } ?> /> 列表模式</label></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>
<div class="table hide" name="ext_in_sub" ext="param">
	<div class="title">子主题：<span class="note">是否同时读取子主题信息</span></div>
	<div class="content">
		<ul class="layout">
			<li><label><input type="radio" name="in_sub" value="0"<?php if(!$rs['in_sub']){ ?> checked<?php } ?> /> 禁用</label></li>
			<li><label><input type="radio" name="in_sub" value="1"<?php if($rs['in_sub']){ ?> checked<?php } ?> /> 启用</label></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>
<div class="table hide" name="ext_attr" ext="param">
	<div class="title">主题属性：<span class="note">设置要调用的主题属性，仅支持单选，请慎用</span></div>
	<div class="content">
		<ul class="layout">
			<li><label><input type="radio" name="attr" value=""<?php if(!$id || !$rs['attr']){ ?> checked<?php } ?> />不使用</label></li>
			<?php $tmpid["num"] = 0;$attrlist=is_array($attrlist) ? $attrlist : array();$tmpid = array();$tmpid["total"] = count($attrlist);$tmpid["index"] = -1;foreach($attrlist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
			<li><label><input type="radio" name="attr" value="<?php echo $key;?>"<?php if($rs['attr'] == $key){ ?> checked<?php } ?> /><?php echo $value;?></label></li>
			<?php } ?>
		</ul>
	</div>
</div>
<div class="table hide" name="ext_fields_need" ext="param">
	<div class="title">
		字段值必须存在：
		<span class="note">设置哪些字段值必须存在，不存在的值将不被调用，动态配置“<span class="darkblue">fields_need=标识</span>”</span>
	</div>
	<div class="content">
		<input type="text" id="fields_need" name="fields_need" class="long" value="<?php echo $rs['fields_need'];?>" />
		<input type="button" value="清空" class="btn" onclick="$('#fields_need').val('')" />
		<div class="button-group" id="fields_need_list" style="display: block;margin-top:5px;"></div>
		<div class="clear"></div>
	</div>
</div>
<div class="table hide" name="ext_fields" ext="param">
	<div class="title">
		加载扩展字段：
		<span class="note">指定读取的列表包含哪些扩展字段，动态配置“<span class="darkblue">fields=字段标识</span>”，多个标识用英文逗号隔开</span>
	</div>
	<div class="content">
		<input type="text" id="fields" name="fields" class="long" value="<?php echo $rs['fields'] ? $rs['fields'] :'*';?>" />
		<input type="button" value="清空" class="btn" onclick="$('#fields').val('')" />
		<div class="button-group" id="fields_list" style="display: block;margin-top:5px;"></div>
		<div class="clear"></div>
	</div>
</div>
<div class="table hide" name="ext_tag" ext="param">
	<div class="title">
		Tag标签：
		<span class="note">设置要调用的标签，多个Tag用英文逗号隔开，动态配置“<span class="darkblue">tag=Tag标签</span>”</span>
	</div>
	<div class="content">
		<input type="text" id="tag" name="tag" class="long" value="<?php echo $rs['tag'];?>" />
	</div>
</div>
<div class="table hide" name="ext_keywords" ext="param">
	<div class="title">
		关键字：
		<span class="note">多个关键字用英文逗号隔开，适用于获取相关内容，动态配置“<span class="darkblue">keywords=关键字</span>”</span>
	</div>
	<div class="content">
		<input type="text" id="keywords" name="keywords" class="long" value="<?php echo $rs['keywords'];?>" />
	</div>
</div>
<div class="table hide" name="ext_orderby" ext="param">
	<div class="title">
		数据排序：
		<span class="note">设置数据常用的排序方法</span>
	</div>
	<div class="content">
		<input type="text" id="orderby" name="orderby" class="long" value="<?php echo $rs['orderby'];?>" />
		<input type="button" value="清空" class="btn" onclick="$('#orderby').val('')" />
		<div class="button-group" id="orderby_li" style="display:block;margin-top:5px;"></div>
		<div class="clear"></div>
	</div>
</div>

<div id="cate_list" class="table hide"></div>

<div class="table hide" name="ext_fields_format" ext="param">
	<div class="title">
		格式化：
		<span class="note">是否将字段格式化为HTML信息，用于表单</span>
	</div>
	<div class="content">
		<ul class="layout">
			<li><label><input type="radio" name="fields_format" value="0"<?php if(!$rs['fields_format']){ ?> checked<?php } ?> /> 禁用</label></li>
			<li><label><input type="radio" name="fields_format" value="1"<?php if($rs['fields_format']){ ?> checked<?php } ?> /> 启用</label></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>
<div class="table hide" ext="param" name="ext_user_ext">
	<div class="title">
		会员扩展数据：
		<span class="note">读取数据是否同时读取相应的自定义内容数据</span>
	</div>
	<div class="content">
		<table>
		<tr>
			<td><label><input type="radio" name="user_ext" value="0"<?php if(!$rs['user_ext']){ ?> checked<?php } ?> /> 禁用</label></td>
			<td><label><input type="radio" name="user_ext" value="1"<?php if($rs['user_ext']){ ?> checked<?php } ?> /> 启用</label></td>
		</tr>
		</table>
	</div>
</div>
<div class="table hide" ext="param" name="ext_user">
	<div class="title">
		会员账号：
		<span class="note">多个账号用英文逗号隔开</span>
	</div>
	<div class="content">
		<input type="text" id="user" name="user" class="long" value="<?php echo $rs['user'];?>" />
		<input type="button" value="清空" onclick="$('#user').val('')" class="button" />
	</div>
</div>

<div class="table hide" ext="param" name="ext_usergroup">
	<div class="title">
		会员组：
		<span class="note">指定多个会员账号后，会员组选项将无效</span>
	</div>
	<div class="content">
		<select name="usergroup" id="usergroup">
			<option value="">请选择…</option>
			<?php $tmpid["num"] = 0;$usergroup=is_array($usergroup) ? $usergroup : array();$tmpid = array();$tmpid["total"] = count($usergroup);$tmpid["index"] = -1;foreach($usergroup as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
			<option value="<?php echo $value['id'];?>"<?php if($rs['usergroup'] == $value['id']){ ?> selected<?php } ?>><?php echo $value['title'];?></option>
			<?php } ?>
		</select>
	</div>
</div>

<div class="table hide" ext="param" name="ext_title_id">
	<div class="title">
		主题标识或ID：
		<span class="note">当填写为纯数字，表示ID，动态配置“<span class="darkblue">title_id=主题ID</span>”</span>
	</div>
	<div class="content">
		<input type="text" id="title_id" name="title_id" class="long" value="<?php echo $rs['title_id'];?>" />
		<input type="button" value="清空" onclick="$('#title_id').val('')" class="button" />
	</div>
</div>
<div class="table hide" ext="param" name="ext_sqlinfo">
	<div class="title">
		自定义SQL：
		<span class="note">这里的自定义的SQL不支持变量，请仔细检查</span>
	</div>
	<div class="content">
		<textarea name="sqlinfo" id="sqlinfo" style="height:200px;width:80%;"><?php echo $rs['sqlinfo'];?></textarea>
	</div>
</div>



<div class="hide" id="orderby_default">
	<input type="button" value="点击" onclick="phpok_admin_orderby('orderby','l.hits')" class="phpok-btn" />
	<input type="button" value="时间" onclick="phpok_admin_orderby('orderby','l.dateline')" class="phpok-btn" />
	<input type="button" value="回复时间" onclick="phpok_admin_orderby('orderby','l.replydate')" class="phpok-btn" />
	<input type="button" value="ID" onclick="phpok_admin_orderby('orderby','l.id')" class="phpok-btn" />
	<input type="button" value="人工" onclick="phpok_admin_orderby('orderby','l.sort')" class="phpok-btn" />
	<input type="button" value="随机，慎用" onclick="$('#orderby').val('RAND()')" class="phpok-btn" />
</div>
<div class="hide" id="fields_need_default">
	<input type="button" value="会员" onclick="fields_click('l.user_id')" class="phpok-btn" />
</div>


<div class="table">
	<div class="title">
		状态：
		<span class="note">未审核下不能被前台调用</span>
	</div>
	<div class="content">
		<ul class="layout">
			<li><label><input type="radio" name="status" value="0"<?php if($id && !$rs['status']){ ?> checked<?php } ?> />未审核</label></li>
			<li><label><input type="radio" name="status" value="1"<?php if(!$id || $rs['status']){ ?> checked<?php } ?> />已审核</label></li>
		</ul>
	</div>
</div>
<div class="table">
	<div class="title">
		API调用：
		<span class="note">是否启用API接口调用数据，此项很重要，敏感数据（如会员请禁用）请不要启用，为安全考虑，自定义SQL需要在配置文件中启用才有效</span>
	</div>
	<div class="content">
		<ul class="layout">
			<li><label><input type="radio" name="is_api" value="0"<?php if(!$rs['is_api']){ ?> checked<?php } ?> />禁用</label></li>
			<li><label><input type="radio" name="is_api" value="1"<?php if($rs['is_api']){ ?> checked<?php } ?> />支持</label></li>
		</ul>
	</div>
</div>
<br />
<div class="table">
	<div class="content">
		<input type="submit" value="提 交" class="submit2" />
	</div>
</div>
<br />
<script type="text/javascript">
$(document).ready(function(){
	chktype = $("input[name=type_id]:checked").val();
	if(chktype){
		update_type_id(chktype);
	}
});
</script>
<?php $this->output("foot","file"); ?>