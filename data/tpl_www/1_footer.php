<?php if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");} ?><?php echo phpok_head_css();?>
<?php echo phpok_head_js();?>
<script type="text/javascript">
$(document).ready(function(){
	$.cart.total();
	var menuList = ['industry', 'match', 'local', 'interest', 'history', 'character', 'review', 'company']

	var id = GetQueryString("id");
	var cate = GetQueryString("cate");

	if (id == 'news' && menuList.indexOf(cate) > 0) {
		$('.menu ul li:eq('+ (menuList.indexOf(cate) + 1) +')').addClass('current');
	}

	function GetQueryString(name) {
		var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
		var r = window.location.search.substr(1).match(reg);
		if(r!=null)return  unescape(r[2]); return null;
	}
});
</script>
<?php echo $app->plugin_html_ap("phpokbody");?></body>
</html>