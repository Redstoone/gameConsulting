<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title","申请友情链接"); ?><?php $this->output("head","file"); ?>
<script type="text/javascript">
$(document).ready(function(){
	var is_vcode = '<?php if($sys['is_vcode'] && function_exists("imagecreate")){ ?>true<?php } else { ?>false<?php } ?>';
	$("#post_submit").submit(function(){
		if(!$("#title").val()){
			$.dialog.alert('<?php echo $page_rs['alias_title'] ? $page_rs['alias_title'] : "主题";?>不能为空');
			return false;
		}
		if(!$("#link").val()){
			$.dialog.alert('链接不能为空');
			return false;
		}
		if(is_vcode == 'true'){
			var chkcode = $("#_chkcode").val();
			if(!chkcode){
				$.dialog.alert('验证码不能为空',function(){
					$("#_vcode").phpok_vcode();
				});
				return false;
			}
		}
		
		$(this).ajaxSubmit({
			'url':api_url('post','save'),
			'type':'post',
			'dataType':'json',
			'success':function(rs){
				if(rs.status == 'ok'){
					$.dialog.alert('您的申请已经提交，我们工作人员会尽快审核',true,'succeed');
					return true;
				}
				$.dialog.alert(rs.content,function(){
					if(is_vcode == 'true'){
						$("#_vcode").phpok_vcode();
						$("#_chkcode").val('');
					}
				});
				return false;
			}
		});
		return false;
	});
});
</script>
<div class="main" style="margin:10px auto;">
	<div class="am-panel am-panel-default">
		<div class="am-panel-hd"><?php echo $page_rs['title'];?></div>
		<div class="am-panel-bd">
			<form method="post" id="post_submit" class="am-form">
			<input type="hidden" name="id" id="id" value="<?php echo $page_rs['identifier'];?>" />
			<?php if($cate_rs){ ?>
			<input type="hidden" name="cate_id" id="cate_id" value="<?php echo $cate_rs['id'];?>" />
			<?php } ?>
			<div class="am-g am-form-group">
				<label class="am-u-sm-2" for="title"><?php echo $page_rs['alias_title'] ? $page_rs['alias_title'] : '主题';?></label>
				<div class="am-u-sm-10"><input type="text" name="title" id="title" /></div>
			</div>
			<?php if($catelist && !$cate_rs){ ?>
			<div class="am-g am-form-group">
				<label class="am-u-sm-2" for="title">分类</label>
				<div class="am-u-sm-10">
					<select name="cate_id" id="cate_id">
						<option value="">请选择分类……</option>
						<?php $tmpid["num"] = 0;$catelist=is_array($catelist) ? $catelist : array();$tmpid = array();$tmpid["total"] = count($catelist);$tmpid["index"] = -1;foreach($catelist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<option value="<?php echo $value['id'];?>"<?php if($cate_rs['id'] == $value['id']){ ?> selected<?php } ?>><?php echo $value['_space'];?><?php echo $value['title'];?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<?php } ?>
			<?php $list=phpok('_fields',array('pid'=>$page_rs['id'],'fields_format'=>"1"));?>
			<?php $list_id["num"] = 0;$list=is_array($list) ? $list : array();$list_id = array();$list_id["total"] = count($list);$list_id["index"] = -1;foreach($list as $key=>$value){ $list_id["num"]++;$list_id["index"]++; ?>
			<div class="am-g am-form-group">
				<label class="am-u-sm-2" for="<?php echo $value['identifier'];?>"><?php echo $value['title'];?></label>
				<div class="am-u-sm-10"><?php echo $value['html'];?></div>
			</div>
			<?php } ?>
			<?php if($is_vcode){ ?>
			<div class="am-g am-form-group">
				<label class="am-u-sm-2" for="_chkcode">验证码：</label>
				<div class="am-u-sm-4"><input type="text" name="_chkcode" id="_chkcode" class="vcode" /></div>
				<div class="am-u-sm-6"><img src="" border="0" align="absmiddle" id="_vcode" class="hand"></div>
				<script type="text/javascript">
				$(document).ready(function(){
					$("#_vcode").phpok_vcode();
					//更新点击时操作
					$("#_vcode").click(function(){
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
</div>

<?php $this->output("foot","file"); ?>