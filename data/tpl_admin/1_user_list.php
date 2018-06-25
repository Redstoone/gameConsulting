<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript" src="<?php echo add_js('user.js');?>"></script>
<div class="tips">
	<table width="100%" cellpadding="0" cellspacing="0" height="100%">
	<tr>
		<td>&raquo; <a href="<?php echo phpok_url(array('ctrl'=>'user'));?>"><?php echo P_Lang("会员列表");?></a></td>
		<td>
			<table>
			<tr>
				<form method="post" action="<?php echo phpok_url(array('ctrl'=>'user'));?>">
				<td>
					<select name="group_id">
						<option value=""><?php echo P_Lang("全部");?></option>
						<?php $tmpid["num"] = 0;$grouplist=is_array($grouplist) ? $grouplist : array();$tmpid = array();$tmpid["total"] = count($grouplist);$tmpid["index"] = -1;foreach($grouplist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<option value="<?php echo $value['id'];?>"<?php if($group_id == $value['id']){ ?> selected<?php } ?>><?php echo $value['title'];?></option>
						<?php } ?>
					</select>
				</td>
				<td>
					<select name="keytype" id="keytype">
						<?php $tmpid["num"] = 0;$flist=is_array($flist) ? $flist : array();$tmpid = array();$tmpid["total"] = count($flist);$tmpid["index"] = -1;foreach($flist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<option value="<?php echo $key;?>"<?php if($key == $keytype){ ?> selected<?php } ?>><?php echo $value;?></option>
						<?php } ?>
					</select>
				</td>
				<td><input type="text" id="keywords" name="keywords" value="<?php echo $keywords;?>" /></td>
				<td><input type="submit" value="<?php echo P_Lang("搜索");?>" class="submit" /></td>
				</form>
			</tr>
			</table>
		</td>
		<td align="right">
			<div class="action"><a href="<?php echo phpok_url(array('ctrl'=>'user','func'=>'set'));?>"><?php echo P_Lang("添加会员");?></a></div>
			<?php if($session['admin_rs']['if_system']){ ?>
			<div class="action"><a href="javascript:$.admin_user.show_setting();void(0);"><?php echo P_Lang("显示字段设置");?></a></div>
			<?php } ?>
		</td>
	</tr>
	</table>
</div>
<div class="list">
<table width="100%" class="list" cellpadding="0" cellspacing="0">
<tr>
	<th width="50px">ID</th>
	<th width="35px">&nbsp;</th>
	<th width="35px"></th>
	<?php $arealist_id["num"] = 0;$arealist=is_array($arealist) ? $arealist : array();$arealist_id = array();$arealist_id["total"] = count($arealist);$arealist_id["index"] = -1;foreach($arealist as $key=>$value){ $arealist_id["num"]++;$arealist_id["index"]++; ?>
	<th class="lft"><?php echo P_Lang($value);?></th>
	<?php } ?>
	<?php $tmpid["num"] = 0;$wlist=is_array($wlist) ? $wlist : array();$tmpid = array();$tmpid["total"] = count($wlist);$tmpid["index"] = -1;foreach($wlist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
	<th class="lft" style="min-width:100px;"><?php echo $value['title'];?></th>
	<?php } ?>
	<th width="130px"><?php echo P_Lang("注册时间");?></th>
	<th></th>
</tr>
<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id = array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist as $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
<tr>
	<td align="center"><?php echo $value['id'];?></td>
	<td><span id="status_<?php echo $value['id'];?>" onclick="set_status(<?php echo $value['id'];?>)" class="status<?php echo $value['status'];?>" value="<?php echo $value['status'];?>"></span></td>
	<td align="center"><img src="<?php echo $value['avatar'] ? $value['avatar'] : 'images/user_default.png';?>" border="0" width="24px" height="24px" /></td>
	<?php $arealist_id["num"] = 0;$arealist=is_array($arealist) ? $arealist : array();$arealist_id = array();$arealist_id["total"] = count($arealist);$arealist_id["index"] = -1;foreach($arealist as $k=>$v){ $arealist_id["num"]++;$arealist_id["index"]++; ?>
	<td align="left">
		<?php if(is_array($value[$k])){ ?>
			<?php if($value[$k]['_admin']['type'] == 'pic'){ ?>
			<img src='<?php echo $value[$k]["_admin"]["info"];?>' border="0" width="28px" height="28px" />
			<?php } else { ?>
			<?php echo $value[$k]['_admin']['info'];?>			
			<?php } ?>
		<?php } else { ?>
			<?php if($k == 'group_id'){ ?>
			<?php echo $grouplist[$value[$k]]['title'];?>
			<?php } else { ?>
			<?php echo $value[$k];?>
			<?php } ?>
		<?php } ?>
	</td>
	<?php } ?>
	<?php $wlist_id["num"] = 0;$wlist=is_array($wlist) ? $wlist : array();$wlist_id = array();$wlist_id["total"] = count($wlist);$wlist_id["index"] = -1;foreach($wlist as $k=>$v){ $wlist_id["num"]++;$wlist_id["index"]++; ?>
	<td class="lft">
		<?php echo $value['wealth'][$k] ? $value['wealth'][$k] : 0;?><?php echo $v['unit'];?>
		<a onclick="action_wealth('<?php echo $v['title'];?>','<?php echo $v['id'];?>','<?php echo $value['id'];?>','<?php echo $v['unit'];?>')" class="ico go" title="调整"></a>
		<a class="ico page" onclick="show_wealth_log('<?php echo $v['title'];?>','<?php echo $v['id'];?>','<?php echo $value['id'];?>')" title="<?php echo P_Lang("查看日志");?>"></a>
	</td>
	<?php } ?>
	<td><?php echo date('Y-m-d H:i',$value['regtime']);?></td>
	<td>
		<div class="button-group">
			<input type="button" value="<?php echo P_Lang("编辑");?>" onclick="$.phpok.go('<?php echo phpok_url(array('ctrl'=>'user','func'=>'set','id'=>$value['id']));?>')" class="phpok-btn" />
			<?php if($config['biz_status']){ ?>
			<input type="button" value="<?php echo P_Lang("地址库");?>" onclick="$.admin_user.address(<?php echo $value['id'];?>)" class="phpok-btn" />
			<?php } ?>
			<input type="button" value="<?php echo P_Lang("删除");?>" onclick="del(<?php echo $value['id'];?>,'<?php echo $value['user'];?>')" class="phpok-btn" />
		</div>
	</td>
</tr>
<?php } ?>
</table>
</div>
<?php if($pagelist){ ?><div class="table"><?php $this->output("pagelist","file"); ?></div><?php } ?>
<?php $this->output("foot","file"); ?>