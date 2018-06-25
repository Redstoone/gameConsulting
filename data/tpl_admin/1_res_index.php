<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript" src="js/laydate/laydate.js"></script>
<div class="tips">
	<div class="action"><a href="javascript:$.admin_res.edit_local();void(0);"><?php echo P_Lang("编辑器图片配置");?></a></div>
	<div class="action"><a href="javascript:$.admin_res.update_pl_pictures();void(0);"><?php echo P_Lang("图片全部更新");?></a></div>
	<div class="action"><a href="javascript:$.admin_res.add_file();void(0)"><?php echo P_Lang("添加资源");?></a></div>
	<?php echo P_Lang("您当前的位置：");?><?php echo P_Lang("资源管理");?> &raquo; <?php echo P_Lang("列表");?>
	<div class="clear"></div>
</div>
<div id="move_cate_html" class="hide">
<table>
<?php $tmpid["num"] = 0;$catelist=is_array($catelist) ? $catelist : array();$tmpid = array();$tmpid["total"] = count($catelist);$tmpid["index"] = -1;foreach($catelist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
<tr>
	<td><input type="radio" name="newcate" id="newcate_<?php echo $value['id'];?>" value="<?php echo $value['id'];?>"<?php if($tmpid['num'] == 1){ ?> checked<?php } ?> /></td>
	<td><label for="newcate_<?php echo $value['id'];?>"><?php echo $value['title'];?><?php if($value['typeinfos']){ ?> <span class="gray i">支持类型：<?php echo $value['typeinfos'];?></span><?php } ?></label></td>
</tr>
<?php } ?>
</table>
</div>
<div class="tips" id="adv_search">
	<form method="post" action="<?php echo phpok_url(array('ctrl'=>'res'));?>">
	<table width="100%">
	<tr>
		<td width="50%">
			<div class="table">
				<div class="title">
					<?php echo P_Lang("关键字：");?>
					<span class="note"><?php echo P_Lang("填写附件名称关键字");?></span>
				</div>
				<div class="content"><input type="text" id="keywords" name="keywords" class="long" value="<?php echo $keywords;?>" /></div>
			</div>
		</td>
		<td>
			<div class="table">
				<div class="title">
					<?php echo P_Lang("附件分类：");?>
				</div>
				<div class="content">
					<select id="cate_id" name="cate_id">
						<option value="0"><?php echo P_Lang("不限");?></option>
						<?php $catelist_id["num"] = 0;$catelist=is_array($catelist) ? $catelist : array();$catelist_id = array();$catelist_id["total"] = count($catelist);$catelist_id["index"] = -1;foreach($catelist as $key=>$value){ $catelist_id["num"]++;$catelist_id["index"]++; ?>
						<option value="<?php echo $value['id'];?>"<?php if($cate_id == $value['id']){ ?> selected<?php } ?>><?php echo $value['title'];?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="table">
				<div class="title">
					<?php echo P_Lang("时间范围：");?>
					<span class="note"><?php echo P_Lang("左侧是开始时间，右边是结束时间");?></span>
				</div>
				<div class="content">
					<table cellpadding="0" cellspacing="0">
					<tr>
						<td><input type="text" id="start_date" name="start_date" value="<?php echo $start_date;?>" placeholder="<?php echo P_Lang("开始时间");?>" onfocus="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" /></td>
						<td>&nbsp; - &nbsp;</td>
						<td><input type="text" id="stop_date" name="stop_date" value="<?php echo $stop_date;?>" placeholder="<?php echo P_Lang("结束时间");?>" onfocus="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" /></td>
					</tr>
					</table>
				</div>
			</div>
			
		</td>
		<td>
			<div class="table">
				<div class="content">
					<input type="submit" value="开始搜索" class="submit" />
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div class="table">
				<div class="title">
					<?php echo P_Lang("附件类型：");?>
					<span class="note"><?php echo P_Lang("勾选要搜索的附件类型，如果有未列出来的附件类型，请在编辑框中输入，多种附件类型用逗号隔开");?></span>
				</div>
				<div class="content">
					<table>
					<tr>
						<td><label><input type="checkbox" id="type_jpg" name="ext[]" value="jpg"<?php if($ext && in_array('jpg',$ext)){ ?> checked<?php } ?> /> JPG</label></td>
						<td><label><input type="checkbox" id="type_gif" name="ext[]" value="gif"<?php if($ext && in_array('gif',$ext)){ ?> checked<?php } ?> /> GIF</label></td>
						<td><label><input type="checkbox" id="type_png" name="ext[]" value="png"<?php if($ext && in_array('png',$ext)){ ?> checked<?php } ?> /> PNG</label></td>
						<td><label><input type="checkbox" id="type_rar" name="ext[]" value="rar"<?php if($ext && in_array('rar',$ext)){ ?> checked<?php } ?> /> RAR</label></td>
						<td><label><input type="checkbox" id="type_zip" name="ext[]" value="zip"<?php if($ext && in_array('zip',$ext)){ ?> checked<?php } ?> /> ZIP</label></td>
						<td><label><input type="checkbox" id="type_flv" name="ext[]" value="flv"<?php if($ext && in_array('flv',$ext)){ ?> checked<?php } ?> /> FLV</label></td>
						<td><label><input type="checkbox" id="type_swf" name="ext[]" value="swf"<?php if($ext && in_array('swf',$ext)){ ?> checked<?php } ?> /> SWF</label></td>
						<td><label><input type="checkbox" id="type_mp3" name="ext[]" value="mp3"<?php if($ext && in_array('mp3',$ext)){ ?> checked<?php } ?> /> MP3</label></td>
					</tr>
					<tr>
						<td>&nbsp;  &nbsp; <?php echo P_Lang("其他：");?></td>
						<td colspan="7"><input type="text" id="myext" name="myext" value="<?php echo $myext;?>" class="long" /></td>
					</tr>
					</table>
				</div>
			</div>
		</td>
	</tr>
	</table>
	</form>
</div>
<style type="text/css">
.thumb{float:left;width:144px;margin:3px 5px;padding:1px;border:1px solid #ccc;border-radius:3px;position:relative;z-index:1;}
.thumb div.checkbox{position:absolute;left:2px;top:2px;z-index:2;}
</style>

<ul class="attrlist clearfix" id="attr2list">
	<?php $tmpid["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$tmpid = array();$tmpid["total"] = count($rslist);$tmpid["index"] = -1;foreach($rslist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
	<div class="thumb">
		<div class="checkbox"><input type="checkbox" name="attrid[]" id="attrid_<?php echo $value['id'];?>" value="<?php echo $value['id'];?>" /></div>
		<label for="attrid_<?php echo $value['id'];?>"><div style="text-align:center;"><img src="<?php echo $value['ico'];?>" width="100" height="100" /></div></label>
		<div class="file-action" style="text-align:center;"><div class="button-group">
			<input type="button" value="<?php echo P_Lang("修改");?>" class="phpok-btn" onclick="$.admin_res.modify('<?php echo $value['id'];?>')" />
			<input type="button" value="<?php echo P_Lang("预览");?>" class="phpok-btn" onclick="$.admin_res.preview_attr('<?php echo $value['id'];?>')" />
			<input type="button" value="<?php echo P_Lang("删除");?>" class="phpok-btn" onclick="$.admin_res.file_delete('<?php echo $value['id'];?>')" /></div>
		</div></div>
	</div>
	<?php } ?>
	<div class="clear"></div>
</ul>

<div class="table">
<table width="100%">
<tr>
	<td>
		<div class="button-group">
			<input type="button" value="<?php echo P_Lang("全选");?>" onclick="$.input.checkbox_all('.checkbox input[type=checkbox]')" class="phpok-btn" />
			<input type="button" value="<?php echo P_Lang("全不选");?>" onclick="$.input.checkbox_none('.checkbox input[type=checkbox]')" class="phpok-btn" />
			<input type="button" value="<?php echo P_Lang("反选");?>" onclick="$.input.checkbox_anti('.checkbox input[type=checkbox]')" class="phpok-btn" />
		</div>
		<div class="button-group">
			<input type="button" value="<?php echo P_Lang("移动分类");?>" onclick="$.admin_res.move_cate()" class="phpok-btn" />
			<input type="button" value="<?php echo P_Lang("更新图片");?>" onclick="$.admin_res.pl_update()" class="phpok-btn" />
			<input type="button" value="<?php echo P_Lang("删除");?>" onclick="$.admin_res.pl_delete()" class="phpok-btn" />
		</div>
	</td>
	<td align="right"><?php $this->output("pagelist","file"); ?></td>
</tr>
</table>

</div>

<?php $this->output("foot","file"); ?>