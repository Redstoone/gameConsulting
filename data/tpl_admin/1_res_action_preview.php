<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head_open","file"); ?>
<script type="text/javascript" src="js/clipboard.min.js"></script>
<div class="res_preview">
	<ul>
		<li><i>上传时间：</i><?php echo time_format($rs['addtime']);?></li>
		<li><i>附件名称：</i><?php echo $rs['title'];?></li>
		<li><i>存储目录：</i><?php echo $rs['folder'];?></li>
		<li><i>文件名：</i><?php echo $rs['name'];?></li>
		<?php if($rs['attr'] && $rs['attr']['width'] && $rs['attr']['height']){ ?>
		<li><i>宽高</i><?php echo $rs['attr']['width'];?> * <?php echo $rs['attr']['height'];?></li>
		<?php } ?>
		<li><i>操作</i><input type="button" value="下载此文件" onclick="$.phpok.go('<?php echo phpok_url(array('ctrl'=>'res','func'=>'download','id'=>$rs['id']));?>')" class="phpok-btn" /></li>
		<?php if($type == "picture"){ ?>
		<li>
			<i><?php echo P_Lang("原图");?></i>
			<div class="button-group">
				<input type="button" value="<?php echo P_Lang("复制相对地址");?>" data-clipboard-text="<?php echo $rs['filename'];?>" class="phpok-btn phpok-copy" />
				<input type="button" value="<?php echo P_Lang("复制完整地址");?>" data-clipboard-text="<?php echo $sys['url'];?><?php echo $rs['filename'];?>" class="phpok-btn phpok-copy" />
			</div>
		</li>
		<li class="picture"><img src="<?php echo $rs['filename'];?>"/></li>
		<?php $rs_gd_id["num"] = 0;$rs['gd']=is_array($rs['gd']) ? $rs['gd'] : array();$rs_gd_id = array();$rs_gd_id["total"] = count($rs['gd']);$rs_gd_id["index"] = -1;foreach($rs['gd'] as $key=>$value){ $rs_gd_id["num"]++;$rs_gd_id["index"]++; ?>
		<li>
			<i><?php echo P_Lang("生成图");?> <span class="red"><?php echo $key;?></span></i>
			<div class="button-group">
				<input type="button" value="<?php echo P_Lang("复制相对地址");?>" data-clipboard-text="<?php echo $value['filename'];?>" class="phpok-btn phpok-copy" />
				<input type="button" value="<?php echo P_Lang("复制完整地址");?>" data-clipboard-text="<?php echo $sys['url'];?><?php echo $value['filename'];?>" class="phpok-btn phpok-copy" />
			</div>

		</li>
		<li class="picture"><img src="<?php echo $value['filename'];?>"/></li>
		<?php } ?>
		<?php }elseif($type == "video"){ ?>
		<li class="video"><video src="<?php echo $rs['filename'];?>" controls="controls" style="width:100%;height:300px;">您的浏览器不支持 video 标签。</video></li>
		<?php } ?>
	</ul>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var clipboard = new Clipboard('.phpok-copy');

	clipboard.on('success', function(e) {
		$.dialog.tips('<?php echo P_Lang("网址复制成功");?>');
		e.clearSelection();
	});

	clipboard.on('error', function(e) {
		$.dialog.alert('<?php echo P_Lang("网址复制失败");?>');
	});
});
</script>
<?php $this->output("foot_open","file"); ?>