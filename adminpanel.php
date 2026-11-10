<?php include('header.php');include('sidebar.php');?>
<script type="text/javascript">
    function deleterow(id) {
        $.ajax({
            type: "POST",
            url: '<?php echo(url('ajax/admin.adminpanel.delete')); ?>',
            data: {id: id, token: '<?php echo(session('changepw')); ?>'},
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'باموفقیت دسترسی این کاربر به پنل مدیریت قطع شد'});
                        $('#admin-' + id).slideUp(1000);
                        break;
                    default:
                        alert('پیام سرور:' + data);
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

    <h1 class="grid_12 margin-top no-margin-top-phone">پنل مدیریت</h1>
    <div class="grid_12">
        <p style="text-align: center;"><a href="../../../admin/adminpanel/add"><button class="button grey block">افزودن  دسترسی</button></a></p>

        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/user-business-boss.png')); ?>">
                    پنل مدیریت
                </h2>
            </div>
            <div class="content">
                <div class="tabletools">
                </div>
                <table class="styled" id="daynmic_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کاربری</th>
                            <th>درجه</th>
                            <th>دسترسی ها</th>
                            <th>کلمه عبور جداگانه</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = db::query("SELECT a.*,u.`name`,u.`username`,u.`type` FROM {prefix}adminpanel a LEFT JOIN {prefix}users u ON u.`id` = a.`user`");
                        while ($row = mysqli_fetch_array($query)) {
                            if (session('id') != '1' && $row['user'] == '1') {
                                continue;
                            }
                            ?>
                            <tr id="admin-<?php echo($row['id']); ?>">
                                <td align="center"><?php echo($row['id']); ?></td>
                                <td>
                                    <a href="../../../admin/users/edit/<?php echo $row['user']; ?>"><?php echo($row['name'] . ' => ' . $row['username']); ?></a>
                                    <br />
                        <center><a href="../../../admin/adminpanel/edit/<?php echo $row['id']; ?>"><span style="font-size: 10px;">[ویرایش دسترسی ها]</span></a>  <a href="javascript:deleterow('<?php echo($row['id']); ?>');"><span style="font-size: 10px;">[حذف]</span></a></center>
                        </td>
                        <td align="center"><img src="/<?php echo $usertype[$row['type']]['icon']; ?>"></td>
                        <td align="center"><?php echo($row['permissions'] != 'all' ? '<span class="badge block red">ناقص</span>' : '<span class="badge block green">کامل</span>'); ?></td>
                        <td align="center"><?php if ($row['password']) { ?><span class="badge block blue dark">بلی</span><?php } else { ?><span class="badge block orange">خیر</span><?php } ?></td>
                        </tr>
                        <?php
                    }
                    mysqli_free_result($query);
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