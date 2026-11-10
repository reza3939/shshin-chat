<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if ($_SESSION['captcha-txt'] != $_REQUEST['captcha']) {
    ?>
    <script type="text/javascript">
        alert('تصویر امنیتی را درست وارد نکردید.');
        history.go(-1);
    </script>
    <?php
    return;
}
$author = safe::string($_REQUEST['author']);
if ($author == "") {
    ?>
    <script type="text/javascript">
        alert('نام خود را وارد نکردید');
        history.go(-1);
    </script>
    <?php
    return;
}
$to = safe::number($_REQUEST['to']);
if (!Users::CheckId($to)) {
    header::Go(url('contact'));
    exit();
}
$subject = safe::string($_REQUEST['subject']);
if ($subject == '') {
    ?>
    <script type="text/javascript">
        alert('یک موضوع برای نامه خود وارد کنید');
        history.go(-1);
    </script>
    <?php
    exit();
}
$email = $_REQUEST['email'];
$ip = safe::string($_REQUEST['ip']);
if (!safe::is_email($email)) {
    $email = '';
}
if ($email == '') {
    ?>
    <script type="text/javascript">
        alert('لطفا ایمیل خود را وارد کنید');
        history.go(-1);
    </script>
    <?php
    exit;
}
$content = str_replace("\n", '<br>', strip_tags(addslashes($_REQUEST['content'])));
$sql->insert('letters', array(
    'author' => $author,
    'to' => $to,
    'subject' => $subject,
    'time' => time(),
    'content' => $content,
    'status' => 0,
    'email' => $email,
    'ip' => $ip
));
if ($options['send_letters2private_admin'] == 'true') {
    send2admin($content, $ip, $author, $email, $subject, $to);
}
?>
<script type="text/javascript">
    alert('با موفقیت ذخیره شد');
    location.href = "<?php echo(url('contact')); ?>";
</script>
<?php

function send2admin($content, $ip, $author, $email, $subject, $to) {
    global $sql;
    $note = '<table dir="rtl" cellpadding="3" border="1" align="center">
	<tr><td><b>ارسال کننده نامه:</b></td><td><b><font color=red>' . $author . '</font></b></td></tr>
	<tr><td><b>موضوع:</b></td><td><b><font color=red>' . $subject . '</font></b></td></tr>
	<tr><td><b>ایمیل:</b></td><td><b><font color=red>' . $email . '</font></b></td></tr>
	<tr><td><b>آی پی:</b></td><td><b><font color=red>' . $ip . '</font></b></td></tr>
	<tr><td><b>متن نامه:</b></td><td><b><font color=red>' . $content . '</font></b></td></tr>
	</table><hr>';
    $sql->where("id", $to);
    if($row = $sql->getOne('onlines', array('id', 'type', 'roomid'))){
        if ($row['roomid'] == '1')
            $row['roomid'] = '-1';
        $sql->insert('message', array(
            'user' => -1,
            'username' => 'SYSTEM [ <b><font color=red>نامه کاربران</font></b> ]',
            'color' => '000000',
            'room' => $row['roomid'],
            'text' => $note,
            'date' => time(),
            'to' => $row['id'],
            'into' => 'pm',
            'type' => 0
        ));
    }
    $text = "نامه ای جدید در پنل مدیریت دارید\n";
    $text .='ای پی : '.$ip."\n";
    $text .='ایمیل : '.$email."\n";
    $text .= "آدرس : ".url()."\n";
    $text .= "ارسال کننده نامه :".$author."\n";
    $text .= "موضوع نامه :".$subject."\n";
    $text .= "متن نامه :".$content."\t";

             tlg($text,'chat');
             
}
?>