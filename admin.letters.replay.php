<?php

if (!session('id') or session('admin') == '0')
    exit();
adminpanel::check_Permission('exit', 'replayletters');
$letter = isset($_POST['letter']) ? safe::number($_POST['letter']) : '';
$sql->where("id", $letter);
if ($letter = $sql->getOne('letters')) {
    if ($letter['to'] == session('id')) {
        if ($letter['email'] != '') {
            $msgText = isset($_POST['text']) ? safe::string($_POST['text']) : '';
            if ($msgText == '') {
                echo('msgtext');
                return;
            }
            require('inc/classes/class.phpmailer/class.phpmailer.php');
            $subject = "پاسخ به: {$letter['subject']}";
            $message = '<html><head><style type=\'text/css\'>body{text-align: right;font-family: Tahoma,Arial;font-size: 12px;direction: rtl;}</style></head><body><p>باعرض سلام</p><p>در تاریخ {date} شما نامه ای با عنوان {subject} به یکی از مدیران {site_title} ارسال کردید</p><p>اکنون {username} پاسخی برای شما ارسال کرده است،متن پاسخ به شرح زیر است:</p><p>{msgText}</p><p>-------------------------------------</p><p>باتشکر،تیم مدیریتی {site_title}</p></body></html>';
            $message = str_replace(array('{date}', '{subject}', '{site_title}', '{username}', '{msgText}'), array(jdate::start('Y/m/d', $letter['time']), $letter['subject'], site_title, session('name'), $msgText), $message);
            $mail = new PHPMailer();
            $mail->CharSet = 'UTF-8';
            $mail->SetFrom($options['email'], site_title);
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body = $message;
            $mail->AddAddress($letter['email'], $letter['author']);
            if ($mail->Send()) {
              

$sql->where("id", session('id'));
$hide = $sql->getOne('onlines', array('id','hide'));
if ($hide['hide'] == '1' and session("admin")==1){
}elseif ($hide['hide'] == '0' and session("admin")!=0){
                chatroom::addlog('9', "به نامه \"{$letter['subject']}\" پاسخ داد");
}

  $tel = json_decode($options['teloptions'], true);
   $text = "به نامه با عنوان \"{$letter['subject']}\" پاسخ داد\n";

       $text .='متن پاسخ : '.$msgText."\n";
    $text .='ای پی : '.ip()."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "نام نمایشی :".session('name')."\t";
    
       if($tel['sendletterslog'] == 'Sure'){
             tlg($text,'chat');
                 }
           echo("ok");
            } else {
                echo("cannot");
            }
        } else {
            echo('noemail');
        }
    } else {
        echo('nottoyou');
    }
} else {
    echo('worngid');
}
?>