<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php $this->assign("title",$title); ?><?php $this->output("header","file"); ?>
<header>
	<div class="top">
		<div class="logo"><a href="<?php echo $sys['url'];?>" title="<?php echo $config['title'];?>"><img src="<?php echo $config['logo'];?>" alt="<?php echo $config['title'];?>" /></a></div>
		<div class="right">
			<form class="am-form-inline" id="top-search-form" method="post" action="<?php echo phpok_url(array('ctrl'=>'search'));?>" onsubmit="return top_search()">
				<div class="am-form-group">
					<input name="keywords" value="<?php echo $keywords;?>" id="top-keywords" type="text" class="am-form-field" placeholder="请输入关键字" />
				</div>
				<button type="submit" class="am-btn am-btn-primary">
					<i class="am-icon-search"></i>
				</button>
			</form>
		</div>
	</div>
	<nav class="menu">
		<div class="menu">
		<ul>
			<?php $list = phpok('menu');?>
			<?php $tmpid["num"] = 0;$list['rslist']=is_array($list['rslist']) ? $list['rslist'] : array();$tmpid = array();$tmpid["total"] = count($list['rslist']);$tmpid["index"] = -1;foreach($list['rslist'] as $key=>$value){ $tmpid["num"]++;$tmpid["index"]++; ?>
			<li<?php if($highlight == $tmpid['num'] || $menutitle == $value['title']){ ?> class="current"<?php } ?>>
				<dl>
					<dt><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>" target="<?php echo $value['target'];?>"><?php echo $value['title'];?></a><?php if($value['sonlist']){ ?> <span class="am-icon-angle-down"></span><?php } ?></dt>
					<?php $value_sonlist_id["num"] = 0;$value['sonlist']=is_array($value['sonlist']) ? $value['sonlist'] : array();$value_sonlist_id = array();$value_sonlist_id["total"] = count($value['sonlist']);$value_sonlist_id["index"] = -1;foreach($value['sonlist'] as $k=>$v){ $value_sonlist_id["num"]++;$value_sonlist_id["index"]++; ?>
					<dd><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>" target="<?php echo $v['target'];?>"><?php echo $v['title'];?></a></dd>
					<?php } ?>
				</dl>
			</li>
			<?php } ?>
		</ul>
		</div>
	</nav>
</header>
