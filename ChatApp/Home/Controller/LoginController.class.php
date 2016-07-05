<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
		$this->display();
    }
	public function login(){
		$data = I("post.");
                $condition['username'] = $data['username'];
                $condition['password'] = $data['password'];
                $info  = M("user")->where($condition)->field("username")->find();
                if(count($info)){
                    session("username",$info['username']);
					$this->success("登陆成功",U("Index/index"));
                }else{
                    $this->error("登录失败");
                }
	}
        public function login_out(){
            session(null);
            $this->redirect("Index/index");
        }
}