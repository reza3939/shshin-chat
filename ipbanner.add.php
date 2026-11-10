<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    function add() {
        var $form = $('#formaddbann');
        var ip = $('input[name=ip]', $form).val();
        var ip2 = ip.split('.');
        if (ip2[0] == '*') {
            $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا یک ای پی معتبر وارد کنید'});
            return false;
        }
        if ((ip2[0] > 255) || ip2[0] == 0) {
            $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا یک ای پی معتبر وارد کنید'});
            return false;
        } else if ((ip2[1] != '' && ip2[1] > 255)) {
            $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا یک ای پی معتبر وارد کنید'});
            return false;
        }

        var data = {
            'token': '<?php echo(session('changepw')); ?>',
            'ip': ip,
            'date': $('#toban').val(),
        };
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.ipbanner.add')); ?>",
            data: data,
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        break;
                    case('repeat'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'این تحریم قبلا انجام شده است'});
                        break;
                    case('validip'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا یک آی پی معتبر وارد کنید'});
                        break;
                    case('date'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا تاریخ معتبری وارد کنید'});
                        break;
                    default:
                        alert(data);
                        break;
                }
            }
        });
    }
</script>
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
    <h1 class="grid_12 margin-top no-margin-top-phone">تحریم جدید</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formaddbann">
                <div class="header">
                    <h2>تحریم جدید</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>آی پی:</strong></label>
                        <div><input style="direction: ltr;padding-left: 30px;"  class="required"  autocomplete="off" type="text"  name="ip" value=""/></div>
                    </div>
                    <div class="row">
                        <label><strong>انقضا:</strong></label>
                        <div>
                            <select id="toban" class="search">
                                <option value="exit">لحظه ای</option>
                                <option value="1min">یک دقیقه</option>
                                <option value="30min">30 دقیقه</option>
                                <option value="1hour">1 ساعت</option>
                                <option value="12hour">12 ساعت</option>
                                <option value="1day">یک روز</option>
                                <option value="3day">3 روز</option>
                                <option value="1week">1 هفته</option>
                                <option value="2week">2 هفته</option>
                                <option value="1month">1 ماه</option>
                                <option value="6month">6 ماه</option>
                                <option value="1year">1 سال</option>
                                <option value="always">همیشه</option>
                            </select>
                        </div>
                    </div>
                    <?php
                    $ip = explode('.', $_SERVER["REMOTE_ADDR"]);
                    ?>
                    <p><b>توضیحات ای پی:</b></p>
                    <p>همه کامپیوتر هایی که متصل به اینترنت هستند دارای یک آی پی می باشد مانند: <span  class="badge badge-secondary"><?php echo(implode('.', $ip)); ?></span></p>
                    <p>ولکن کامپیوتر های عادی دارای آی پی متغیر هستند و این به معنای آن است که با هر بار اتصال به اینترنت دارای آی پی جدیدی میشوند</p>
                    <p>شما میتوانید در فیلد بالا یک آی پی خاص را وارد بکنید و یا تعدادی از آی پی ها را بلوک کنید.مثال ها:</p>
                    <p style="direction: ltr;"><span  class="badge badge-secondary"><?php echo(implode('.', $ip)); ?></span></p>
                    <p style="direction: ltr;"><span  class="badge badge-secondary"><?php echo(implode('.', array($ip[0], $ip[1], $ip[2])) . '.'); ?></span></p>
                    <p style="direction: ltr;"><span  class="badge badge-secondary"><?php echo(implode('.', array($ip[0], $ip[1])) . '.'); ?></span></p>
                    <p style="direction: ltr;"><span  class="badge badge-secondary"><?php echo(implode('.', array($ip[0])) . '.'); ?></span></p>
                </div>
            </form>
            <center> <button class="button blue flat block" onclick="add();">تحریم</button></center>
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