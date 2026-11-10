<?php
include('header.php');
include('sidebar.php');
$room = safe::number(giu('el4'));
$room = db::get('rooms', "`id`, `title`", "`id`='$room'");
if (!$room) {
    include('pages/notfound.php');
    return;
}
$defaultroom = $room['id'] == $options['chat_defaultroom'] ? true : false;
?>
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
    <h1 class="grid_12 margin-top no-margin-top-phone">حذف اتاق</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formdelroom" action="<?php echo(url('form/admin.rooms.delete')); ?>" method="post">
                <input type="hidden" name="room" value="<?php echo($room['id']); ?>" />
                <div class="header">
                    <h2>حذف "<?php echo($room['title']); ?>"</h2>
                </div>
                <div class="content tabbed">
                    <?php if (db::num('rooms') == 1) { ?>
                        <p style="text-align: center;color: red;">این تنها اتاق شماست!</p>
                        <center>
                            <button class="button blue flat block" onclick="window.location.href = '<?php echo(url('ref')); ?>';return false;">خیر!بازگرد</button>
                        </center>
                    <?php } elseif (!$defaultroom) { ?>
                        <p style="text-align: center;color: red;">آیا از حذف این اتاق مطمئن هستید؟</p>
                        <center>
                            <button class="button red flat block">بله حذف کن</button>
                            <button class="button blue flat block" onclick="window.location.href = '<?php echo(url('ref')); ?>';return false;">خیر!بازگرد</button>
                        </center>
                    <?php } else { ?>
                        <p style="text-align: center;color: red;">این اتاق پیش فرض است!امکان حذف وجود ندارد</p>
                        <center>
                            <button class="button blue flat block" onclick="window.location.href = '<?php echo(url('ref')); ?>';return false;">خیر!بازگرد</button>
                        </center>
                    <?php } ?>
                </div>

            </form>

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