<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><hr data-am-widget="divider" style="" class="am-divider am-divider-dotted" />
<ul class="am-avg-sm-2">
	<li>上一主题：
		<?php $prev = phpok_prev($rs);?>
		<?php if($prev){ ?>
		<a href="<?php echo $prev['url'];?>" title="<?php echo $prev['title'];?>"><?php echo $prev['title'];?></a>
		<?php } else { ?>
		没有了
		<?php } ?>
	</li>
	<li style="text-align:right;">下一主题：
		<?php $next = phpok_next($rs);?>
		<?php if($next){ ?>
		<a href="<?php echo $next['url'];?>" title="<?php echo $next['title'];?>"><?php echo $next['title'];?></a>
		<?php } else { ?>
		没有了
		<?php } ?>
	</li>
</ul>