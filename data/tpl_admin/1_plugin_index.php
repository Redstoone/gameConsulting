<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->output("head","file"); ?>
<script type="text/javascript" src="<?php echo add_js('plugin.js');?>"></script>
<script type="text/javascript">
function create_plugin()
{
	$.dialog({
		'title':'<?php echo P_Lang("创建一个新的插件");?>',
		'width':'400px',
		'height':'220px',
		'lock':true,
		'content':document.getElementById('create_plugin_html'),
		'ok':function(){
			var url = get_url('plugin','create');
			var title = $("#plugin_name").val();
			if(!title){
				$.dialog.alert('插件名称不能为空');
				return false;
			}
			url += "&title="+$.str.encode(title);
			var id = $("#plugin_id").val();
			if(id){
				url += "&id="+$.str.encode(id);
			}
			var note = $("#plugin_note").val();
			if(note){
				url += "&note="+$.str.encode(note);
			}
			var author = $("#plugin_author").val();
			if(author){
				url += "&author="+$.str.encode(author);
			}
			var rs = $.phpok.json(url);
			if(rs.status == 'ok'){
				$.dialog.alert('插件创建成功，请根据实际情况编写插件扩展',function(){
					$.phpok.reload();
				},'succeed');
			}else{
				$.dialog.alert(rs.content);
				return false;
			}
		},
		'cancel':function(){
			return true
		}
	});
}
function upload_plugin()
{
	$.dialog({
		'title':'上传插件',
		'content':document.getElementById('upload_plugin_html'),
		'width':'500px',
		'height':'100px',
		'lock':true
	})
}
function plugin_zip(id)
{
	var url = get_url('plugin','zip','id='+id);
	$.phpok.go(url);
}
</script>
<div id="create_plugin_html" style="display:none">
	<div class="table">
		<div class="title">
			<?php echo P_Lang("插件名称");?>
			<span class="note"><?php echo P_Lang("设置插件的名称");?></span>
		</div>
		<div class="content"><input type="text" id="plugin_name" class="default" /></div>
	</div>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("插件标识");?>
			<span class="note"><?php echo P_Lang("限英文字母和数字，为空由系统生成32位长度字串");?></span>
		</div>
		<div class="content"><input type="text" id="plugin_id" class="default" /></div>
	</div>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("插件功能");?>
			<span class="note"><?php echo P_Lang("简单一句话描述这个插件做什么");?></span>
		</div>
		<div class="content"><input type="text" id="plugin_note" class="default" /></div>
	</div>
	<div class="table">
		<div class="title">
			<?php echo P_Lang("开发者");?>
			<span class="note"><?php echo P_Lang("设置这个插件的开发人员或团队");?></span>
		</div>
		<div class="content"><input type="text" id="plugin_author" class="default" /></div>
	</div>
</div>
<div class="tips">
	<?php echo P_Lang("您当前的位置：");?><a href="<?php echo phpok_url(array('ctrl'=>'plugin'));?>"><?php echo P_Lang("插件列表");?></a>
	&raquo; <?php echo P_Lang("已安装的插件");?>
	<?php if($popedom['install']){ ?><div class="action"><a href="javascript:upload_plugin();void(0);"><?php echo P_Lang("本地上传插件");?></a></div><?php } ?>
	<div class="action"><a href="javascript:create_plugin();void(0);"><?php echo P_Lang("创建插件");?></a></div>
</div>
<div class="list">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<th width="20px">&nbsp;</th>
	<th><?php echo P_Lang("名称");?></th>
	<th width="40px"><?php echo P_Lang("排序");?></th>
	<th>&nbsp;</th>
</tr>
<?php $rslist_id["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$rslist_id = array();$rslist_id["total"] = count($rslist);$rslist_id["index"] = -1;foreach($rslist as $key=>$value){ $rslist_id["num"]++;$rslist_id["index"]++; ?>
<tr<?php if($rslist_id['num']%2 == ""){ ?> class="list"<?php } ?>>
	<td class="center">
		<div class="status<?php echo $value['status'];?>" id="status_<?php echo $key;?>" <?php if($popedom['status']){ ?>onclick="phpok_status('<?php echo $key;?>','<?php echo admin_url('plugin','status');?>')"<?php } else { ?> style="cursor: default;"<?php } ?> value="<?php echo $value['status'];?>"></div>
	</td>
	<td><?php echo $value['title'];?> <?php if($value['note']){ ?><span class="gray i">（<?php echo $value['note'];?>）</span><?php } ?></td>
	<td class="center pointer" onclick="$.admin_plugin.taxis('<?php echo $value['id'];?>','<?php echo $value['taxis'];?>')"><?php echo $value['taxis'];?></td>
	<td align="right">
		<div class="button-group">
			<?php if($popedom['config']){ ?>
				<?php if($value['extconfig']){ ?><input type="button" value="<?php echo P_Lang("配置");?>" class="phpok-btn" onclick="$.admin_plugin.config('<?php echo $key;?>','<?php echo $value['title'];?>')" /><?php } ?>
				<input type="button" value="<?php echo P_Lang("管理");?>" class="phpok-btn" onclick="$.admin_plugin.setting('<?php echo $key;?>')" />
				<input type="button" value="<?php echo P_Lang("导出");?>" class="phpok-btn" onclick="plugin_zip('<?php echo $key;?>')" />
			<?php } ?>
			<?php if($popedom['uninstall']){ ?>
			<input type="button" value="<?php echo P_Lang("卸载");?>" class="phpok-btn" onclick="plugin_uninstall('<?php echo $key;?>','<?php echo $value['title'];?>')" />
			<?php } ?>
		</div>
	</td>
</tr>
<?php } ?>
</table>
</div>
<?php if($popedom['install']){ ?>
<div id="upload_plugin_html" style="display:none;">
	<div style="width:450px;height:80px;">
		<div id="zipfile_picker"></div>
		<div class="_progress" id="zipfile_progress"></div>
	</div>
</div>
<input type="hidden" name="zipfile" id="zipfile" value="" />
<div class="tips"><?php echo P_Lang("未安装插件");?></div>
<script type="text/javascript">
var obj_zipfile;
$(document).ready(function(){
	obj_zipfile = new $.admin_upload({
		'id':'zipfile',
		'swf':'js/webuploader/uploader.swf',
		'server':'<?php echo phpok_url(array('ctrl'=>'upload','func'=>'zip'));?>',
		'pick':{'id':'#zipfile_picker','multiple':false,'innerHTML':'<?php echo P_Lang("选择本地文件");?>'},
		'resize':false,
		'multiple':"false",
		"formData":{'<?php echo session_name();?>':'<?php echo session_id();?>'},
		'fileVal':'upfile',
		'disableGlobalDnd':true,
		'compress':false,
		'auto':true,
		'sendAsBinary':true,
		'accept':{'title':'压缩包(*.zip)','extensions':'zip'},
		'fileSingleSizeLimit':'204800000',
		'success':function(file,data){
			//执行在线解压
			var url = get_url('plugin','unzip','filename='+$.str.encode(data.content));
			$.dialog.tips("正在解压插件，请稍候…",2);
			var rs = $.phpok.json(url,function(rs){
				if(rs.status == 'ok'){
					$.dialog.alert('插件导入成功，请执行安装',function(){
						$.phpok.reload();
					},'succeed');
				}else{
					$.dialog.alert(rs.content);
					return false;
				}
			});
		}
	});
});
</script>
<div class="list">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<th class="lft"><?php echo P_Lang("名称");?></th>
	<th class="lft"><?php echo P_Lang("标识");?></th>
	<th width="80px"></th>
</tr>
<?php $not_install_id["num"] = 0;$not_install=is_array($not_install) ? $not_install : array();$not_install_id = array();$not_install_id["total"] = count($not_install);$not_install_id["index"] = -1;foreach($not_install as $key=>$value){ $not_install_id["num"]++;$not_install_id["index"]++; ?>
<tr<?php if($not_install_id['num']%2 == ""){ ?> class="list"<?php } ?>>
	<td><?php echo $value['title'];?> <?php if($value['note'] || $value['desc']){ ?><span class="gray i">（<?php echo $value['note'] ? $value['note'] : $value['desc'];?>）</span><?php } ?></td>
	<td><?php echo $key;?></td>
	<td align="right"><input type="button" value="<?php echo P_Lang("安装");?>" class="phpok-btn" onclick="plugin_install('<?php echo $key;?>','<?php echo $value['title'];?>')" /></td>
</tr>
<?php } ?>
</table>
</div>
<?php } ?>
<?php $this->output("foot","file"); ?>
