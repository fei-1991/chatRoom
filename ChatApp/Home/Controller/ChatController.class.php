<?php
namespace Home\Controller;
use Think\Controller;
class ChatController extends Controller {
    public function index(){
        $target = I("get.target");
        $this->assign("target",$target);
        $this->display();
    }
    
    public function send_message(){
       $saveData['getter'] = I("post.target");
       $saveData['sender'] = session("username");
       $saveData['content'] = I("post.con");
       $saveData['send_time'] = time();
       if(M("message")->add($saveData)){
           $this->ajaxReturn("ok");
       }else{
           $this->ajaxReturn("error");
       }
    }
    
    public function get_message(){
        $condition['getter'] = session("username");
        $condition['sender'] = I("post.sender");
        $condition['is_read'] = "0";
         
        $data = M("message")->where($condition)->select();
        M("message")->where($condition)->save(array("is_read"=>1));
        
        //xml
        $messageInfo = '<?xml version="1.0" encoding="ISO-8859-1"?>';
        $messageInfo .= "<meses>";
        foreach($data as $k => $v){
            $row = $k;    
            $messageInfo .= "<mesid>{$row['id']}</mesid>";
            $messageInfo .= "<sender>{$row['sender']}</sender>";
            $messageInfo .= "<getter>{$row['getter']}</getter>";
            $messageInfo .= "<con>{$row['content']}</con>";
            $messageInfo .= "<sendTime>{$row['sendTime']}</sendTime>";
            
        }
         $messageInfo .= "</meses>";
         $this->ajaxReturn($data,'xml');
    }
	public function get_message_num(){
		$info = M("message")->query("SELECT COUNT(*) AS num ,sender FROM tp_message WHERE getter='".session('username')."' AND is_read=0 GROUP BY sender");
		$gg = array();
		foreach($info as $k => $v){
			$gg[$v['sender']]= $v['num'];
		}
		return $this->ajaxReturn($gg);
	}
}