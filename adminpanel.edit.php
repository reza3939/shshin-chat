<?php
include('header.php');
include('sidebar.php');
$admin = safe::number(giu('el4'));
$admin = db::get('adminpanel', "*", "`id`='$admin'");
if (!$admin) {
    include('pages/notfound.php');
    return;
}
?>
<script type="text/javascript">
    var proccted = '';
    function edit() {
        var $permission = '';
        var $typepermission = $('input[name=typepermission]:checked').val();
        if ($typepermission == 'all') {
            $permission = 'all';
        } else {
            var $options = $('.dualselect .right select option');
            $permission = '';
            for (i = 0; i != $options.length; i++) {
                if ($permission != '')
                    $permission += ',';
                $permission += $($options[i]).attr('name');
            }
        }
        var $form = $('#formeditadmin');
        var data = {
            'token': '<?php echo(session('changepw')); ?>',
            'id': '<?php echo($admin['id']); ?>',
            'password': $('input[name=password]', $form).val(),
            'user': $('select[name=user]', $form).val(),
            'permission': $permission
        };
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.adminpanel.edit')); ?>",
            data: data,
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'ذخیره شد', text: 'موفقیت آمیز'});
                        break;
                    case('id'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'درخواست اشتباه'});
                        break;
                    case('user'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'این کاربر وجود نداره'});
                        break;
                    case('emptypw'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'رمز جداگانه اختصاص داده نشده است'});
                        break;
                    case('noadminstrator'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'سطح کاربری این کاربر لازم نیست'});
                        break;
                    case('noadminstrator'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'سطح کاربری این کاربر لازم نیست'});
                        break;
                    default:
                        alert(data);
                        break;
                }
            }
        });
    }

    $(document).ready(function () {
        $('.radiobutton').click(function () {
            var $val = $('input[name=typepermission]:checked').val();
            if ($val == 'all') {
                $('#customList').slideUp(1000);
            } else {
                $('#customList').slideDown(1000);
            }
        });
        var $val = $('input[name=typepermission]:checked').val();
        if ($val == 'all') {
            $('#customList').slideUp(1000);
        } else {
            $('#customList').slideDown(1000);
        }
    });
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
    <h1 class="grid_12 margin-top no-margin-top-phone">ویرایش دسترسی ها</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formeditadmin">
                <div class="header">
                    <h2>ویرایش دسترسی "<?php echo(Users::get('username', $admin['user'])); ?>"</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>کاربر:</strong></label>
                        <div>

                            <select name="user" class="search">
                                <?php
                                $query = db::query("SELECT `id`, `username`,`name` FROM {prefix}users WHERE `type` IN (" . implode(',', Users::AdminsType()) . ") ORDER BY `id` ASC");
                                while ($user = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?php echo($user['id']); ?>" <?php if ($user['id'] == $admin['user']) echo('selected="selected"'); ?>> <?php echo($user['name'] . ' => ' . $user['username']); ?></option>
                                    <?php
                                }
                                mysqli_free_result($query);
                                ?>
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <label><strong>رمز جداگانه:</strong></label>
                        <div><input id="password" type="password" name="password" value="<?php if (!safe::is_md5($admin['password'])) echo(base64_decode($admin['password'])); ?>"></div>
                    </div>
                    <div class="row">
                        <label><strong>دسترسی ها:</strong></label>
                        <div>
                            همه دسترسی ها: <input type="radio" name="typepermission" value="all"  <?php if ($admin['permissions'] == 'all') echo('checked'); ?> />
                            <br />
                            سفارشی: <input type="radio" name="typepermission" value="custom" <?php if ($admin['permissions'] != 'all') echo('checked'); ?>  />
                            <br />
                            <div id="customList">
                                <select multiple class="dualselects" data-size="small" id="permissions">
                                    <?php
                                    $permissions = explode(',', $admin['permissions']);
                                    foreach (adminpanel::$Permissions as $permission => $name) {
                                        ?>
                                        <option <?php if (in_array($permission, $permissions)) echo('selected'); ?> name="<?php echo($permission); ?>"><?php echo($name); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <center> <input type="submit" name="btn" class="button blue flat block" onclick="edit();" value="ویرایش" /> </center>
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