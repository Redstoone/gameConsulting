<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("highlight","1"); ?><?php $this->output("head","file"); ?>

<section class="main">
	
	<div class="am-panel am-panel-default mt10" style="padding: 0 15px;margin-top: 20px !important;">
		<div class="am-panel-bd gtype g-hot">
			<span>爆款</span>
			<?php $list = phpok('gtype_hot');?>
			<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id = array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] as $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
				<a href="<?php echo $value['link'];?>" target="<?php echo $value['target'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a>
			<?php } ?>
		</div>
		<div class="am-panel-bd gtype g-new">
			<span>最新</span>
			<?php $list = phpok('gtype_new');?>
			<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id = array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] as $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
				<a href="<?php echo $value['link'];?>" target="<?php echo $value['target'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a>
			<?php } ?>
		</div>
		<div class="am-panel-bd gtype g-classic">
			<span>经典</span>
			<?php $list = phpok('gtype_classic');?>
			<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id = array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] as $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
				<a href="<?php echo $value['link'];?>" target="<?php echo $value['target'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a>
			<?php } ?>
		</div>
	</div>

	<div class="am-g am-g-collapse" style="margin-top:10px;">
		<div class="am-u-lg-5">
			<?php $list = phpok('picplayer');?>
			<?php if($list['total']){ ?>
			<div class="banner">
				<div class="bd">
					<ul>
						<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id = array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] as $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
						<li><a href="<?php echo $value['link'];?>" target="<?php echo $value['target'];?>" title="<?php echo $value['title'];?>"><img src="images/blank.gif" _src="<?php echo $value['pic']['filename'];?>" alt="<?php echo $value['title'];?>" /></a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="hd">
					<ul>
						<?php $tmpid["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$tmpid = array();$tmpid["total"] = count($list['rslist']);$tmpid["index"] = -1;foreach($list['rslist'] as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<li><?php echo $tmpid['num'];?></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<script type="text/javascript">
			$(document).ready(function(){
				$(".banner").slide({'autoPlay':true,'switchLoad':'_src','mainCell':'.bd ul'});
			});
			</script>
			<?php } ?>
		</div>
		<div class="am-u-lg-7 " style="padding-left:2em;margin-top:10px;">
			<div class="am-panel am-panel-default block-box" style="padding: 0 15px;">
				<div class="am-panel-hd">
					<h3 class="am-panel-title">行业资讯<a href="<?php echo $list['project']['url'];?>" class="more">更多 <span class="am-icon-angle-right"></span><span class="am-icon-angle-right"></span></a></h3>
				</div>
				<?php $list = phpok('dzixun','fields=id','psize=10');?>
				<div class="am-panel-bd">
					<ul class="am-list arclist">
						<?php $tmpid["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$tmpid = array();$tmpid["total"] = count($list['rslist']);$tmpid["index"] = -1;foreach($list['rslist'] as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<li class="am-g am-list-item-dated">
							<a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>" class="am-list-item-hd "><?php echo $value['title'];?></a><span class="am-list-date"><?php echo date('Y-m-d',$value['dateline']);?></span>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="am-g am-g-collapse block-box" style="margin-top:10px;">
		<div class="am-u-lg-4" >
			<div class="am-panel am-panel-default" style="padding: 0 15px;">
				<div class="am-panel-hd">
					<h3 class="am-panel-title">人物专访<a href="<?php echo $list['project']['url'];?>" class="more">更多 <span class="am-icon-angle-right"></span><span class="am-icon-angle-right"></span></a></h3>
				</div>
				<?php $list = phpok('drenwu','fields=id','psize=4');?>
				<div class="am-panel-bd">
					<ul class="am-list arclist">
						<?php $tmpid["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$tmpid = array();$tmpid["total"] = count($list['rslist']);$tmpid["index"] = -1;foreach($list['rslist'] as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<li class="am-g am-list-item-dated">
							<a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>" class="am-list-item-hd ">
								<?php echo $value['title'];?>
							</a><span class="am-list-date">
								<?php echo date('Y-m-d',$value['dateline']);?></span>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>

			<div class="am-panel am-panel-default" style="padding: 0 15px;">
				<div class="am-panel-hd">
					<h3 class="am-panel-title">历史文化<a href="<?php echo $list['project']['url'];?>" class="more">更多 <span class="am-icon-angle-right"></span><span class="am-icon-angle-right"></span></a></h3>
				</div>
				<?php $list = phpok('dlishi','fields=id','psize=5');?>
				<div class="am-panel-bd">
					<ul class="am-list arclist">
						<?php $tmpid["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$tmpid = array();$tmpid["total"] = count($list['rslist']);$tmpid["index"] = -1;foreach($list['rslist'] as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<li class="am-g am-list-item-dated">
							<a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>" class="am-list-item-hd "><?php echo $value['title'];?></a><span class="am-list-date"><?php echo date('Y-m-d',$value['dateline']);?></span>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="am-u-lg-5" style="padding-left:2em;">
			<div class="am-panel am-panel-default" style="padding: 0 15px;">
				<div class="am-panel-hd">
					<h3 class="am-panel-title">地方动态<a href="<?php echo $list['project']['url'];?>" class="more">更多 <span class="am-icon-angle-right"></span><span class="am-icon-angle-right"></span></a></h3>
				</div>
				<?php $list = phpok('ddifang','fields=id','psize=10');?>
				<div class="am-panel-bd">
					<ul class="am-list arclist">
						<?php $tmpid["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$tmpid = array();$tmpid["total"] = count($list['rslist']);$tmpid["index"] = -1;foreach($list['rslist'] as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<li class="am-g am-list-item-dated">
							<a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>" class="am-list-item-hd "><?php echo $value['title'];?></a><span class="am-list-date"><?php echo date('Y-m-d',$value['dateline']);?></span>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="am-u-lg-3" style="padding-left:2em;">
			<div class="am-panel am-panel-default" style="padding: 0 15px;">
				<div class="am-panel-hd">
					<h3 class="am-panel-title">赛事预告<a href="<?php echo $list['project']['url'];?>" class="more">更多 <span class="am-icon-angle-right"></span><span class="am-icon-angle-right"></span></a></h3>
				</div>
				<?php $list = phpok('dsaishi','fields=id','psize=10');?>
				<div class="am-panel-bd">
					<ul class="am-list arclist">
						<?php $tmpid["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$tmpid = array();$tmpid["total"] = count($list['rslist']);$tmpid["index"] = -1;foreach($list['rslist'] as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<li class="am-g am-list-item-dated">
							<a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>" class="am-list-item-hd "><?php echo $value['title'];?></a><span class="am-list-date"><?php echo date('Y-m-d',$value['dateline']);?></span>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="ad-wrap" style="margin-top:20px;">
		<?php $list = phpok('adplayer');?>
			<?php if($list['total']){ ?>
			<div class="banner adbanner">
				<div class="bd">
					<ul>
						<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id = array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] as $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
						<li><a href="<?php echo $value['link'];?>" target="<?php echo $value['target'];?>" title="<?php echo $value['title'];?>"><img src="images/blank.gif" _src="<?php echo $value['pic']['filename'];?>" alt="<?php echo $value['title'];?>" /></a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="hd">
					<ul>
						<?php $tmpid["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$tmpid = array();$tmpid["total"] = count($list['rslist']);$tmpid["index"] = -1;foreach($list['rslist'] as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<li><?php echo $tmpid['num'];?></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<script type="text/javascript">
			$(document).ready(function(){
				$(".adbanner").slide({'autoPlay':true,'switchLoad':'_src','mainCell':'.bd ul'});
			});
			</script>
			<?php } ?>						
  </div>
	<div class="am-g am-g-collapse block-box" style="margin-top:20px;">
		<div class="am-u-lg-4" >
			<div class="am-panel am-panel-default" style="padding: 0 15px;">
				<div class="am-panel-hd">
					<h3 class="am-panel-title">企业专访<a href="<?php echo $list['project']['url'];?>" class="more">更多 <span class="am-icon-angle-right"></span><span class="am-icon-angle-right"></span></a></h3>
				</div>
				<?php $list = phpok('dqiye','fields=id','psize=10');?>
				<div class="am-panel-bd">
					<ul class="am-list arclist">
						<?php $tmpid["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$tmpid = array();$tmpid["total"] = count($list['rslist']);$tmpid["index"] = -1;foreach($list['rslist'] as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<li class="am-g am-list-item-dated">
							<a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>" class="am-list-item-hd "><?php echo $value['title'];?></a><span class="am-list-date"><?php echo date('Y-m-d',$value['dateline']);?></span>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="am-u-lg-5" style="padding-left:2em;">
			<div class="am-panel am-panel-default" style="padding: 0 15px;">
				<div class="am-panel-hd">
					<h3 class="am-panel-title">趣味棋牌<a href="<?php echo $list['project']['url'];?>" class="more">更多 <span class="am-icon-angle-right"></span><span class="am-icon-angle-right"></span></a></h3>
				</div>
				<?php $list = phpok('dquwei','fields=id','psize=10');?>
				<div class="am-panel-bd">
					<ul class="am-list arclist">
						<?php $tmpid["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$tmpid = array();$tmpid["total"] = count($list['rslist']);$tmpid["index"] = -1;foreach($list['rslist'] as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<li class="am-g am-list-item-dated">
							<a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>" class="am-list-item-hd "><?php echo $value['title'];?></a><span class="am-list-date"><?php echo date('Y-m-d',$value['dateline']);?></span>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="am-u-lg-3" style="padding-left:2em;">
			<div class="am-panel am-panel-default" style="padding: 0 15px;">
				<div class="am-panel-hd">
					<h3 class="am-panel-title">精彩回顾<a href="<?php echo $list['project']['url'];?>" class="more">更多 <span class="am-icon-angle-right"></span><span class="am-icon-angle-right"></span></a></h3>
				</div>
				<?php $list = phpok('dhuigu','fields=id','psize=10');?>
				<div class="am-panel-bd">
					<ul class="am-list arclist">
						<?php $tmpid["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$tmpid = array();$tmpid["total"] = count($list['rslist']);$tmpid["index"] = -1;foreach($list['rslist'] as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
						<li class="am-g am-list-item-dated">
							<a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>" class="am-list-item-hd "><?php echo $value['title'];?></a><span class="am-list-date"><?php echo date('Y-m-d',$value['dateline']);?></span>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<?php $list = phpok('link');?>
	<div class="am-panel am-panel-default mt10" style="padding: 0 15px;margin-top: 20px !important;">
		<div class="am-panel-hd">
			<h3 class="am-panel-title">
				<?php echo $list['project']['title'];?>
				<a href="<?php echo phpok_url(array('ctrl'=>'post','id'=>$list['project']['identifier']));?>" class="more">申请友情链接 <span class="am-icon-angle-right"></span><span class="am-icon-angle-right"></span></a>
			</h3>
		</div>
		
		<div class="am-panel-bd link">
			<?php $list_rslist_id["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$list_rslist_id = array();$list_rslist_id["total"] = count($list['rslist']);$list_rslist_id["index"] = -1;foreach($list['rslist'] as $key=>$value){ $list_rslist_id["num"]++;$list_rslist_id["index"]++; ?>
			<a href="<?php echo $value['link'];?>" target="<?php echo $value['target'];?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a>
			<?php } ?>
		</div>
	</div>
</section>

<?php $this->output("foot","file"); ?>