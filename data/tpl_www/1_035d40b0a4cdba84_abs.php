<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php if($_laydate){ ?>
<input type="text" id="<?php echo $_rs['identifier'];?>" class="inp inp_<?php echo $_rs['identifier'];?>" name="<?php echo $_rs['identifier'];?>" style="<?php echo $_rs['form_style'];?>" value="<?php echo $_rs['content'];?>" />
<input type="button" value="<?php echo $_laydate_button;?>" id="btn_<?php echo $_rs['identifier'];?>_<?php echo $_rs['form_btn'];?>" onclick="$.phpokform.laydate_button('<?php echo $_rs['identifier'];?>','<?php echo $_rs['form_btn'];?>')" />
<input type="button" value="<?php echo P_Lang("清除");?>" onclick="$.phpokform.clear('<?php echo $_rs['identifier'];?>')" />
<?php } else { ?>
	<?php if($_rs['form_btn'] == 'color'){ ?>
		<input type="text" id="<?php echo $_rs['identifier'];?>" class="jscolor {required:false<?php if($_rs['ext_include_3']){ ?>,hash:true<?php } ?>}" name="<?php echo $_rs['identifier'];?>"<?php if($_rs['form_style']){ ?> style="<?php echo $_rs['form_style'];?>"<?php } ?> value="<?php echo $_rs['content'];?>" />
	<?php } else { ?>
		<input type="text" id="<?php echo $_rs['identifier'];?>" class="inp inp_<?php echo $_rs['identifier'];?>" name="<?php echo $_rs['identifier'];?>"<?php if($_rs['form_style']){ ?> style="<?php echo $_rs['form_style'];?>"<?php } ?> value="<?php echo $_rs['content'];?>" />
	<?php } ?>
<?php } ?>