<?php
include('header.php');
include('sidebar.php');
?>

<script>
    var $letterId = '';
    $$.ready(function () {
        var $dialog = $("#dialog_message");
        $dialog.dialog({
            autoOpen: false,
            width: 500,
            modal: true
        });
        $('.cancel', $dialog).click(function () {
            $(this).parents('.ui-dialog-content').dialog('close');
        });
        $('.ok', $dialog).click(function () {
            var $replay = $('input[name=text]', $('#dialog_message')).val();
            if ($replay == '') {
                alert('لطفا متنی برای ارسال بنویسید');
                return false;
            }
            $.ajax({
                type: "POST",
                url: '<?php echo(url('ajax/admin.letters.replay')); ?>',
                data: {letter: $letterId, text: $replay},
                success: function (data) {
                    switch (data) {
                        case('ok'):
                            alert('با موفقیت ارسال شد');
                            $(this).parents('.ui-dialog-content').dialog('close');
                            break;
                        case('nottoyou'):
                            alert('مقصد این نامه شما نیستید');
                            break;
                        case('worngid'):
                            alert('ورودئ اشتباه');
                            break;
                        case('cannot'):
                            alert('سرور توان ارسال ایمیل را ندارد');
                            break;
                        case('noemail'):
                            alert('این شخص ایمیل خود را برای دریافت پاسخ درج نکرده است');
                            break;
                        default:
                            alert(data);
                            break;
                    }
                },
                done: function () {
                    $(elem).text('حذف');
                }
            });

        });

        $(".open-message-dialog").click(function () {


            var $msg = $(this).parent().parent().parent().parent();
            $letterId = $($msg).attr('id').substr(4);
            var $author = $('.content h3', $msg).text();
            $('.messages .msg .content h3 a', $dialog).html($author);
            $('.textletter', $dialog).html($('.content p', $msg).html());
            $dialog.dialog("open").dialog("option", "title", "پاسخ: " + $author);
            return false;
        });
    });

</script>

<div style="display: none;" id="dialog_message" title="">
    <div class="spacer">
    </div>
    <div class="messages full chat">
        <div class="msg">
            <img src="<?php echo(theme::url('img/icons/packs/iconsweets2/25x25/user-2.png')); ?>"/>
            <div class="content">
                <h3>
                    <a href="#"></a>
                    <span>گفته:</span>
                </h3>
                <p class="textletter"></p>
            </div>
        </div>
    </div>
    <div class="actions">
        <div class="right">
            <input style="width: 330px;" type="text" name="text" placeholder="پاسخ خود را بنویسید"/>
        </div>
        <div class="left">
            <button class="ok">ارسال</button>
            <button class="grey cancel">انصراف</button>
        </div>
    </div>
</div>
<?php
if(isset($_POST['openlock'])){
if(md5($_POST['code_password'])==$options['security_password']){
$_SESSION['yaser']=$options['security_password'];
}
}
?>
<?php
if(($_SESSION['yaser'] ?? '')==$options['security_password']){
?>
<section id="content" class="container_12 clearfix" data-sort=true>
    <h1 class="grid_12 margin-top no-margin-top-phone">نامه ها</h1>

    <div class="grid_12">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/calendar-select.png')); ?>">
                    پیام ها
                </h2>
            </div>
            <div class="content">
                <div class="spacer">
                </div>
                <div class="messages full">
                    <?php
                    $query = db::query("SELECT * FROM {prefix}letters WHERE `to`='" . session('id') . "'");
                    while ($row = mysqli_fetch_array($query)) {
                        if ($row['status'] == '0') {
                            db::update('letters', "`status`='1'", "`id`='{$row['id']}'");
                        }
                        ?>
                        <div class="msg" id="msg-<?php echo($row['id']); ?>">
                            <div class="left">
                                <img src="<?php echo(theme::url('img/icons/packs/iconsweets2/25x25/user-2.png')); ?>"/>
                                <ul class="buttons">
                                    <li>
                                        <a onclick="deleteletters('<?php echo($row['id']); ?>', $(this).parent());" href="javascript:void(0);"><img src="<?php echo(theme::url('img/icons/packs/iconsweets2/16x16/trashcan-2.png')); ?>" alt=""/></a>
                                    </li>
                                    <?php if ($row['email'] != '') { ?>
                                        <li>
                                            <a class="open-message-dialog" href="javascript:void(0);"><img src="<?php echo(theme::url('img/icons/packs/iconsweets2/16x16/bended-arrow-right.png')); ?>" alt=""/></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="content">
                                <h3 style="direction: rtl"><?php echo($row['subject'] . ' | ' . $row['author'] . ' | ' . $row['ip'] . ' | ' . $row['email']) . ' | ' . (jdate::start('Y/m/d  | H:i', $row['date'])); ?></h3>
                                <p><?php echo($row['content']); ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
}else{
?>
<center>
<br>
<form action="" method="POST">
<div style="background-image:url('/theme/adminpanel/img/files.png');height: 300px;width: 300px;margin-top:80px;margin-right:180px;color:#fff;border-radius: 5px;"><br><br>
<br><br><br><br><br><br><br><br>
<input name="code_password" value="" type="text">
<button name="openlock" class="grey cancel">باز کن</button>
</div>
<p><b>رمز امنیتی را وارد کنید</b></p>
<p><b>این رمز از پنل اضطراری قابل تغییر است</b></p>
</form>
</center>
<?php } ?>
<?php include 'footer.php'; ?>