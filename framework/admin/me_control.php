<?php
/**
 * 管理员面板信息
 * @作者 qinggan <admin@phpok.com>
 * @版权 深圳市锟铻科技有限公司
 * @主页 http://www.phpok.com
 * @版本 4.x
 * @授权 http://www.phpok.com/lgpl.html 开源授权协议：GNU Lesser General Public License
 * @时间 2018年03月17日
**/

if(!defined("PHPOK_SET")){exit("<h1>Access Denied</h1>");}
class me_control extends phpok_control
{
	public function __construct()
	{
		parent::control();
	}

	public function setting_f()
	{
		$rs = $this->model('admin')->get_one($this->session->val('admin_id'),'id');
		$this->assign('rs',$rs);
		$this->view('me_setting');
	}

	public function submit_f()
	{
		$this->config('is_ajax',true);
		$oldpass = $this->get("oldpass");
		if(!$oldpass){
			$this->error(P_Lang('管理员密码验证不能为空'));
		}
		$rs = $this->model('admin')->get_one($this->session->val('admin_id'));
		if(!password_check($oldpass,$rs["pass"])){
			$this->error(P_Lang("管理员密码不正确"));
		}
		$name = $this->get('name');
		$array = array('email'=>$this->get('email'));
		$update_login = false;
		$admin = $this->model('admin')->get_one($this->session->val('admin_id'),'id');
		$tip = P_Lang('信息修改成功');
		if($name && $name != $admin['account']){
			$check = $this->model('admin')->check_account($name,$this->session->val('admin_id'));
			if($check){
				$this->error(P_Lang('管理员账号已经存在，请重新设置'));
			}
			$array['account'] = $name;
			$update_login = true;
			$tip = P_Lang('管理员账号信息变更成功，请重新登录');
		}
		$newpass = $this->get("newpass");
		if($newpass){
			$chkpass = $this->get("chkpass");
			if($newpass != $chkpass){
				$this->error(P_Lang("两次输入的新密码不一致"));
			}
			$array['pass'] = password_create($newpass);
			$tip = P_Lang('密码修改成功，请下次登录后使用新密码登录！');
		}
		$array['fullname'] = $this->get('fullname');
		$array['close_tip'] = $this->get('close_tip');
		$this->model('admin')->save($array,$this->session->val('admin_id'));
		if(!$update_login){
			$info = $this->model('admin')->get_one($this->session->val('admin_id'),'id');
			$this->session->assign('admin_rs',$info);
		}
		//检查是否启用开发模式
		$adm_develop = $this->get('adm_develop','int');
		$this->session->assign('adm_develop',$adm_develop);
		$this->success();
	}
}
?>