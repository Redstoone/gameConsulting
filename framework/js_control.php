<?php
/**
 * JS 控制器
 * @package phpok\framework
 * @作者 qinggan <admin@phpok.com>
 * @版权 深圳市锟铻科技有限公司
 * @主页 http://www.phpok.com
 * @版本 4.x
 * @授权 http://www.phpok.com/lgpl.html PHPOK开源授权协议：GNU Lesser General Public License
 * @时间 2017年11月13日
**/

if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");}
class js_control extends phpok_control
{
	public function __construct()
	{
		parent::control();
	}

	/**
	 * 通用 JS，包括加载 form.js
	**/
	public function index_f()
	{
		$this->js_base();
		echo $this->lib('file')->cat($this->dir_phpok."form.js");
		echo "\n";
		if($this->app_id == 'admin'){
			echo $this->lib('file')->cat($this->dir_phpok."admin.form.js");
			echo "\n";
		}
		$ext = $this->get("ext");
		$_ext = $this->get('_ext');
		$autoload_js = $this->config["autoload_js"];
		if($autoload_js){
			$ext = $ext ? $ext.",".$autoload_js : $autoload_js;
		}
		if(!$ext && !$_ext){
			exit;
		}
		$list = ($ext && is_string($ext)) ? explode(",",$ext) : ($ext ? $ext : array());
		$list = array_unique($list);
		if($_ext){
			$forbid_ext = is_string($_ext) ? explode(",",$_ext) : $_ext;
			$list = array_diff($list,$forbid_ext);
			if(!$list){
				exit;
			}
		}
		$this->load_ext($list,false);
		exit;
	}

	/**
	 * 加载扩展JS，不包括核心JS
	**/
	public function ext_f()
	{
		header("Content-type: application/x-javascript; charset=UTF-8");
		$js = $this->get("js");
		if(!$js){
			exit("\n");
		}
		$this->load_ext($js,false);
	}

	/**
	 * 最小核心JS加载（只加载 jquery.js 及 system.js 文件）
	**/
	public function mini_f()
	{
		$this->js_base();
		$ext = $this->get('ext');
		if($ext){
			$this->load_ext($ext,true);
		}
	}

	private function load_ext($ext,$is_admin=false)
	{
		if(!$ext){
			return false;
		}
		$list = is_string($ext) ? explode(",",$ext) : $ext;
		foreach($list as $key=>$value){
			if(!$value || !trim($value)){
				continue;
			}
			$value = trim($value);
			if(strtolower(substr($value,-3)) != '.js'){
				$value .= '.js';
			}
			if($is_admin){
				$file = $this->dir_phpok.'js/'.$value;
				if(!file_exists($file)){
					$file = $this->dir_root."js/".$value;
				}
				if(!file_exists($file)){
					continue;
				}
			}else{
				$file = $this->dir_root."js/".$value;
				if(!file_exists($file)){
					$file = $this->dir_phpok.'js/'.$value;
				}
				if(!file_exists($file)){
					continue;
				}
			}
			echo "\n";
			echo $this->lib('file')->cat($file);
			echo "\n";
			if($value == 'jquery.artdialog.js'){
				$this->js_artdialog_global_config();
			}
		}
	}

	private function js_artdialog_global_config()
	{
		echo "\n";
		echo '(function (config) {'."\n\t";
		echo 'config["title"] = "'.P_Lang('消息').'";'."\n\t";
		echo 'config["okVal"] = "'.P_Lang('确定').'";'."\n\t";
		echo 'config["cancelVal"] = "'.P_Lang('取消').'";'."\n";
		if($this->app_id == 'admin'){
			echo 'config["opacity"] = "0.2";'."\n";
		}
		echo '})(art.dialog.defaults);'."\n";
	}

	/**
	 * 加载基本的JS
	**/
	private function js_base()
	{
		header("Content-type: text/javascript; charset=utf-8");
		$file = $this->app_id == 'admin' ? $this->config['admin_file'] : $this->config['www_file'];
		$this->assign('basefile',$file);
		$this->load_language_js();
		$file = $this->dir_root.'js/jquery.js';
		//实现jQuery.js文件的自定义
		if($this->app_id != 'admin'){
			if(file_exists($this->dir_root.$this->tpl->dir_tpl.'js/jquery.js')){
				$file = $this->dir_root.$this->tpl->dir_tpl.'js/jquery.js';
			}
			if(file_exists($this->dir_root.$this->tpl->dir_tpl.'js/jquery.min.js')){
				$file = $this->dir_root.$this->tpl->dir_tpl.'js/jquery.min.js';
			}
		}
		$jquery = $this->lib('file')->cat($file);
		$this->assign('jquery',$jquery);
		$this->tpl->output($this->dir_phpok.'system.js','abs-file',false);
	}

	/**
	 * 加载JS下的语言包
	**/
	private function load_language_js()
	{
		$multiple_language = isset($GLOBALS['app']->config['multiple_language']) ? $GLOBALS['app']->config['multiple_language'] : false;
		if(!$multiple_language){
			return false;
		}
		$js_default_file = $this->dir_root.'langs/'.$this->app_id.'.xml';
		$default_list = $this->lib('xml')->read($js_default_file);
		if(!$default_list){
			$default_list = array();
		}
		$langs = false;
		if($this->langid != 'default' && $this->langid != 'cn'){
			$langfile = $this->dir_root."langs/".$this->langid."/LC_MESSAGES/".$this->app_id.".xml";
			$langlist = $this->lib('xml')->read($langfile);
			if($langlist){
				foreach($langlist as $key=>$value){
					if($default_list[$key]){
						$langs[$default_list[$key]] = $value;
					}
				}
			}
		}
		if($langs){
			$this->assign('langs',$langs);
		}
	}
}