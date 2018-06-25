<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php if($pagelist){ ?>
<div class="pagelist">
	<ul>
		<?php $idx["num"] = 0;$pagelist=is_array($pagelist) ? $pagelist : array();$idx = array();$idx["total"] = count($pagelist);$idx["index"] = -1;foreach($pagelist as $key=>$value){ $idx["num"]++;$idx["index"]++; ?>
			<?php if($value['type'] != 'opt'){ ?>
			<li><a<?php if($value['url']){ ?> href="<?php echo $value['url'];?>"<?php } ?> <?php if($value['status']){ ?> class="current"<?php } ?>><?php echo $value['title'];?></a></li>
			<?php } ?>
			<?php if($value['type'] == 'opt'){ ?>
			<li>
				<select onchange="$.phpok.go('<?php echo $value['url'];?>'+this.value)">
					<?php $idxx["num"] = 0;$value['title']=is_array($value['title']) ? $value['title'] : array();$idxx = array();$idxx["total"] = count($value['title']);$idxx["index"] = -1;foreach($value['title'] as $k=>$v){ $idxx["num"]++;$idxx["index"]++; ?>
					<option value="<?php echo $v['value'];?>"<?php if($v['status']){ ?> selected<?php } ?>><?php echo $v['title'];?></option>
					<?php } ?>
				</select>
			</li>
			<?php } ?>
		<?php } ?>
		<li><input type="number" name="go_to_page" id="go_to_page" value="<?php echo G('pageid');?>" class="short" min="0" max="<?php echo $total_page;?>"  /></li>
		<li><input type="button" value="GO" onclick="go_to_page_action()" /></li>
	</ul>
</div>
<?php } ?>