<?php
include('header.php');
include('sidebar.php');
$page = safe::number($el3) ? ((int) safe::number($el3)) : 1;
if ($page == 1) {
    $startpage = 0;
} else {
    $startpage = ($page - 1) * 20;
}
?>
<script type="text/javascript">
    function changepage(elem) {
        window.location.href = '<?php echo(url('admin/sendedimagess/\'+elem.value+\'')); ?>';
    }
    function delete_link(link_id) {
        $('#link-' + link_id + ' td')[0].innerHTML = "حذف شد...";
        $.ajax({
            url: '<?php echo(url('ajax/admin.sendedimages.del')); ?>',
            type: "POST",
            data: {link: link_id},
            success: function (data) {
                switch (data) {
                case('ok'):$.jGrowl('ذخیره شد', { header: 'موفقیت آمیز' });break;
                case('emailpattern'):$.jGrowl('لطفا یک ایمیل معتبر وارد کنید', { header: 'خطا' });break;
                case('emailrepeat'):$.jGrowl('این ایمیل مطعلق به کاربر دیگری است', { header: 'خطا' });break;
                case('nullusername'):$.jGrowl('پر کردن نام کاربری اجباری است', { header: 'خطا' });break;
                case('lenusername'):$.jGrowl('تعداد حروف نام کاربری بیش از حد تعیین شده است', { header: 'خطا' });break;
                case('lenname'):$.jGrowl('تعداد حروف نام نمایشی بیش از حد تعیین شده است', { header: 'خطا' });break;
                case('guest'):$.jGrowl('امکان حذف سطح کاربری مهمان وجود ندارد', { header: 'خطا' });break;
                case('admin'):$.jGrowl('وجود حداقل یک سطح مدیریت کامل لازم است', { header: 'خطا' });break;
                case('totype'):$.jGrowl('گروه جایگزین صحیح نیست', { header: 'خطا' });break;
                case('id'):$.jGrowl('این سطح کاربری وجود ندارد . ممکن است قبلا حذف شده باشد یا ساخته نشده باشد.', { header: 'خطا' });break;
                case('title'):$.jGrowl('لطفا عنوان درستی وارد کنید', { header: 'خطا' });break;
                case('url'):$.jGrowl('لطفا یک آدرس معتبر وارد کنید', { header: 'خطا' });break;
                case('repeat'):$.jGrowl('این لینک قبلا ثبت شده', { header: 'خطا' });break;
                case('page'):$.jGrowl('لطفا صفحه کد را مشخص کنید', { header: 'خطا' });break;
                case('location'):$.jGrowl('مکان کد مشخص نشده', { header: 'خطا' });break;
                case('emptypw'):$.jGrowl('رمز جداگانه اختصاص داده نشده است', { header: 'خطا' });break;
                case('capacity-page'):$.jGrowl('ظرفیت صفحه برای این نوع تبلیغ پر است', { header: 'خطا' });break;
                case('user'):$.jGrowl('این کاربر وجود ندارد', { header: 'خطا' });break;
                case('emptytext'):$.jGrowl('لطفا متنی را وارد کنید', { header: 'خطا' });break;
                case('text'):$.jGrowl('لطفا متنی را وارد کنید', { header: 'خطا' });break;
                case('question'):$.jGrowl('لطفا سوال را وارد کنید', { header: 'خطا' });break;
                case('repeatquest'):$.jGrowl('این متن دریافتی قبلا وارد شده', { header: 'خطا' });break;
                case('answer'):$.jGrowl('لطفا پاسخی را وارد کنید', { header: 'خطا' });break;
                case('type'):$.jGrowl('لطفا نوع را انتخاب کنید', { header: 'خطا' });break;
                case('security'):$.jGrowl('سرور در فایل شما مورد امنیتی پیدا کرد', { header: 'خطا' });break;
                case('repeatname'):$.jGrowl('این نام ویژه قبلا ثبت شده', { header: 'خطا' });break;
                case('capacity-location'):$.jGrowl('ظرفیت این موقعیت برای این نوع تبلیغ پر است', { header: 'خطا' });break;
                case('noadminstrator'):$.jGrowl('سطح کاربری این کاربر لازم نیست', { header: 'خطا' });break;
                case('repeatuser'):$.jGrowl('دسترسی این کاربر قبلا ساخته شده است', { header: 'خطا' });break;
                case('word'):$.jGrowl('لطفا يک کلمه براي فيلتر وارد کنيد', { header: 'خطا' });break;
                case('replace'):$.jGrowl('لطفا يک کلمه براي جايگزاري وارد کنيد', { header: 'خطا' });break;
                case('repeatword'):$.jGrowl('اين کلمه قبلا وارد شده است', { header: 'خطا' });break;
                case('nouser'):$.jGrowl('این کاربر وجود ندارد', { header: 'خطا' });break;
                default:alert(data);break;
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
    <h1 class="grid_12 margin-top no-margin-top-phone">فایل های ارسال شده در عمومی</h1>
    <div class="grid_12">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/sitemap.png')); ?>">
                    اطلاعات
                </h2>
            </div>
            <div class="content">
                <p>
                    صفحه:<select onchange="changepage(this);" class="search">
                        <?php
                        $num = db::num('sendedimages');
                        $msgshostory = 20;
                        $totalpages = ceil($num / $msgshostory);
                        $x = 0;
                        while ($x < $totalpages) {
                            $nextpage = $x + 1;
                            $x++;
                            $num -= $msgshostory;
                            if ($nextpage == $page) {
                                $selected = " selected=\"selected\"";
                            } else {
                                $selected = "";
                            }
                            echo("<option$selected>$nextpage</option>");
                        }
                        if ($x == 0) {
                            echo("<option>1</option>");
                        }
                        ?>
                    </select>
                </p>
                <div class="tabletools">
                </div>
                <table class="styled" id="daynmic_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>فرستنده</th>

                            <th>آدرس فایل</th>
                            <th>تصویر</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = db::query("SELECT * FROM {prefix}sendedimages LIMIT $startpage,$msgshostory");
                        while ($link = mysqli_fetch_array($query)) {
                        if(empty(Users::get('type', $link['userid']))){
                            $sender_type = Users::get('type', $link['sender_id']);
                            $filename = Users::get('type', $link['filename']);
                            $reciver_type = Users::get('type', $link['userid']);
                            $cf = $link['into'] == 'cf' ? 'اتاق کنفرانس ' : '';
                            ?> 

                            <tr id="link-<?php echo($link['id']); ?>">
                                <td><?php echo($link['id']); ?></td>
                                <td><center><b><font color="<?php echo $usertype[$sender_type]['color'] ?>"><?php echo(Users::get('name', $link['sender_id'])); ?></font></b> <img src="<?php echo url('theme/images/user-types/' . $sender_type . '.png'); ?>"></center></td>

                        <td><center><?php echo('<a target="_blank" href="/theme/sendedimages/' . $link['filename'] . '">کلیک کنید</a>'); ?></center></td>
                        <td><center><?php echo('<img style="width:100px;height:100px;" src="/theme/sendedimages/' . $link['filename'] . '">'); ?></center></td>
                        <td><center><p class="line_p"><a style="font-size: smaller;" onclick="return delete_link('<?php echo($link['id']); ?>');" href="javascript:void(0);"><b>حذف</b></a></p></center></td>
                        </tr>
                        <?php
                    }}
                    mysqli_free_result($query);
                    ?>
                    </tbody>
                </table>
                <div class="tabletools">
                </div>
                <br>
                <center style="direction:rtl">
                    <?php
                    $num = db::num('sendedimages');
                    $msgshostory = 20;
                    $totalpages = ceil($num / $msgshostory);
                    $x = 0;
                    while ($x < $totalpages) {
                        $nextpage = $x + 1;
                        $x++;
                        $num -= $msgshostory;
                        if ($nextpage == $page) {
                            $selected = "class=\"paginate_active\"";
                        } else {
                            $selected = "";
                        }
                        echo("<div id=\"DataTables_Table_0_paginate\" class=\"dataTables_paginate paging_full_numbers\"><span><a  $selected href=\"../../admin/sendedimagess/$nextpage\" class=\"paginate_button\">$nextpage</a></span></div>");
                    }
                    if ($x == 0) {
                        echo("<span>1</span>");
                    }
                    ?>
                </center>
                <br>
                <div class="tabletools">
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