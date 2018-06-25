<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php echo phpok_head_css();?>
<?php echo phpok_head_js();?>
<script type="text/javascript">
$(document).ready(function(){
	//window.setTimeout(function(){
	//	$.phpok.json(api_url('task'),function(rs){return true;});
	//}, 2000);
	//更新购物车产品数量
	$.cart.total();
});
</script>
<?php echo $app->plugin_html_ap("phpokbody");?></body>
</html>