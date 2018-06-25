<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<div class="tips">
	<?php echo P_Lang("当前位置：");?><?php echo P_Lang("订单常规配置");?> &raquo; 请根据您的实际使用环境配置相应的信息
	<div class="clear"></div>
</div>

<script type="text/javascript">
function edit_it(id)
{
	var url = get_url('site','order_status_set','id='+id);
	$.dialog.open(url,{
		'title':'编辑',
		'lock':true,
		'width':'550px',
		'height':'500px',
		'ok':function(){
			var iframe = this.iframe.contentWindow;
			if (!iframe.document.body) {
				alert('iframe还没加载完毕呢');
				return false;
			};
			iframe.save();
			return false;
		},'okVal':'提交修改','cancel':function(){},'cancelVal':'取消关闭'
	})
}
function edit_price(code)
{
	var url = get_url('site','price_status_save','id='+code);
	var title = $("#price_title_"+code).val();
	if(title){
		url += "&title="+$.str.encode(title);
	}
	var action = $("#price_action_"+code).val();
	if(action){
		url += "&action="+$.str.encode(action);
	}
	var status = $("#price_status_"+code).val();
	if(status){
		url += "&status="+$.str.encode(status);
	}
	var taxis = $("#price_taxis_"+code).val();
	if(taxis){
		url += "&taxis="+$.str.encode(taxis);
	}
	$.phpok.json(url,function(rs){
		if(rs.status == 'ok'){
			$.dialog.tips('标识：<span class="red">'+code+'</span> 配置更新成功');
		}else{
			$.dialog.alert(rs.content);
			return false;
		}
	});
}
function admin_add_it()
{
	var url = get_url('site','admin_status_set');
	$.dialog.open(url,{
		'title':p_lang('添加状态'),
		'lock':true,
		'width':'450px',
		'height':'300px',
		'ok':function(){
			var iframe = this.iframe.contentWindow;
			if (!iframe.document.body) {
				alert('iframe还没加载完毕呢');
				return false;
			};
			iframe.save();
			return false;
		},
		'okVal':p_lang('提交保存'),
		'cancel':true
	})
}
function admin_edit_it(id)
{
	var url = get_url('site','admin_status_set',"id="+id);
	$.dialog.open(url,{
		'title':p_lang('编辑状态') + " #"+id,
		'lock':true,
		'width':'450px',
		'height':'300px',
		'ok':function(){
			var iframe = this.iframe.contentWindow;
			if (!iframe.document.body) {
				alert('iframe还没加载完毕呢');
				return false;
			};
			iframe.save();
			return false;
		},
		'okVal':p_lang('提交保存'),
		'cancel':true
	})
}
</script>
<ul class="group">
	<li<?php if(!$type || $type=='status'){ ?> class="on"<?php } ?> onclick="$.phpok.go('<?php echo phpok_url(array('ctrl'=>'site','func'=>'order_status','type'=>'status'));?>')" name="status"><?php echo P_Lang("前台订单状态");?></li>
	<li<?php if($type && $type == 'adm_status'){ ?> class="on"<?php } ?> onclick="$.phpok.go('<?php echo phpok_url(array('ctrl'=>'site','func'=>'order_status','type'=>'adm_status'));?>')" name="adm_status"><?php echo P_Lang("后台订单状态");?></li>
	<li<?php if($type && $type == 'price'){ ?> class="on"<?php } ?> onclick="$.phpok.go('<?php echo phpok_url(array('ctrl'=>'site','func'=>'order_status','type'=>'price'));?>')" name="price"><?php echo P_Lang("订单价格方案");?></li>
</ul>
<div id="status_setting"<?php if($type != 'status'){ ?> class="hide"<?php } ?> style="padding:0 10px">
	<table width="100%" cellpadding="0" cellspacing="0" class="list">
	<tr>
		<th class="lft">标识</th>
		<th>排序</th>
		<th class="lft">名称</th>
		<th>状态</th>
		<th class="lft">通知会员</th>
		<th class="lft">通知管理员</th>
		<th>&nbsp;</th>
	</tr>
	<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id = array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist as $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
	<tr>
		<td><?php echo $value['identifier'];?></td>
		<td class="center"><?php echo $value['taxis'];?></td>
		<td><?php echo $value['title'];?></td>
		<td class="center"><?php if($value['status']){ ?><?php echo P_Lang("启用");?><?php } else { ?><span class="red">禁用</span><?php } ?></td>
		<td>
			<?php if(!$value['email_tpl_user'] && !$value['sms_tpl_user']){ ?><span class="red">不通知</span><?php } ?>
			<?php if($value['email_tpl_user'] && $value['sms_tpl_user']){ ?>
			邮件 + 短信
			<?php } else { ?>
				<?php if($value['email_tpl_user']){ ?>邮件<?php } ?>
				<?php if($value['sms_tpl_user']){ ?>短信<?php } ?>
			<?php } ?>
		</td>
		<td>
			<?php if(!$value['email_tpl_admin'] && !$value['sms_tpl_admin']){ ?><span class="red">不通知</span><?php } ?>
			<?php if($value['email_tpl_admin'] && $value['sms_tpl_admin']){ ?>
			邮件 + 短信
			<?php } else { ?>
				<?php if($value['email_tpl_admin']){ ?>邮件<?php } ?>
				<?php if($value['sms_tpl_admin']){ ?>短信<?php } ?>
			<?php } ?>
		</td>
		<td><input type="button" value="<?php echo P_Lang("编辑");?>" onclick="edit_it('<?php echo $value['identifier'];?>')" class="phpok-btn" /></td>
	</tr>
	<?php } ?>
	</table>
</div>

<div id="adm_status_setting"<?php if(!$type || $type != 'adm_status'){ ?> class="hide"<?php } ?> style="padding:0 10px">
	<table width="100%" cellpadding="0" cellspacing="0" class="list">
	<tr>
		<th class="lft">标识</th>
		<th>排序</th>
		<th class="lft">名称</th>
		<th class="lft">前台订单状态</th>
		<th>状态</th>
		<th><input type="button" value="添加" onclick="admin_add_it()" class="phpok-btn" /></th>
	</tr>
	<?php $admin_statuslist_id["num"] = 0;$admin_statuslist=is_array($admin_statuslist) ? $admin_statuslist : array();$admin_statuslist_id = array();$admin_statuslist_id["total"] = count($admin_statuslist);$admin_statuslist_id["index"] = -1;foreach($admin_statuslist as $key=>$value){ $admin_statuslist_id["num"]++;$admin_statuslist_id["index"]++; ?>
	<tr>
		<td><?php echo $value['identifier'];?></td>
		<td class="center"><?php echo $value['taxis'];?></td>
		<td><?php echo $value['title'];?></td>
		<td><?php echo $value['ostatus'];?></td>
		<td class="center"><?php if($value['status']){ ?><?php echo P_Lang("启用");?><?php } else { ?><span class="red">禁用</span><?php } ?></td>
		<td class="center"><input type="button" value="<?php echo P_Lang("编辑");?>" onclick="admin_edit_it('<?php echo $value['identifier'];?>')" class="phpok-btn" /></td>
	</tr>
	<?php } ?>
	</table>
</div>
<div id="price_setting"<?php if(!$type || $type != 'price'){ ?> class="hide"<?php } ?> style="padding:0 10px">
	<table width="100%" cellpadding="0" cellspacing="0" class="list">
	<tr>
		<th class="lft" width="100">标识</th>
		<th class="lft">名称</th>
		<th>金额动作</th>
		<th>状态</th>
		<th>排序</th>
		<th>&nbsp;</th>
	</tr>
	<?php $pricelist_id["num"] = 0;$pricelist=is_array($pricelist) ? $pricelist : array();$pricelist_id = array();$pricelist_id["total"] = count($pricelist);$pricelist_id["index"] = -1;foreach($pricelist as $key=>$value){ $pricelist_id["num"]++;$pricelist_id["index"]++; ?>
	<tr>
		<td><?php echo $value['identifier'];?></td>
		<td><input type="text" id="price_title_<?php echo $value['identifier'];?>" value="<?php echo $value['title'];?>" /></td>
		<td class="center">
			<select id="price_action_<?php echo $value['identifier'];?>">
				<option value="add">+</option>
				<option value="less"<?php if($value['action'] == 'less'){ ?> selected<?php } ?>>-</option>
			</select>
		</td>
		<td class="center">
			<select id="price_status_<?php echo $value['identifier'];?>">
				<option value="0">禁用</option>
				<option value="1"<?php if($value['status']){ ?> selected<?php } ?>>启用</option>
			</select>
		</td>
		<td class="center"><input type="text" id="price_taxis_<?php echo $value['identifier'];?>" value="<?php echo $value['taxis'];?>" class="center short" /></td>
		<td><input type="button" value="<?php echo P_Lang("编辑");?>" onclick="edit_price('<?php echo $value['identifier'];?>')" class="phpok-btn" /></td>
	</tr>
	<?php } ?>
	</table>
</div>
<?php $this->output("foot","file"); ?>