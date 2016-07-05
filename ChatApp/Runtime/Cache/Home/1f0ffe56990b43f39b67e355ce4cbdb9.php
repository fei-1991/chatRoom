<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MyQQ</title>
    <script type="text/javascript" src="<?php echo (HOME_JS_PATH); ?>jquery-3.0.0.min.js"></script>
    <script type="text/javascript"></script>
</head>
<body>
   <?php if(is_array($data)): foreach($data as $key=>$v): ?><a href="<?php echo U('Chat/index',array('target'=>$v['username']));?>" target='_bank'><?php echo ($v["username"]); ?></a>&nbsp;<span style="color:red" id="<?php echo ($v["username"]); ?>"><?php echo $gg[$v['username']] ?></span><br/><?php endforeach; endif; ?>
</body>
</html>
<script>
function getXmlHttpRequest(){
					xmlhttp=null;
					if (window.XMLHttpRequest){// code for all new browsers
						xmlhttp=new XMLHttpRequest();
						}
					else if (window.ActiveXObject){// code for IE5 and IE6
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
						return xmlhttp;
				}
        window.resizeTo(500,400);
        window.setInterval("getMessageNum()",1500); 
        //获取聊天信息
        function getMessageNum()
        {
            var myXmlHttpRequest = getXmlHttpRequest();            
            if (myXmlHttpRequest)
            {
                var url = "<?php echo U('Chat/get_message_num');?>";
                myXmlHttpRequest.open("post",url,true);
                myXmlHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                myXmlHttpRequest.onreadystatechange=function(){
                    if (myXmlHttpRequest.readyState == 4)
                    {
                        if (myXmlHttpRequest.status == 200)
                        {
                            var mesRes = myXmlHttpRequest.responseText;
				
                            var message_num = JSON.parse(mesRes);
						
							for(var i in message_num){
                           
							    $("#"+i).text(message_num[i]);
							}
                        }
                    }
                }

                myXmlHttpRequest.send(null);
            }
        }

</script>