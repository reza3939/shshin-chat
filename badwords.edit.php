<?php
include('header.php');
include('sidebar.php');
include ('inc/badwords.php');
$word = safe::number(giu('el4'));
foreach ($badwords as $badword) {
	if($badword['id'] != $word){ 
		 continue;
	}
    elseif ($badword['id'] == $word){ 
		$words = array('id' => $badword['id'], 'word' => $badword['word'], 'replace' => $badword['replace'], 'general' => $badword['general'], 'private' => $badword['private'], 'profile' => $badword['profile'],'silent' => $badword['silent'], 'offlinemsg' => $badword['offlinemsg'], 'tablighat' => $badword['tablighat']);
	}
}
?>
<script type="text/javascript">
    function edit() {
        var $form = $('#formeditword');
        var data = {
            'token': '<?php echo(session('changepw')); ?>',
            'id': '<?php echo($words['id']); ?>',
            'word': $('input[name=word]', $form).val(),
            'replace': $('input[name=replace]', $form).val(),
            'general': $('input[name=general]', $form).prop('checked'),
            'private': $('input[name=private]', $form).prop('checked'),
            'profile': $('input[name=profile]', $form).prop('checked'),
            'silent': $('input[name=silent]', $form).prop('checked'),	
            'robo_tablighat': $('input[name=robo_tablighat]', $form).prop('checked'),
            'robo_cleaner': $('input[name=robo_cleaner]', $form).prop('checked')
        };
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.badwords.edit')); ?>",
            data: data,
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        break;
                    case('word'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا یک کلمه برای فیلتر وارد کنید'});
                        break;
                    case('replace'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا یک کلمه برای جایگزاری وارد کنید'});
                        break;
                    case('repeatword'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'این کلمه قبلا وارد شده است'});
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
    <h1 class="grid_12 margin-top no-margin-top-phone">ویرایش کلمه زشت</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formeditword">
                <div class="header">
                    <h2>ویرایش "<?php echo($words['word']); ?>"</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>کلمه زشت:</strong></label>
                        <div><input type="text" name="word" class="required" value="<?php echo($words['word']); ?>"/></div>
                    </div>
                    <div class="row">
                        <label><strong>جایگزین:</strong></label>
                        <div><input type="text" name="replace" class="required" value="<?php echo($words['replace']); ?>"/></div>
                    </div>
                    <div class="row">
                        <label><strong>فیلتر در عمومی:</strong></label>
                        <div>
                            <input type="checkbox" name="general" value="1" <?php if ($words['general'] == '1') echo('checked'); ?> />

                        </div>
                    </div>
                    <div class="row">
                        <label><strong>فیلتر در خصوصی:</strong></label>
                        <div>
                            <input type="checkbox" name="private" value="1" <?php if ($words['private'] == '1') echo('checked'); ?> />

                        </div>
                    </div> 
                    <div class="row">
                        <label><strong>فیلتر در پروفایل:</strong></label>
                        <div>
                            <input type="checkbox" name="profile" value="1" <?php if ($words['profile'] == '1') echo('checked'); ?> />

                        </div>
                    </div>
                        <div class="row">
                        <label><strong>خفه شدن خودکار:</strong></label>
                        <div>
                            <input type="checkbox" name="silent" value="1" <?php if ($words['silent'] == '1') echo('checked'); ?> />

                        </div>
                    </div>
                    <div class="row">
                        <label><strong>فیلتر در پیام افلاین:</strong></label>
                        <div>
                            <input type="checkbox" name="robo_cleaner" value="1" <?php if ($words['offlinemsg'] == '1') echo('checked'); ?> />
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>گزارش تبلیغ توسط ربات:</strong></label>
                        <div>
                            <input type="checkbox" name="robo_tablighat" value="1" <?php if ($words['tablighat'] == '1') echo('checked'); ?> />
                        </div>
                    </div>
                </div>
            </form>
            <center> <button class="button blue flat block" onclick="edit();">ویرایش</button></center>
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