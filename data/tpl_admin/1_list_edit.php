<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript" src="<?php echo include_js('list.js');?>"></script>
<div class="tips">
	<?php echo P_Lang("您当前的位置：");?><?php echo P_Lang("内容管理");?>
	<?php if($pid){ ?>
		<?php $plist_id["num"] = 0;$plist=is_array($plist) ? $plist : array();$plist_id = array();$plist_id["total"] = count($plist);$plist_id["index"] = -1;foreach($plist as $key=>$value){ $plist_id["num"]++;$plist_id["index"]++; ?>
		&raquo; <a href="<?php echo admin_url('list','action');?>&id=<?php echo $value['id'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a>
		<?php } ?>
	<?php } ?>
	<?php if($parent_id){ ?>
	&raquo; <?php echo P_Lang("父主题：");?><a href="<?php echo admin_url('list','edit');?>&id=<?php echo $parent_id;?>" title=""><span class="red"><?php echo $parent_rs['title'];?></span></a>
	<?php } ?>
	&raquo; <?php if($id){ ?><?php echo P_Lang("编辑内容");?><?php } else { ?><?php echo P_Lang("添加内容");?><?php } ?>
</div>
<ul class="group">
	<li class="on" onclick="$.admin.group(this)" name="main" title="<?php echo P_Lang("主要内容");?>"><?php echo P_Lang("主要内容");?></li>
	<?php if($p_rs['is_biz']){ ?><li onclick="$.admin.group(this)" name="biz" title="<?php echo P_Lang("启用电子商务功能");?>"><?php echo P_Lang("电子商务");?></li><?php } ?>
	<li onclick="$.admin.group(this)" name="extinfo" title="<?php echo P_Lang("扩展信息，包括SEO优化在内");?>"><?php echo P_Lang("扩展信息");?></li>
	<?php if($p_rs['is_seo']){ ?><li onclick="$.admin.group(this)" name="seo" title="<?php echo P_Lang("全站SEO信息设置");?>"><?php echo P_Lang("SEO优化");?></li><?php } ?>
</ul>

<form method="post" id="_listedit" onsubmit="return $.admin_list_edit.save()">
<input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
<input type="hidden" name="pid" id="pid" value="<?php echo $pid;?>" />
<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $parent_id;?>" />
<div id="main_setting">
	<div class="table">
		<div class="title">
			<?php if($p_rs['alias_title']){ ?><?php echo $p_rs['alias_title'];?><?php } else { ?><?php echo P_Lang("主题");?><?php } ?> <span class="note"><?php echo P_Lang("不能超过80个汉字");?><?php if($p_rs['alias_note']){ ?>，<?php echo $p_rs['alias_note'];?><?php } ?></span>
		</div>
		<div class="content">
			<input type="text" name="title" id="title" value="<?php echo $rs['title'];?>" class="title" />
		</div>
	</div>
	<?php if($attrlist && $p_rs['is_attr']){ ?>
	<div class="table">
		<div class="content">
			<ul class="layout">
				<li><?php echo P_Lang("属性：");?></li>
				<?php $attrlist_id["num"] = 0;$attrlist=is_array($attrlist) ? $attrlist : array();$attrlist_id = array();$attrlist_id["total"] = count($attrlist);$attrlist_id["index"] = -1;foreach($attrlist as $key=>$value){ $attrlist_id["num"]++;$attrlist_id["index"]++; ?>
				<li><label><input type="checkbox" name="attr[]" id="_attr_<?php echo $key;?>" value="<?php echo $key;?>"<?php if($value['status']){ ?> checked<?php } ?> /><?php echo $value['val'];?></label></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<?php } ?>
	<?php if($p_rs['is_identifier']){ ?>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("自定义网址标识");?> <span class="note"><?php echo P_Lang("仅支持字母、数字、下划线或中划线且必须是字母开头");?></span>
		</div>
		<div class="content">
			<ul class="layout">
				<li style="width:50%"><input type="text" id="identifier" name="identifier" value="<?php echo $rs['identifier'];?>" class="title" /></li>
				<li>
					<div class="button-group" id="identifier-button">
						<input type="button" value="<?php echo P_Lang("随机标识");?>" onclick="$.admin_list.rand_identifier()" class="phpok-btn" />
					</div>
				</li>
			</ul>
		</div>
	</div>
	<?php } ?>
	<?php if($p_rs['cate']){ ?>
	<div class="table">
		<div class="content">
			<select name="cate_id" id="cate_id" class="single">
				<option value=""><?php if($p_rs['cate_multiple']){ ?><?php echo P_Lang("请选择主分类…");?><?php } else { ?><?php echo P_Lang("请选择分类…");?><?php } ?></option>
				<?php $tmpid["num"] = 0;$catelist=is_array($catelist) ? $catelist : array();$tmpid = array();$tmpid["total"] = count($catelist);$tmpid["index"] = -1;foreach($catelist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
				<option value="<?php echo $value['id'];?>"<?php if($value['id'] == $rs['cate_id']){ ?> selected<?php } ?>><?php echo $value['_space'];?><?php echo $value['title'];?></option>
				<?php } ?>
			</select>
		</div>
	</div>
		<?php if($p_rs['cate_multiple']){ ?>
		<div class="table">
			<div class="title">
				<?php echo P_Lang("扩展分类：");?><span class="note"><?php echo P_Lang("支持多选");?></span>
			</div>
			<div class="content">
				<input type="text" name="ext_cate_id" id="ext_cate_id" value="<?php if($extcate){ ?><?php echo implode(',',$extcate);?><?php } ?>" style="width:99%" />
				<?php $tmpid["num"] = 0;$catelist=is_array($catelist) ? $catelist : array();$tmpid = array();$tmpid["total"] = count($catelist);$tmpid["index"] = -1;foreach($catelist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
				<input type="hidden" name="_ext_cateid" value="<?php echo $value['id'];?>" data-orderby="<?php echo $tmpid['num'];?>" data-name="<?php echo $value['title'];?>" data-space="<?php echo $value['_space'];?>" />
				<?php } ?>
			</div>
		</div>
		<?php } ?>
	<?php } ?>
	<?php if($p_rs['is_tag']){ ?>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("标签：");?>
			<span class="note"><?php echo P_Lang("多个标签用 [title] 分开，最多不能超过10个",array('title'=>'<span style="color:red">'.$tag_config['separator'].'</span>'));?></span>
		</div>
		<div class="content">
			<table width="100%">
			<tr>
				<td><input type="text" id="tag" name="tag" class='long' value='<?php echo $rs['tag'];?>' style="width:100%;" /></td>
				<td style="padding-left:10px;">
					<div class="button-group">
						<input type="button" value="<?php echo P_Lang("更多选择");?>" onclick="$.phpok_list.tag()" id="tag_more" class="phpok-btn" />
						<input type="button" value="<?php echo P_Lang("清空");?>" onclick="$('input[name=tag]').val('')" class="phpok-btn" />
					</div>
				</td>
			</tr>
			<?php if($tag_config['count'] && $taglist){ ?>
			<tr>
				<td colspan="2">
					<div class="button-group">
						<?php $tmpid["num"] = 0;$taglist=is_array($taglist) ? $taglist : array();$tmpid = array();$tmpid["total"] = count($taglist);$tmpid["index"] = -1;foreach($taglist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<input type="button" value="<?php echo $value['title'];?>" onclick="$.phpok_list.tag_append(this.value,'<?php echo $tag_config['separator'];?>')" class="phpok-btn" />
						<?php } ?>
					</div>
				</td>
			</tr>
			<?php } ?>
			</table>
		</div>
	</div>
	<?php } ?>
	<?php $extlist_id["num"] = 0;$extlist=is_array($extlist) ? $extlist : array();$extlist_id = array();$extlist_id["total"] = count($extlist);$extlist_id["index"] = -1;foreach($extlist as $key=>$value){ $extlist_id["num"]++;$extlist_id["index"]++; ?>
	<div class="table clearfix" id="form_html_<?php echo $value['identifier'];?>">
		<div class="title">
			<?php echo $value['title'];?>：
			<span class="note">
				<?php if($value['is_edit']){ ?><span class="darkblue i"><?php echo $value['identifier'];?></span><?php } ?>
				<?php echo $value['note'];?>
				<?php if($popedom['ext'] && $value['is_edit'] && $session['adm_develop']){ ?>
				<?php if($ext_module != 'add-list'){ ?>
				<a class="icon edit" onclick="ext_edit('<?php echo $value['identifier'];?>','<?php echo $ext_module;?>')"></a>
				<?php } ?>
				<a class="icon delete" onclick="ext_delete('<?php echo $value['identifier'];?>','<?php echo $ext_module;?>','<?php echo $value['title'];?>')"></a>
				<?php } ?>
			</span>
		</div>
		<div class="content"><?php echo $value['html'];?></div>
	</div>
	<?php } ?>
	<?php if($popedom['ext'] && $session['adm_develop']){ ?>
	<div class="table">
		<div class="content">
			<ul class="layout">
				<li>
					<select id="_tmp_select_add" style="padding:3px">
						<option value=""><?php echo P_Lang("主题自定义扩展字段…");?></option>
						<?php $extfields_id["num"] = 0;$extfields=is_array($extfields) ? $extfields : array();$extfields_id = array();$extfields_id["total"] = count($extfields);$extfields_id["index"] = -1;foreach($extfields as $key=>$value){ $extfields_id["num"]++;$extfields_id["index"]++; ?>
						<option value="<?php echo $value['identifier'];?>"><?php echo $value['title'];?> - <?php echo $value['identifier'];?></option>
						<?php } ?>
					</select>
				</li>
				<li>
					<div class="button-group">
						<input type="button" value="<?php echo P_Lang("快速添加");?>" onclick="$.admin_list.update_select_add('<?php echo $ext_module;?>')" class="phpok-btn" />
						<input type="button" value="<?php echo P_Lang("手动创建字段");?>" onclick="ext_add('<?php echo $ext_module;?>')" class="phpok-btn" />
					</div>
				</li>
			</ul>
		</div>
	</div>
	<?php } ?>
</div>

<?php if($p_rs['is_biz']){ ?>
<div id="biz_setting" class="hide">
	<div class="table">
		<div class="title">
			<?php echo P_Lang("产品类型：");?>
		</div>
		<div class="content">
			<ul class="layout">
				<li><label><input type="radio" name="is_virtual" value="0"<?php if(!$rs['is_virtual']){ ?> checked<?php } ?> /><?php echo P_Lang("实物");?></label></li>
				<li><label><input type="radio" name="is_virtual" value="1"<?php if($rs['is_virtual']){ ?> checked<?php } ?> /><?php echo P_Lang("服务");?></label></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("销售价格：");?><span class="note"><?php echo P_Lang("请设置产品的价格及计算货币类型");?></span>
		</div>
		<div class="content">
			<ul class="layout">
				<li><input type="text" name="price" id="price" value="<?php echo $rs['price'];?>" class="title" /></li>
				<li>
					<select name="currency_id" id="currency_id" onchange="price_show_auto()">
						<?php $currency_list_id["num"] = 0;$currency_list=is_array($currency_list) ? $currency_list : array();$currency_list_id = array();$currency_list_id["total"] = count($currency_list);$currency_list_id["index"] = -1;foreach($currency_list as $key=>$value){ $currency_list_id["num"]++;$currency_list_id["index"]++; ?>
						<option value="<?php echo $value['id'];?>"<?php if($rs['currency_id'] == $value['id']){ ?> selected<?php } ?> code="<?php echo $value['code'];?>" rate="<?php echo $value['val'];?>" sleft="<?php echo $value['symbol_left'];?>" sright="<?php echo $value['symbol_right'];?>"><?php echo $value['title'];?></option>
						<?php } ?>
					</select>
				</li>
			</ul>
		</div>
	</div>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("计量单位：");?><span class="note"><?php echo P_Lang("填写产品的计量单位，以方便结算");?></span>
		</div>
		<div class="content">
			<ul class="layout">
				<li><input type="text" id="unit" name="unit" value="<?php echo $rs['unit'];?>" /></li>
				<?php if($unitlist){ ?>
				<li>
					<div class="button-group">
						<?php $tmpid["num"] = 0;$unitlist=is_array($unitlist) ? $unitlist : array();$tmpid = array();$tmpid["total"] = count($unitlist);$tmpid["index"] = -1;foreach($unitlist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<input type="button" value="<?php echo $value;?>" onclick="$('#unit').val(this.value)" class="phpok-btn" />
						<?php } ?>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("重量");?>：<span class="note"><?php echo P_Lang("设置产品重量，可用于计算基于重量的运费，单位是千克，请注意换算");?></span>
		</div>
		<div class="content">
			<input type="text" id="weight" name="weight" value="<?php echo $rs['weight'];?>" /> Kg
		</div>
	</div>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("体积：");?><span class="note"><?php echo P_Lang("设置产品体积，可用于计算基于体积的运费，单位是立方米，请注意换算");?></span>
		</div>
		<div class="content">
			<input type="text" id="volume" name="volume" value="<?php echo $rs['volume'];?>" /> M<sup>3</sup>
		</div>
	</div>
	

	<?php if($p_rs['biz_attr']){ ?>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("产品属性");?>：
			<span class="note"><?php echo P_Lang("负号表示价格下调，加号或无符号表示价格上调，如+10或10，表示加10，-10表示减10");?></span>
		</div>
		<div class="content">
			<input type="hidden" name="_biz_attr" id="_biz_attr" value="<?php echo $_attr;?>" />
			<div>
				<table cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<select id="biz_attr_id" onchange="$.admin_list_edit.attr_add(this.value)">
							<option value=""><?php echo P_Lang("请选择一个属性操作内容…");?></option>
							<?php $tmpid["num"] = 0;$biz_attrlist=is_array($biz_attrlist) ? $biz_attrlist : array();$tmpid = array();$tmpid["total"] = count($biz_attrlist);$tmpid["index"] = -1;foreach($biz_attrlist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
							<option value="<?php echo $value['id'];?>"><?php echo $value['title'];?></option>
							<?php } ?>
						</select>
					</td>
					<td>&nbsp;</td>
					<td><input type="button" value="<?php echo P_Lang("添加新属性");?>" onclick="$.admin_list_edit.attr_create()" class="phpok-btn" /></td>
				</tr>
				</table>
			</div>
			<ul id="biz_attr_options" class="layout">
			</ul>
		</div>
	</div>
	<?php } ?>
</div>
<?php } ?>

<div id="extinfo_setting" class="hide">
	<div class="table">
		<div class="title">
			<?php echo P_Lang("状态：");?>
		</div>
		<div class="content">
			<ul class="layout">
				<li><label><input type="radio" name="status" id="status_0" value="0"<?php if($id && !$rs['status']){ ?> checked<?php } ?> /><?php echo P_Lang("未审核");?></label></li>
				<li><label><input type="radio" name="status" id="status_1" value="1"<?php if(!$id || $rs['status']){ ?> checked<?php } ?> /><?php echo P_Lang("已审核");?></label></li>
			</ul>
		</div>
	</div>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("是否隐藏：");?>
		</div>
		<div class="content">
			<ul class="layout">
				<li><label><input type="radio" name="hidden" id="hidden_0" value="0"<?php if(!$rs['hidden']){ ?> checked<?php } ?> /><?php echo P_Lang("显示");?></label></li>
				<li><label><input type="radio" name="hidden" id="hidden_1" value="1"<?php if($rs['hidden']){ ?> checked<?php } ?> /><?php echo P_Lang("隐藏");?></label></li>
			</ul>
		</div>
	</div>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("发布时间：");?><span class="note"><?php echo P_Lang("自定义发布时间，留空使用系统时间");?></span>
		</div>
		<div class="content">
			<ul class="layout">
				<li><input type="text" id="dateline" name="dateline" class="default" value="<?php if($rs['dateline']){ ?><?php echo date('Y-m-d H:i:s',$rs['dateline']);?><?php } ?>" onfocus="$.admin_list.show_date()" /></li>
				<li>
					<div class="button-group">
						<input type="button" value="<?php echo P_Lang("时间选择器");?>" class="phpok-btn" id="btn_dateline_datetime" onclick="$.phpokform.laydate_button('dateline','datetime')" />
						<input type="button" value="<?php echo P_Lang("清空");?>" onclick="$.phpokform.clear('dateline')" class="phpok-btn" />
					</div>
				</li>
			</ul>
			
		</div>
	</div>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("阅读次数：");?><span class="note"><?php echo P_Lang("正常情况请不要设置，以保证数据的准确，仅支持整数");?></span>
		</div>
		<div class="content">
			<input type="text" id="hits" name="hits" value="<?php echo $rs['hits'];?>" />
		</div>
	</div>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("财富基数：");?><span class="note"><?php echo P_Lang("只支持整数，用于计算会员虚拟财富增减");?></span>
		</div>
		<div class="content">
			<input type="text" id="integral" name="integral" value="<?php echo $rs['integral'];?>" />
		</div>
	</div>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("排序");?><span class="note"><?php echo P_Lang("排序值只支持数字，不清楚请留空");?></span>
		</div>
		<div class="content">
			<input type="text" id="sort" name="sort" value="<?php echo $rs['sort'];?>" />
		</div>
	</div>
	<?php if($p_rs['is_userid']){ ?>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("绑定会员");?><span class="note"><?php echo P_Lang("绑定会员功能，允许会员对主题进行修改或删除，需要开放发布权限");?></span>
		</div>
		<div class="content"><?php echo form_edit('user_id',$rs['user_id'],'user');?></div>
	</div>
	<?php } ?>
	<?php if($p_rs['is_tpl_content']){ ?>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("自定义内容模板");?><span class="note"><?php echo P_Lang("为空将使用");?> <span class="red"><?php echo $p_rs['tpl_content'] ? $p_rs['tpl_content'] : $p_rs['identifier'].'_content';?></span></span>
		</div>
		<div class="content">
			<ul class="layout">
				<li><input type="text" id="tpl" name="tpl" class="default" value="<?php echo $rs['tpl'];?>" /></li>
				<li>
					<div class="button-group">
						<input type="button" value="<?php echo P_Lang("选择");?>" onclick="phpok_tpl_open('tpl')" class="phpok-btn" />
						<input type="button" value="<?php echo P_Lang("清空");?>" onclick="$('#tpl').val('');" class="phpok-btn" />
					</div>
				</li>
			</ul>
		</div>
	</div>
	<?php } ?>
</div>

<?php if($p_rs['is_seo']){ ?>
<div id="seo_setting" class="hide">
	<div class="table">
		<div class="title">
			<?php echo P_Lang("SEO标题：");?><span class="note"><?php echo P_Lang("设置此标题后，网站Title将会替代默认定义的，不能超过50个汉字");?></span>
		</div>
		<div class="content">
			<input type="text" id="seo_title" name="seo_title" class="title" value="<?php echo $rs['seo_title'];?>" />
		</div>
	</div>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("SEO关键字：");?><span class="note"><?php echo P_Lang("多个关键字用英文逗号隔开，为空将使用默认");?></span>
		</div>
		<div class="content">
			<input type="text" id="seo_keywords" name="seo_keywords" class="title" value="<?php echo $rs['seo_keywords'];?>" />
		</div>
	</div>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("SEO描述：");?><span class="note"><?php echo P_Lang("简单描述该主题信息，用于搜索引挈，不支持HTML，不能超过80个汉字");?></span>
		</div>
		<div class="content">
			<textarea name="seo_desc" id="seo_desc" class="long" style="width:100%"><?php echo $rs['seo_desc'];?></textarea>
		</div>
	</div>
</div>
<?php } ?>



<div class="clear"></div>
<div class="submit-info"><input type="submit" value="<?php echo P_Lang("提交");?>" class="submit2 phpok_submit_click" /></div>
</form>
<?php $this->output("foot","file"); ?>