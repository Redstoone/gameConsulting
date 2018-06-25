<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head_open","file"); ?>
<div class="list">
<table>
<tr>
	<td>附件名称：</td>
	<td><?php echo $rs['title'];?></td>
</tr>
<tr>
	<td>上传时间：</td>
	<td><?php echo date('Y-m-d H:i:s',$rs['addtime']);?></td>
</tr>
<tr>
	<td>存储目录：</td>
	<td><?php echo $rs['folder'];?></td>
</tr>
<tr>
	<td>文件名：</td>
	<td><?php echo $rs['name'];?></td>
</tr>
<tr>
	<td>下载次数：</td>
	<td><?php echo $rs['download'];?></td>
</tr>
</table>
</div>
<?php if($ispic){ ?>
<style type="text/css">
.img{max-width:100%}
</style>
<div style="margin-top:3px;"><img src="<?php echo $rs['filename'];?>" class="img"/></div>
<?php } else { ?>
<div class="list">
<table>
<tr>
	<td>&nbsp;</td>
	<td><input type="button" value="点这里下载" class="phpok-btn" onclick="window.open('<?php echo $rs['filename'];?>')" /></td>
</tr>
</table>
</div>
<?php } ?>

<?php $this->output("foot_open","file"); ?>