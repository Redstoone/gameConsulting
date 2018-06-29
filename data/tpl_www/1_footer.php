<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php echo phpok_head_css();?>
<?php echo phpok_head_js();?>
<script type="text/javascript">
$(document).ready(function(){
	$.cart.total();
});
</script>
<?php echo $app->plugin_html_ap("phpokbody");?></body>
</html>