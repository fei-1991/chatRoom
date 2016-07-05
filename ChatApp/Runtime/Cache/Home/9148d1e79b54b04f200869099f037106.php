<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>和<?=$username?>聊天中</title>
    <script type="text/javascript" src="<?php echo (HOME_JS_PATH); ?>jquery-3.0.0.min.js"></script>
    <script type="text/javascript">
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
        window.setInterval("getMessage()",1500); 
        //获取聊天信息
        function getMessage()
        {
            var myXmlHttpRequest = getXmlHttpRequest();            
            if (myXmlHttpRequest)
            {
                var url = "<?php echo U('Chat/get_message');?>"; 
                var data = "sender=<?php echo ($target); ?>";

                myXmlHttpRequest.open("post",url,true);
                myXmlHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                myXmlHttpRequest.onreadystatechange=function(){
                    if (myXmlHttpRequest.readyState == 4)
                    {
                        if (myXmlHttpRequest.status == 200)
                        {
                            var mesRes = myXmlHttpRequest.responseXML;
                            var cons = mesRes.getElementsByTagName('content');
                            var sendTimes = mesRes.getElementsByTagName('send_time');

                            if (cons.length != 0)
                            {
                                for (var i = 0; i < cons.length; i++)
                                {
																	  var value = $('#talk').val();
                                    value += '<?php echo ($target); ?>对你';
                                    value += '(' + sendTimes[i].childNodes[0].nodeValue;
                                    value += ')说:\r\n';
                                    value += cons[i].childNodes[0].nodeValue;
                                    value += '\r\n';
                                    
                                }
																$('#talk').val(value);

                            }

                        }
                    }
                }

                myXmlHttpRequest.send(data);
            }
        }

        //发送聊天信息
        function sendMessage(){
            var myXmlHttpRequest = getXmlHttpRequest();            
            if (myXmlHttpRequest)
            {
                var url = "<?php echo U('Chat/send_message');?>";
                var data = "con=" + $('#con').val();
                data += "&target=<?php echo ($target); ?>";
                myXmlHttpRequest.open("post",url,true);

                myXmlHttpRequest.setRequestHeader("Content-Type",
                    "application/x-www-form-urlencoded");

                myXmlHttpRequest.onreadystatechange=function(){
                    if (myXmlHttpRequest.readyState == 4)
                    {
                        if (myXmlHttpRequest.status == 200)
                        {
                            var res = myXmlHttpRequest.responseText;
														res = JSON.parse(res);
														alert(res);
                            if (res == 'ok'){
															  var value = $('#talk').val();
                                value += '你对<?=$username?>(';
                                value += new Date().toLocaleString();                        
                                value += ')说:\r\n';
                                value += $('#con').val();
                                value += '\r\n';
																$('#talk').val(value);
                                $('#con').val("");
                            }else{
                                window.alert('发送消息失败！');
                            }
                        }
                    }
                }

                if ($('con').value == '')
                {
                     window.alert('发送信息不允许为空！');
                }
                else
                {
                    myXmlHttpRequest.send(data);
                }
            }
        }

        function BindEnter(obj)
        {
            var button = $('btn1');
            if (obj.keyCode == 13)
            {
                button.click();
                obj.returnValue = false;
            }
        }
    </script>
</head>
<center>
<body onkeydown="BindEnter(event)">
    <h2>聊天室(正在和<font color="red"><?php echo ($target); ?></font>聊天)</h2>
    <textarea id="talk" cols="50" rows="20"></textarea><br/>
    <input id="con" type="text" style="width:300px" />
    <input id="btn1" type="button" value="发送信息" onclick="sendMessage()" />
</body>
</center>
</html>