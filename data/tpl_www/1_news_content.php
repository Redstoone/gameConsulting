<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $title = $rs['title'].' - '.$cate_rs['title'].' - '.$page_rs['title'];?>
<?php $this->assign("title",$title); ?><?php $this->assign("menutitle",$page_rs['title']); ?><?php $this->output("head","file"); ?>
<div class="main">
	<?php if($page_rs['banner']){ ?>
	<div class="banner"><img src="<?php echo $page_rs['banner']['filename'];?>" width="980" alt="<?php echo $title;?>" /></div>
	<?php } ?>
	<?php $this->output("block/breadcrumb","file"); ?>
	<div class="left am-panel-group">
		<?php $this->assign("pid",$page_rs['id']); ?><?php $this->assign("cid",$cate_rs['id']); ?><?php $this->assign("title",$page_rs['title']); ?><?php $this->output("block/catelist","file"); ?>
	</div>
	<div class="right">
		<article class="am-article news-cont block-box" style="margin:0; padding: 0 15px 0 15px;">
			<div class="am-article-hd">
				<h1 class="am-article-title"><?php echo $rs['title'];?></h1>
				<p class="am-article-meta">
					发布日期：<span><?php echo time_format($rs['dateline']);?></span>&nbsp; &nbsp;
					浏览次数：<span id="lblVisits"><?php echo $rs['hits'];?></span>
					<?php if($rs['tag']){ ?>
					&nbsp; &nbsp; 关键字：
						<?php $rs_tag_id["num"] = 0;$rs['tag']=is_array($rs['tag']) ? $rs['tag'] : array();$rs_tag_id = array();$rs_tag_id["total"] = count($rs['tag']);$rs_tag_id["index"] = -1;foreach($rs['tag'] as $key=>$value){ $rs_tag_id["num"]++;$rs_tag_id["index"]++; ?>
						<a href="<?php echo $value['url'];?>" title="<?php echo $value['alt'];?>" target="<?php echo $value['target'];?>" style="color:#999;"><?php echo $value['title'];?></a>
						<?php } ?>
					<?php } ?>
				</p>
			</div>
			<div class="am-article-bd">
				<?php if($rs['note']){ ?><p class="am-article-lead"><?php echo nl2br($rs['note']);?></p><?php } ?>
				<div class="content"><?php echo $rs['content'];?></div>
				<?php if($session['user_id']){ ?>
				<div style="padding:10px;" class="am-text-center">
					<input type="button" value="<?php if(fav_check($rs['id'])){ ?>加入收藏<?php } else { ?>已收藏<?php } ?>" class="am-btn am-btn-primary" onclick="fav_add('<?php echo $rs['id'];?>',this)" />
				</div>
				<?php } ?>
			</div>
		</article>
		<?php $this->output("block/next_prev","file"); ?>
		<?php if($page_rs['comment_status']){ ?>
			<?php $this->assign("tid",$rs['id']); ?><?php $this->output("block/comment","file"); ?>
		<?php } ?>
	</div>
</div>
<?php $this->output("foot","file"); ?>