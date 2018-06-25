<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $title = $rs['title'].' - '.$page_rs['title'];?>
<?php $this->assign("title",$title); ?><?php $this->assign("menutitle",$page_rs['title']); ?><?php $this->output("head","file"); ?>
<div class="main">
	<?php if($page_rs['banner']){ ?>
	<div class="banner"><img src="<?php echo $page_rs['banner']['filename'];?>" /></div>
	<?php } ?>
	<?php $this->output("block/breadcrumb","file"); ?>
	<div class="left am-panel-group">
		<div class="am-panel am-panel-default">
			<div class="am-panel-hd">
				<h3 class="am-panel-title"><?php echo $page_rs['title'];?></h3>
			</div>
			<ul class="am-list">
				<?php $list=phpok('_arclist',array('pid'=>$page_rs['id'],'psize'=>"100",'fields'=>"id"));?>
				<?php $tmpid["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$tmpid = array();$tmpid["total"] = count($list['rslist']);$tmpid["index"] = -1;foreach($list['rslist'] as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
				<li><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"<?php if($rs['id'] == $value['id']){ ?> class="am-active"<?php } ?>><i class='am-icon-angle-right'></i> <?php echo $value['title'];?></a></li>
				<?php } ?>
			</ul>
		</div>
		<?php $this->output("block/contact","file"); ?>
	</div>
	<div class="right">
		<div class="content"><?php echo $rs['content'];?></div>
	</div>
</div>
<?php $this->output("foot","file"); ?>