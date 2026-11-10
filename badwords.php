<?php
include('header.php');
include('sidebar.php');
include ('inc/badwords.php');
?>
<script type="text/javascript">
    function adefault() {
        var data = {
            'token': '<?php echo(session('changepw')); ?>'
        };
        $.ajax({
            type: "POST",
            url: '<?php echo(url('ajax/admin.badwords.adefault')); ?>',
            data: data,
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        location.reload();
                        break;
                    case('no'):
                        $.msgGrowl({type: 'warning', title: 'نا موفق', text: 'افزودن کلمات پیش فرض فقط در صورت خالی بودن لیست کلمات زشت امکان پذیر است'});
                        break;
                    default:
                        $.msgGrowl({type: 'warning', text: 'پیام سرور'});
                        break;
                }
            }
        });
    }
    function deleteword(id) {
        $.ajax({
            type: "POST",
            url: '<?php echo(url('ajax/admin.badwords.delete')); ?>',
            data: {word: id, token: '<?php echo(session('changepw')); ?>'},
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        $('#word-' + id).slideUp(1000);
                        break;
                    default:
                        $.msgGrowl({type: 'warning', text: 'پیام سرور'});
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
    <h1 class="grid_12 margin-top no-margin-top-phone">کلمات زشت</h1>

    <div class="grid_12">
        <p style="text-align: center;"><a href="../../../admin/badwords/add"><button class="button grey block">افزودن  فیلتر</button></a><a href="javascript:adefault();" ><button class="button grey block" >افزودن کلمات زشت پیش فرض</button></a></p>
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/bug.png')); ?>">
                    کلمات زشت
                </h2>

            </div>
            <div class="content">
                <div class="tabletools">
                </div>
                <table class="styled" id="daynmic_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 50%;">کلمه</th>
                            <th>کلمه جایگزین</th>
                            <th>فیلتر در عمومی</th>
                            <th>فیلتر در خصوصی</th>
                            <th>فیلتر در پروفایل</th>
                            <th>فیلتر در پیام افلاین</th>
                            <th>خفه شدن خودکار (<small>در صورت فعال بودن از تنظیمات</small>)</th>
                            <th>گزارش تبلیغ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						if($badwords)
						$x = 0;
                        foreach ($badwords as $row) {
						$x++;
                            ?>
                            <tr id="word-<?php echo($row['id']); ?>">
                                <td><?php echo($x);										
                                  ?></td>
                                <td>
                                    <a href="../../../admin/badwords/edit/<?php echo $row['id']; ?>"><?php echo($row['word']); ?></a>
                                    <br />
                        <center><a href="../../../admin/badwords/edit/<?php echo $row['id']; ?>">[ویرایش]</a>  <a href="javascript:deleteword('<?php echo($row['id']); ?>');"><span>[حذف]</span></a></center>
                        </td>
                        <td><?php echo($row['replace']); ?></td>
                        <td align="center"><?php if ($row['general'] == '1') { ?><span class="badge block blue dark">بلی</span><?php } else { ?><span class="badge block orange">خیر</span><?php } ?></td>
                        <td align="center"><?php if ($row['private'] == '1') { ?><span class="badge block blue dark">بلی</span><?php } else { ?><span class="badge block orange">خیر</span><?php } ?></td>
                        <td align="center"><?php if ($row['profile'] == '1') { ?><span class="badge block blue dark">بلی</span><?php } else { ?><span class="badge block orange">خیر</span><?php } ?></td>
                        <td align="center"><?php if ($row['offlinemsg'] == '1') { ?><span class="badge block blue dark">بلی</span><?php } else { ?><span class="badge block orange">خیر</span><?php } ?></td>
                        <td align="center"><?php if ($row['silent'] == '1') { ?><span class="badge block blue dark">بلی</span><?php } else { ?><span class="badge block orange">خیر</span><?php } ?></td>
                        <td align="center"><?php if ($row['tablighat'] == '1') { ?><span class="badge block blue dark">بلی</span><?php } else { ?><span class="badge block orange">خیر</span><?php } ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
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