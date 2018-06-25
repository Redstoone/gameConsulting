<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title","评论管理"); ?><?php $this->output("head","file"); ?>

<script type="text/javascript">
function subsearch()
{
	var url = get_url("reply");
	var status = $("#status").val();
	if(status>0)
	{
		url += "&status="+status;
	}
	var keywords = $("#keywords").val();
	if(keywords)
	{
		url += "&keywords="+$.str.encode(keywords);
	}
	direct(url);
}
function to_view(id,title)
{
	var url = get_url("reply","list","tid="+id);
	$.dialog.open(url,{
		'title':'<?php echo P_Lang("评论：");?>'+title,
		'lock':true,
		'width':'90%',
		'height':'90%',
		'cancel':function(){return true;}
	});
}
</script>
<div class="tips" id="tips">
	<table cellpadding="0" cellspacing="0" height="100%" width="100%">
	<tr>
		<td>您当前的位置：<a href="<?php echo admin_url('reply');?>" title="内容管理">评论管理</a></td>
		<td align="right">
			搜索：
			<select name="status" id="status">
				<option value="0">全部</option>
				<option value="1"<?php if($status == 1){ ?> selected<?php } ?>>已审核</option>
				<option value="2"<?php if($status && $status != 1){ ?> selected<?php } ?>>未审核</option>
			</select>
			<input type="text" name="keywords" id="keywords" value="<?php echo $keywords;?>" style="margin-top:3px;" />
			<input type="button" value="搜索" class="btn" onclick="subsearch();" />
		</td>
		<td>&nbsp;</td>
	</tr>
	</table>
</div>

<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id = array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist as $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
<div class="comment">
	<div class="content" id="tmp_<?php echo $value['id'];?>">
		<div class="id">#<?php echo $value['id'];?> </div>
		<?php if($value['list_id']){ ?>
		<div class="linksymbol"><b class="darkblue">主题：</b><a href="<?php echo $sys['www_file'];?>?id=<?php echo $value['list_id'];?>" target="_blank"><?php echo $value['l_title'];?></a></div>
		<?php } ?>
		<?php if($value['p_title']){ ?>
		<div class="linksymbol"><b class="darkblue">项目：</b><?php echo $value['p_title'];?></div>
		<?php } ?>
		<?php if($value['c_title']){ ?>
		<div class="linksymbol"><b class="darkblue">分类：</b><?php echo $value['c_title'];?></div>
		<?php } ?>
		<?php if($value['o_title']){ ?>
		<div class="linksymbol"><b class="darkblue">订单：</b><?php echo $value['o_title'];?></div>
		<?php } ?>
		<div class="info"><span class="darkblue">评论内容：</span><?php echo $value['content'];?></div>
		<?php if($value['adm_content']){ ?>
		<fieldset class="adm-reply">
			<legend>管理员回复时间：<?php echo date('Y-m-d',$value['adm_time']);?></legend>
			<?php echo $value['adm_content'];?>
		</fieldset>
		<?php } ?>
	</div>
	<table width="100%">
	<tr>
		<td>
			发布人：
			<?php if($value['uid'] && is_array($value['uid'])){ ?>
			<span class="darkblue b"><?php echo $value['uid']['user'];?></span>
			<?php } else { ?>
			游客
			<?php } ?>
			，IP：<?php echo $value['ip'];?>
			，发布时间：<?php echo date("Y-m-d H:i:s",$value['addtime']);?>
			，星级：<?php echo $value['star'];?>星
		</td>
		<td align="right">
			<div class="button-group">
				<?php if($value['sublist']){ ?>
				<input type="button" value="显示评论的回复" class="phpok-btn" id="show_hide_c_<?php echo $value['id'];?>" onclick="$.admin_reply.sublist(<?php echo $value['id'];?>)" />
				<?php } ?>
				<?php if($value['status']){ ?>
				<input type="button" value="已审核" onclick="$.admin_reply.status(<?php echo $value['id'];?>,0)" class="phpok-btn" />
				<?php } else { ?>
				<input type="button" value="未审核" class="phpok-btn" onclick="$.admin_reply.status(<?php echo $value['id'];?>,1)" style="color:red;" />
				<?php } ?>
				<input type="button" value="管理员回复" onclick="$.admin_reply.adm(<?php echo $value['id'];?>)" class="phpok-btn" />
				<input type="button" value="修改" onclick="$.admin_reply.edit(<?php echo $value['id'];?>)" class="phpok-btn" />
				<input type="button" value="删除" onclick="$.admin_reply.del(<?php echo $value['id'];?>)" class="phpok-btn" />
			</div>
		</td>
	</tr>
	</table>
</div>
<?php if($value['sublist']){ ?>
<fieldset class="sub_comment hide" id="comment_reply_<?php echo $value['id'];?>">
	<legend>针对该评论的回复</legend>
	<?php $value_sublist_id["num"] = 0;$value['sublist']=is_array($value['sublist']) ? $value['sublist'] : array();$value_sublist_id = array();$value_sublist_id["total"] = count($value['sublist']);$value_sublist_id["index"] = -1;foreach($value['sublist'] as $kk=>$vv){ $value_sublist_id["num"]++;$value_sublist_id["index"]++; ?>
		<div class="comment">
			<div class="content cate_<?php echo $value_sublist_id['index']%9;?>" id="tmp_<?php echo $vv['id'];?>">
				<span class="darkblue b">ID：<?php echo $vv['id'];?> 内容：</span><?php echo nl2br($vv['content']);?>
				<?php if($vv['adm_content']){ ?>
				<fieldset class="adm-reply">
					<legend>管理员回复时间：<?php echo date('Y-m-d',$vv['adm_time']);?></legend>
					<?php echo $vv['adm_content'];?>
				</fieldset>
				<?php } ?>
			</div>
			<table width="100%">
			<tr>
				<td>
					发布人：
					<?php if($vv['uid'] && is_array($vv['uid'])){ ?>
					<span class="darkblue b"><?php echo $vv['user'];?></span>
					<?php } else { ?>
					游客
					<?php } ?>
					，IP：<?php echo $vv['ip'];?>
					，发布时间：<?php echo date("Y-m-d H:i:s",$vv['addtime']);?>
					，星级：<?php echo $vv['star'];?>星
				</td>
				<td align="right">
					<div class="button-group">
						<?php if($popedom['status']){ ?>
							<?php if($vv['status']){ ?>
							<input type="button" value="已审核" onclick="to_status(<?php echo $vv['id'];?>,0)" class="phpok-btn" />
							<?php } else { ?>
							<input type="button" value="未审核" class="phpok-btn" onclick="to_status(<?php echo $vv['id'];?>,1)" style="color:red;" />
							<?php } ?>
						<?php } ?>
						<?php if($popedom['reply']){ ?>
						<input type="button" value="管理员回复" onclick="to_reply(<?php echo $vv['id'];?>)" class="phpok-btn" />
						<?php } ?>
						<?php if($popedom['modify']){ ?>
						<input type="button" value="修改" onclick="to_edit(<?php echo $vv['id'];?>)" class="phpok-btn" />
						<?php } ?>
						<?php if($popedom['delete']){ ?>
						<input type="button" value="删除" onclick="to_delete(<?php echo $vv['id'];?>)" class="phpok-btn" />
						<?php } ?>
					</div>
				</td>
			</tr>
			</table>
		</div>
	<?php } ?>
</fieldset>
<?php } ?>
<?php } ?>

<?php if($pagelist){ ?><div class="table"><?php $this->output("pagelist","file"); ?></div><?php } ?>

<?php $this->output("foot","file"); ?>