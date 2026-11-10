<?php

    $bank=safe::number($_POST['amount']);
    $bank=$bank/$options['pay_bank'];
    settype($bank,'integer');
    $status=safe::number($_POST['status']);
    $ref=safe::number($_POST['ref']);
    $key=safe::string($_POST['key']);
    if(!empty($_POST['user']) && !empty($_POST['secretId']) && !empty($status) && !empty($ref) && !empty($key)){
        $sql>where("id", safe::number($_POST['user']));
	$get = $sql->getOne('users',array('bank'));
	$sql->where("id", safe::number($_POST['user']));
	$sql->update('users', array(
		'bank' => $sql->inc($bank)
	));
	$sql->where("id", safe::number($_POST['user']));
	$sql->update('onlines', array(
		'bank' => $sql->inc($bank)
	));
	$sql->where('key', $key);
	$sql->where("user", safe::number($_POST['user']));
	$sql->update('pays', array(
		'ref' => $ref,
		'status' => $status
	));
        echo "~~ok~{$get[0]}~{$bank}~~";
        exit();
    }else{
        header::Go(url('login'));
        exit();
    }
    if(!empty($_POST['validate'])){
        switch($_POST['validate']){
            case 'ok' :
                html(' پرداخت با موفقیت انجام شده است .');
                break;
            case 'no' :
                html(' پرداخت با موفقیت انجام نشده است ');
                break;
            default:
                html(' پارامتر هاي ارسالی صحیح نمی باشد ');
                break;
        }
    }
    function html($message){
        echo "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><style type=\"text/css\">body{background:none repeat scroll 0 0 #fafafa;direction:rtl;font-family:tahoma;font-size:13px;text-align:center;}#message{background:none repeat scroll 0 0 #f4f4f4;border:2px solid #efefef;color:#333333;height:50px;line-height:50px;margin:100px auto;width:600px;}</style></head><body><div id='message'>{$message}</div></body></html>";
    }
?>