<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><script id="<?php echo $_rs['identifier'];?>" type="text/plain" style="<?php echo $_rs['form_style'];?>"><?php echo $_rs['content'];?></script>
<script type="text/javascript">
$(document).ready(function(){
	var toolbars_<?php echo $_rs['id'];?> = [[
		'removeformat','source', '|',
		'bold', 'italic', 'underline', 'strikethrough','|',
		'superscript', 'subscript','|',
		'justifyleft', 'justifycenter', 'justifyright', '|',
		'insertorderedlist', 'insertunorderedlist','forecolor',  '|',
		'indent', 'horizontal','blockquote','|',
		'link', 'unlink','|',
		<?php if($_rs['btns']['image']){ ?>'simpleupload','insertimage','|',<?php } ?>
		<?php if($_rs['btns']['video']){ ?>'insertvideo',<?php } ?>
		<?php if($_rs['btns']['file']){ ?>'attachment',<?php } ?>
		<?php if($_rs['btns']['spechars']){ ?>'spechars',<?php } ?>
		<?php if($_rs['btns']['emotion']){ ?>'emotion',<?php } ?>
		'insertpbefore','insertpafter','|',
		<?php if($_rs['btns']['fontfamily']){ ?>'fontfamily',<?php } ?>
		<?php if($_rs['btns']['fontsize']){ ?>'fontsize',<?php } ?>
		<?php if($_rs['btns']['paragraph']){ ?>'paragraph',<?php } ?>
		<?php if($_rs['btns']['insertcode']){ ?>'insertcode',<?php } ?>
		<?php if($_rs['btns']['table']){ ?>
		'inserttable','deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols','|',
		<?php } ?>
		'help'
	]];
	var edit_config_<?php echo $_rs['id'];?> = {
		 'UEDITOR_HOME_URL':webroot+'js/ueditor/'
		,'serverUrl':get_url('ueditor')
		,'toolbars':toolbars_<?php echo $_rs['id'];?>
	    ,'initialFrameWidth':'100%'
	    ,'allowDivTransToP': false
	    ,'initialFrameHeight':'<?php echo $_rs['height'];?>'
		,'sourceEditorFirst':false
		,'readonly':false
		,'pasteplain':true
		,'autoFloatEnabled':<?php echo $_rs['is_float'] ? 'true' : 'false';?>
		,'autoHeightEnabled':true
		,'imagePopup':false
		<?php if($_rs['btns']['page']){ ?>,'pageBreakTag':'[:page:]'<?php } ?>
		,'textarea':'<?php echo $_rs['identifier'];?>'
	};
	var edit_<?php echo $_rs['id'];?> = UE.getEditor('<?php echo $_rs['identifier'];?>',edit_config_<?php echo $_rs['id'];?>);
});
</script>
