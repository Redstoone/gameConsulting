<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title",$page_rs['title']); ?><?php $this->assign("menutitle",$page_rs['title']); ?><?php $this->output("head","file"); ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#book_post").submit(function(){
		//提交表单
		if(!$('#title').val()){
			$.dialog.alert("留言主题不能为空");
			return false;
		}
		if(!$('#fullname').val()){
			$.dialog.alert('留言人姓名不能为空');
			return false;
		}
		if(!$('#email').val()){
			$.dialog.alert('邮箱不能为空');
			return false;
		}
		var content = UE.getEditor('content').getContentTxt();
		if(!content){
			$.dialog.alert('留言内容不能为空');
			return false;
		}
		$(this).ajaxSubmit({
			'url':api_url('post','save'),
			'type':'post',
			'dataType':'json',
			'success':function(rs){
				if(rs.status == 'ok'){
					$.dialog.alert('您的留言信息已发布，请耐心等候管理员审核，感谢您的提交',function(){
						$.phpok.reload();
					},'succeed');
				}else{
					$.dialog.alert(rs.content,function(){
						$("#update_vcode").phpok_vcode();
						$("#_chkcode").val('');
					});
					return false;
				}
			}
		});
		return false;
	});
});
</script>
<div class="main">
	<?php if($page_rs['banner']){ ?>
	<div class="banner"><img src="<?php echo $page_rs['banner']['filename'];?>" width="980" alt="<?php echo $title;?>" /></div>
	<?php } ?>
	<?php $this->output("block/breadcrumb","file"); ?>
	<div class="left am-panel-group">
		<?php $this->output("block/contact","file"); ?>
		<?php $this->output("block/hot_products","file"); ?>
	</div>
	<div class="right am-panel-group">
		<div class="am-panel am-panel-default">
			<div class="am-panel-hd">发布新留言</div>
			<div class="am-panel-bd">
				<form method="post" id="book_post" class="am-form">
				<input type="hidden" name="id" id="id" value="<?php echo $page_rs['identifier'];?>" />
				<?php $list=phpok('_fields',array('pid'=>$page_rs['id'],'fields_format'=>"1",'in_title'=>"1"));?>
				<?php $list_id["num"] = 0;$list=is_array($list) ? $list : array();$list_id = array();$list_id["total"] = count($list);$list_id["index"] = -1;foreach($list as $key=>$value){ $list_id["num"]++;$list_id["index"]++; ?>
				<div class="am-g am-form-group">
					<label class="am-u-sm-2" for="<?php echo $value['identifier'];?>"><?php echo $value['title'];?></label>
					<div class="am-u-sm-10"><?php echo $value['html'];?></div>
				</div>
				<?php } ?>
				<?php if($sys['is_vcode'] && function_exists("imagecreate")){ ?>
				<div class="am-g am-form-group">
					<label class="am-u-sm-2" for="_chkcode">验证码</label>
					<div class="am-u-sm-4"><input type="text" name="_chkcode" id="_chkcode" class="vcode" /></div>
					<div class="am-u-sm-6"><img src="" border="0" align="absmiddle" id="update_vcode" class="hand"></div>
					<script type="text/javascript">
					$(document).ready(function(){
						$("#update_vcode").phpok_vcode();
						//更新点击时操作
						$("#update_vcode").click(function(){
							$(this).phpok_vcode();
						});
					});
					</script>
				</div>
				<?php } ?>
				<div class="am-g am-form-group">
					<div class="am-u-sm-2">&nbsp;</div>
					<div class="am-u-sm-10"><input type="submit" value=" 提交 " class="am-btn am-btn-primary" /></div>
				</div>
				
				</form>
			</div>
		</div>

		<?php $tmpid["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$tmpid = array();$tmpid["total"] = count($rslist);$tmpid["index"] = -1;foreach($rslist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
		<div class="am-panel am-panel-default">
			<div class="am-panel-hd"><?php echo $value['title'];?><small class="am-fr gray">发布时间：<?php echo time_format($value['dateline']);?></small></div>
			<div class="am-panel-bd">
				<div class="content">
					<?php echo $value['content'];?>
					<?php if($value['pic']){ ?>
					<ul data-am-widget="gallery" class="am-gallery am-avg-sm-2 am-avg-md-3 am-avg-lg-4 am-gallery-bordered" data-am-gallery="{  }">
						<?php $idxx["num"] = 0;$value['pic']=is_array($value['pic']) ? $value['pic'] : array();$idxx = array();$idxx["total"] = count($value['pic']);$idxx["index"] = -1;foreach($value['pic'] as $k=>$v){ $idxx["num"]++;$idxx["index"]++; ?>
						<li><div class="am-gallery-item"><a href="<?php echo $v['gd']['auto'];?>" target="_blank"><img src="<?php echo $v['gd']['thumb'];?>" /></a></div></li>
						<?php } ?>
					</ul>
					<?php } ?>
				</div>
				<?php if($value['adm_reply']){ ?>
				<div class="adm_reply"><div class="adminer">管理员回复：</div><?php echo $value['adm_reply'];?></div>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
		<?php $this->output("block/pagelist","file"); ?>
	</div>
</div>
<?php $this->output("foot","file"); ?>