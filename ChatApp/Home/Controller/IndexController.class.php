<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function _initialize(){
		file_put_contents("bbb.txt",444);
		if(!session("username")){
			$this->redirect('Home/login/index');
		}
	}
    public function index(){
        $data = M("user")->field("username")->select();
        $info = M("message")->
		$info = M("message")->query("SELECT COUNT(*) AS num ,sender FROM tp_message WHERE getter='".session('username')."' AND is_read=0 GROUP BY sender");
		$gg = array();
		foreach($info as $k => $v){
			$gg[$v['sender']]= $v['num'];
		}
        $this->assign("data",$data);
		$this->assign("gg",$gg);
	    $this->display();
    }
}