<?php
$cp_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cp_save'])) {
    $cp_uid = isset($_POST['user']) ? safe::number($_POST['user']) : 0;
    if (!$cp_uid || db::num('users', "`id`='$cp_uid'") < 1) {
        $cp_msg = 'کاربر را انتخاب نکرده‌اید.';
    } elseif (db::num('adminpanel', "`user`='$cp_uid'") > 0) {
        $cp_msg = 'دسترسی این کاربر قبلاً ساخته شده است.';
    } elseif (empty($_POST['password'])) {
        $cp_msg = 'رمز جداگانه را وارد کنید.';
    } else {
        $cp_all = isset($_POST['typepermission']) && $_POST['typepermission'] == 'all';
        $cp_perm = '';
        if (!$cp_all) {
            $cp_valid = array_flip(array_keys(adminpanel::$Permissions));
            $cp_sel = isset($_POST['permissions']) && is_array($_POST['permissions']) ? $_POST['permissions'] : array();
            foreach ($cp_sel as $p) {
                $p = safe::string($p);
                if (isset($cp_valid[$p])) {
                    $cp_perm .= ($cp_perm == '' ? '' : ',') . $p;
                }
            }
            if ($cp_perm == '') {
                $cp_msg = 'چیزی را به جعبه‌ی سمت چپ منتقل نکرده‌اید.';
            }
        }
        if ($cp_msg == '') {
            $_POST['permission'] = $cp_all ? 'all' : $cp_perm;
            ob_start();
            include('pages/ajax/admin.adminpanel.add.php');
            $cp_raw = trim(ob_get_clean());
            if (db::num('adminpanel', "`user`='$cp_uid'") > 0) {
                $cp_msg = 'ok';
            } else {
                $cp_msg = 'ذخیره نشد. پیام سرور: ' . ($cp_raw !== '' ? $cp_raw : 'خطای ناشناخته');
            }
        }
    }
}

include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
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
        $('#formaddadmin').on('submit', function () {
            var $sel = $('#permissions');
            if (!$sel.length || $('.dualselect').length == 0) {
                return;
            }
            $sel.find('option').prop('selected', false);
            $('.dualselect .right select option').each(function () {
                var $name = $(this).attr('name');
                if ($name) {
                    $sel.find('option[name="' + $name + '"]').prop('selected', true);
                }
            });
        });
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
    <h1 class="grid_12 margin-top no-margin-top-phone">افزودن دسترسی</h1>
    <div class="grid_12">
        <div class="grid_12">
            <?php if ($cp_msg != '') { ?>
            <div style="direction:rtl;padding:10px 14px;margin:0 0 10px;border-radius:6px;font-size:14px;font-weight:700;<?php echo($cp_msg == 'ok' ? 'background:#d1fae5;color:#065f46' : 'background:#fee2e2;color:#991b1b'); ?>">
                <?php if ($cp_msg == 'ok') { ?>
                ذخیره شد.
                <a style="margin-right:14px;color:#1d4ed8;font-weight:400" href="<?php echo(url('admin/adminpanel')); ?>">رفتن به فهرست دسترسی‌ها</a>
                <?php } else { echo($cp_msg); } ?>
            </div>
            <?php } ?>
            <form class="box" id="formaddadmin" method="post" action="<?php echo(url('admin/adminpanel/add')); ?>">
                <input type="hidden" name="token" value="<?php echo(session('changepw')); ?>">
                <div class="header">
                    <h2>افزودن دسترسی</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>کاربر:</strong></label>
                        <div>
                            <select name="user" class="search">
                                <?php
                                $admins = implode(',', Users::AdminsType());
                                $query = db::query("SELECT `id`, `username`, `name` FROM {prefix}users WHERE `type` IN ($admins) ORDER BY `type` DESC");
                                while ($user = mysqli_fetch_array($query)) {
                                    if (db::num('adminpanel', "`user`='{$user['id']}'") > 0)
                                        continue;
                                    ?>
                                    <option value="<?php echo($user['id']); ?>"> <?php echo($user['name'] . ' => ' . $user['username']); ?></option>
                                    <?php
                                }
                                mysqli_free_result($query);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>رمز جداگانه:</strong></label>
                        <div><input id="password" type="password" name="password" value=""></div>
                    </div>
                    <div class="row">
                        <label><strong>دسترسی ها:</strong></label>
                        <div>
                            همه دسترسی ها: <input class="radiobutton" type="radio" name="typepermission" value="all" />
                            <br />
                            سفارشی: <input class="radiobutton" type="radio" name="typepermission" value="custom" checked />
                            <br />
                            <div id="customList">
                                <select multiple class="dualselects" data-size="small" id="permissions" name="permissions[]">
                                    <?php
                                    foreach (adminpanel::$Permissions as $permission => $name) {
                                        ?>
                                        <option value="<?php echo($permission); ?>" name="<?php echo($permission); ?>"><?php echo($name); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <center style="padding:12px"> <input type="submit" name="cp_save" class="button blue flat block" value="اضافه کردن" /> </center>
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
