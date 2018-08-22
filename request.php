<?php
/**
 *POST&GET
 *curl
 * */
function send_form($url,$https=true,$method='get',$data=null){
    //1.初始化url
    $ch = curl_init($url);
    //2.设置相关的参数
    //字符串不直接输出,进行一个变量的存储
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //判断是否为https请求
    //tps:是以安全为目标的HTTP通道，简单讲是HTTP的安全版
    if($https === true){
        //验证对方的SSL证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //检查声称服务器的证书的身份
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    //判断是否为post请求
    if($method == 'post'){
        //发送post请求
        curl_setopt($ch, CURLOPT_POST, true);
        //设置post参数
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    //3.发送请求
    $str = curl_exec($ch);
    //4.关闭连接
    curl_close($ch);
    //返回请求到的结果
    return $str;
}
if($_REQUEST['question']){
    $info = $_REQUEST['question'];
}else{
    $info = "你好";
}
//$url = "http://op.juhe.cn/robot/index?info=$info&key=76329c3221651af393920e1331e61002";
//$rep = send_form($url,$https=false);
$rep = '{
    "reason":"成功的返回",
    "result": 
        {
            "code":100000, 
            "text":"你好啊，希望你今天过的快乐"
        },
     "error_code":0
}';
$data = json_decode($rep,true);
if($data['result']['code'] == 100000){
    $msg = array('code'=>1,'data'=>$data['result']['text'],'msg'=>"success");
    echo json_encode($msg);
}else{
    $msg = array('code'=>2,'data'=>'请求异常','msg'=>"error");
    echo json_encode($msg);
}
