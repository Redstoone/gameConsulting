<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><input type="hidden" name="ext_form_id" id="ext_form_id" value="option_list,put_order,ext_select" />
<div class="table">
	<div class="title">
		单选属性列表：
		<span class="note">请选择单选的来源</span>
	</div>
	<div class="content">
		<table>
		<tr>
			<td><select name="option_list" id="option_list">
					<option value="">请选择……</option>
					<optgroup label="表单">
						<?php $opt_list_id["num"] = 0;$opt_list=is_array($opt_list) ? $opt_list : array();$opt_list_id = array();$opt_list_id["total"] = count($opt_list);$opt_list_id["index"] = -1;foreach($opt_list as $key=>$value){ $opt_list_id["num"]++;$opt_list_id["index"]++; ?>
						<option value="opt:<?php echo $value['id'];?>"<?php if($rs['option_list'] == "opt:".$value['id']){ ?> selected<?php } ?>><?php echo $value['title'];?></option>
						<?php } ?>
					</optgroup>
					<?php if($project_list){ ?>
					<optgroup label="子项">
						<?php $project_list_id["num"] = 0;$project_list=is_array($project_list) ? $project_list : array();$project_list_id = array();$project_list_id["total"] = count($project_list);$project_list_id["index"] = -1;foreach($project_list as $key=>$value){ $project_list_id["num"]++;$project_list_id["index"]++; ?>
						<option value="project:<?php echo $value['id'];?>"<?php if($rs['option_list'] == "project:".$value['id']){ ?> selected<?php } ?>><?php echo $value['title'];?></option>
						<?php } ?>
					</optgroup>					
					<?php } ?>
					<?php if($title_list){ ?>
					<optgroup label="主题">
						<?php $title_list_id["num"] = 0;$title_list=is_array($title_list) ? $title_list : array();$title_list_id = array();$title_list_id["total"] = count($title_list);$title_list_id["index"] = -1;foreach($title_list as $key=>$value){ $title_list_id["num"]++;$title_list_id["index"]++; ?>
						<option value="title:<?php echo $value['id'];?>"<?php if($rs['option_list'] == "title:".$value['id']){ ?> selected<?php } ?>><?php echo $value['title'];?></option>
						<?php } ?>
					</optgroup>
					<?php } ?>
					<?php if($catelist){ ?>
					<optgroup label="分类">
						<?php $catelist_id["num"] = 0;$catelist=is_array($catelist) ? $catelist : array();$catelist_id = array();$catelist_id["total"] = count($catelist);$catelist_id["index"] = -1;foreach($catelist as $key=>$value){ $catelist_id["num"]++;$catelist_id["index"]++; ?>
						<option value="cate:<?php echo $value['id'];?>"<?php if($rs['option_list'] == "cate:".$value['id']){ ?> selected<?php } ?>><?php echo $value['title'];?></option>
						<?php } ?>
					</optgroup>
					<?php } ?>
				</select>
			</td>
		</tr>
		</table>		
	</div>
</div>
<div class="table">
	<div class="title">
		单选内容：
		<span class="note">仅限于单选属性列表为空的情况下有效，这里一行一个值，复杂操作请到表单选项里维护</span>
	</div>
	<div class="content">
		<textarea name="ext_select" style="width:99%;height:180px;"><?php echo $rs['ext_select'];?></textarea>
	</div>
</div>
<div class="table">
	<div class="title">
		排列方式：
		<span class="note"></span>
	</div>
	<div class="content">
		<table>
		<tr>
			<td><label><input type="radio" name="put_order" value="0"<?php if(!$rs['put_order']){ ?> checked <?php } ?> /> 横向排列</label></td>
			<td>&nbsp; &nbsp;</td>
			<td><label><input type="radio" name="put_order" value="1"<?php if($rs['put_order']){ ?> checked <?php } ?> /> 纵向排列</label></td>
			<td></td>
		</tr>
		</table>
	</div>
</div>
