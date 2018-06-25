<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $title= $cate_rs ? $cate_rs['title'].' - '.$page_rs['title'] : $page_rs['title'];?>
<?php $this->assign("title",$title); ?><?php $this->assign("menutitle",$page_rs['title']); ?><?php $this->output("head","file"); ?>
<div class="main">
	<?php if($page_rs['banner']){ ?>
	<div class="banner"><img src="<?php echo $page_rs['banner']['filename'];?>" alt="<?php echo $title;?>" /></div>
	<?php } ?>
	<?php $this->output("block/breadcrumb","file"); ?>
	<div class="left am-panel-group">
		<?php $this->assign("cid",$cate_rs['id']); ?><?php $this->assign("pid",$page_rs['id']); ?><?php $this->assign("title",$page_rs['title']); ?><?php $this->output("block/catelist","file"); ?>
	</div>
	<div class="right">
		<div data-am-widget="list_news" class="am-list-news am-list-news-default news-cont block-box" style="margin:0; padding: 0 15px 0 15px;">
			<div class="am-list-news-hd am-cf">
				<h2><?php echo $cate_rs ? $cate_rs['title'] : $page_rs['title'];?></h2>
			</div>
			<div class="am-list-news-bd">
				<ul class="am-list">
					<?php $tmpid["num"] = 0;$rslist=is_array($rslist) ? $rslist : array();$tmpid = array();$tmpid["total"] = count($rslist);$tmpid["index"] = -1;foreach($rslist as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
					<?php if($value['thumb']){ ?>
					<li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
						<div class="am-u-sm-2 am-list-thumb">
							<a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><img src="<?php echo $value['thumb']['ico'];?>" alt="<?php echo $value['title'];?>" /></a>
						</div>
						<div class=" am-u-sm-10 am-list-main">
							<h3 class="am-list-item-hd"><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a></h3>
							<span class="am-list-date">发布时间：<?php echo time_format($value['dateline']);?>，查看次数：<?php echo $value['hits'];?></span>
							<div class="am-list-item-text" style="max-height:6.5em;"><?php echo $value['note'] ? phpok_cut($value['note'],300,'…') : phpok_cut($value['content'],300,'…');?></div>
						</div>
					</li>
					<?php } else { ?>
					<li class="am-g am-list-item-desced">
						<div class=" am-list-main">
							<h3 class="am-list-item-hd"><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a></h3>
							<span class="am-list-date">发布时间：<?php echo time_format($value['dateline']);?>，查看次数：<?php echo $value['hits'];?></span>
							<div class="am-list-item-text"><?php echo $value['note'] ? phpok_cut($value['note'],225,'…') : phpok_cut($value['content'],225,'…');?></div>
						</div>
					</li>
					<?php } ?>
					<?php } ?>
				</ul>
			</div>
			<?php $this->output("block/pagelist","file"); ?>
		</div>
	</div>
</div>

<?php $this->output("foot","file"); ?>