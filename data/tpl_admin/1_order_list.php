<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript" src="<?php echo add_js('order.js');?>"></script>
<script type="text/javascript" src="js/laydate/laydate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	top.$.desktop.title('<?php echo P_Lang("订单管理");?>');
});
</script>
<div class="tips">
	<table width="100%" cellpadding="0" cellspacing="0" height="100%">
	<tr>
		<td>&raquo; <a href="<?php echo phpok_url(array('ctrl'=>'order'));?>" title=""><?php echo P_Lang("订单列表");?></a></td>
		<td>
		</td>
		<td align="right">
			<div class="action"><a href="<?php echo phpok_url(array('ctrl'=>'order','func'=>'set'));?>"><?php echo P_Lang("创建新订单");?></a></div>
		</div>
	</tr>
	</table>
</div>
<div class="tips">
	<form method="post" action="<?php echo admin_url('order');?>">
	<div style="float:left;width:800px;">
		<div><table>
		<tr>
			
			<td>
				<select name="status">
				<option value=""><?php echo P_Lang("订单状态…");?></option>
				<?php $tmpid["num"] = 0;$statuslist=is_array($statuslist) ? $statuslist : array();$tmpid = array();$tmpid["total"] = count($statuslist);$tmpid["index"] = -1;foreach($statuslist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
				<option value="<?php echo $key;?>"<?php if($key == $status){ ?> selected<?php } ?>><?php echo $value;?></option>
				<?php } ?>
				</select>
			</td>
			
			<td>&nbsp; &nbsp;<?php echo P_Lang("时间：");?></td>
			<td><input type="text" name="date_start" value="<?php echo $date_start;?>" placeholder="<?php echo P_Lang("开始时间");?>" onfocus="laydate()" style="width:110px;" /></td>
			<td><?php echo P_Lang("至");?></td>
			<td><input type="text" name="date_stop" value="<?php echo $date_stop;?>" placeholder="<?php echo P_Lang("结束时间");?>" onfocus="laydate()" style="width:110px;" /></td>
			<td>&nbsp; &nbsp;<?php echo P_Lang("价格：");?></td>
			<td><input type="text" name="price_min" value="<?php echo $price_min;?>" placeholder="<?php echo P_Lang("最低价格");?>" style="width:110px;" /></td>
			<td><?php echo P_Lang("至");?></td>
			<td><input type="text" name="price_max" value="<?php echo $price_max;?>" placeholder="<?php echo P_Lang("最高价格");?>" style="width:110px;" /></td>
			
			
		</tr>
		</table></div>
		<table>
		<tr>
			<?php if($paylist){ ?>
			<td>
				<select name="paytype" >
				<option value=""><?php echo P_Lang("支付方式…");?></option>
				<optgroup label="PC端">
					<?php $tmpid["num"] = 0;$paylist=is_array($paylist) ? $paylist : array();$tmpid = array();$tmpid["total"] = count($paylist);$tmpid["index"] = -1;foreach($paylist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
					<?php if(!$value['wap']){ ?>
					<option value="<?php echo $value['id'];?>"<?php if($paytype == $value['id']){ ?> selected<?php } ?>><?php echo $value['title'];?></option>
					<?php } ?>
					<?php } ?>
				</optgroup>
				<optgroup label="手机端">
					<?php $tmpid["num"] = 0;$paylist=is_array($paylist) ? $paylist : array();$tmpid = array();$tmpid["total"] = count($paylist);$tmpid["index"] = -1;foreach($paylist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
					<?php if($value['wap']){ ?>
					<option value="<?php echo $value['id'];?>"<?php if($paytype == $value['id']){ ?> selected<?php } ?>><?php echo $value['title'];?></option>
					<?php } ?>
					<?php } ?>
				</optgroup>
				</select>
			</td>
			<?php } ?>
			<td>
				<select name="keytype" onchange="update_keywords(this.value)">
				<option value=""><?php echo P_Lang("检索类型…");?></option>
				<option value="sn"<?php if($keytype == 'sn'){ ?> selected<?php } ?>><?php echo P_Lang("订单编号");?></option>
				<option value="user"<?php if($keytype == 'user'){ ?> selected<?php } ?>><?php echo P_Lang("会员账号");?></option>
				<option value="email"<?php if($keytype == 'email'){ ?> selected<?php } ?>><?php echo P_Lang("订单邮箱");?></option>
				<option value="protitle"<?php if($keytype == 'protitle'){ ?> selected<?php } ?>><?php echo P_Lang("产品名称");?></option>
				</select>
			</td>
			<td><input type="text" id="keywords" name="keywords" class="default" value="<?php echo $keywords;?>"<?php if($keytype == 'time'){ ?> onfocus="laydate()"<?php } ?> /></td>
		</tr>
		</table>
	</div>
	<div style="float:left;width:20%;margin-top:25px;"><input type="submit" value="<?php echo P_Lang("搜索");?>" class="submit2" /></div>
	</form>
	<div class="clear"></div>
</div>

<table width="100%" class="list" cellpadding="0" cellspacing="0">
<tr>
	<th width="70px">ID</th>
	<th class="lft">&nbsp;订单号</th>
	<th class="lft">&nbsp;会员</th>
	<th class="lft">&nbsp;金额</th>
	<th class="lft">&nbsp;已付</th>
	<th class="lft">&nbsp;未付</th>
	<th>状态</th>
	<th class="lft">&nbsp;支付方式</th>
	<th width="170px">下单时间</th>
	<th class="lft">操作</th>
</tr>
<?php $tmpid["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$tmpid = array();$tmpid["total"] = count($rslist);$tmpid["index"] = -1;foreach($rslist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>

<tr>
	<td align="center" data-id="<?php echo $value['id'];?>" data-unpaid="<?php echo $value['unpaid'];?>"><?php echo $value['id'];?></td>
	<td><?php echo $value['sn'];?></td>
	<td><?php if($value['user']){ ?><?php echo $value['user'];?><?php } else { ?><span class="red"><?php echo P_Lang("访客");?></span><?php } ?></td>
	<td><?php echo price_format($value['price'],$value['currency_id'],$value['currency_id']);?></td>
	<td><?php echo price_format($value['paid'],$value['currency_id'],$value['currency_id']);?></td>
	<td<?php if($value['unpaid']){ ?> class="red"<?php } ?> data-unpaid-text="<?php echo $value['id'];?>"><?php echo price_format($value['unpaid'],$value['currency_id'],$value['currency_id']);?></td>
	<td align="center" class="status"><?php echo $value['status_title'];?></td>
	<td><?php if($value['pay_title']){ ?><?php echo $value['pay_title'];?><?php } else { ?><span class="gray"><?php echo P_Lang("未设置");?></span><?php } ?></td>
	<td align="center"><?php echo time_format($value['addtime']);?></td>
	<td>
		<div class="button-group">
			<input type="button" value="<?php echo P_Lang("查看");?>" onclick="order_info_show('<?php echo $value['id'];?>','<?php echo $value['sn'];?>')" class="phpok-btn" />
			<?php if($value['status'] != 'end' && $value['status'] != 'cancel' && $value['status'] != 'stop'){ ?>
				<?php if($popedom['modify']){ ?>
				<input type="button" value="<?php echo P_Lang("编辑");?>" onclick="order_edit(<?php echo $value['id'];?>)" class="phpok-btn" />
				<input type="button" value="<?php echo P_Lang("付款");?>" onclick="order_payment(<?php echo $value['id'];?>,'<?php echo $value['sn'];?>')" class="phpok-btn" />
				<input type="button" value="<?php echo P_Lang("物流");?>" onclick="order_express(<?php echo $value['id'];?>,'<?php echo $value['sn'];?>')" class="phpok-btn" />
				<?php } ?>
				<?php if($value['status'] != 'cancel' && $popedom['cancel']){ ?>
				<input type="button" value="<?php echo P_Lang("取消");?>" onclick="order_cancel(<?php echo $value['id'];?>,'<?php echo $value['sn'];?>')" class="phpok-btn" />
				<?php } ?>
				<?php if($value['status'] != 'stop' && $popedom['stop']){ ?>
				<input type="button" value="<?php echo P_Lang("结束");?>" onclick="order_stop(<?php echo $value['id'];?>,'<?php echo $value['sn'];?>')" class="phpok-btn" />
				<?php } ?>
				<?php if($value['status'] != 'end' && $popedom['end']){ ?>
				<input type="button" value="<?php echo P_Lang("完成");?>" onclick="order_end(<?php echo $value['id'];?>,'<?php echo $value['sn'];?>')" class="phpok-btn" />
				<?php } ?>
			<?php } ?>
			<?php if($popedom['delete']){ ?>
			<input type="button" value="<?php echo P_Lang("删除");?>" onclick="order_delete(<?php echo $value['id'];?>,'<?php echo $value['sn'];?>')" class="phpok-btn" />
			<?php } ?>
		</div>
	</td>
</tr>
<?php } ?>
</table>
<?php $this->output("pagelist","file"); ?>
<?php $this->output("foot","file"); ?>