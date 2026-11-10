<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    function delete_link(link_id) {
        $('#link-' + link_id + ' td')[0].innerHTML = "لطفا صبر کنید...";
        $.ajax({
            url: '<?php echo(url('ajax/admin.pays.delete')); ?>',
            type: "POST",
            data: {link: link_id},
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'با موفقیت پاک شد'});
                        $('#link-' + link_id).slideUp(1000);
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
    <h1 class="grid_12 margin-top no-margin-top-phone">خرید های کاربران</h1>

    <div class="grid_12">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/sitemap.png')); ?>">
                    کل امتیازات خریداری شده <?php
                    $mquery = db::query("SELECT SUM(amount) FROM {prefix}pays WHERE `status`='1'");
                    while ($mrow = mysqli_fetch_array($mquery)) {
                        echo $mrow[0];
                    }
                    ?> تومان شده است
                </h2>

            </div>
            <div class="content">
                <div class="tabletools">
                </div>
                <table class="styled" id="daynmic_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>خریدار</th>
                            <th>مبلغ</th>
                            <th>وضعیت خرید</th>
                            <th>تاریخ</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = db::query("SELECT `id`, `user`, `amount`, `ref`, `date`,`status` FROM {prefix}pays order by id DESC");
                        while ($row = mysqli_fetch_array($query)) {
                            $sender = db::get('users', '`name`, `type`', "id='" . $link['sender_id'] . "'");
                            $reciver = db::get('users', '`name`, `type`', "id='" . $link['userid'] . "'");
                            foreach ($usertype as $type) {
                                if ($type['id'] == Users::get('type', $row['user'])) {
                                    $userid_type = $type['title'];
                                    break;
                                }
                            }
                            ?> 
                            <tr id="link-<?php echo($row['id']); ?>">
                                <td><?php echo($row['id']); ?></td>
                                <td><center><span class="badge block green"><?php echo Users::get('name', $row['user']); ?></span><span class="badge block blue"><?php echo($userid_type); ?></span></center></td>
                        <td><center><span class="badge block green"><?php echo(safe::number($row['amount'])); ?></span> تومان</center></td>
                        <td><center><?php
                            if ($row['status'] == 1)
                                echo '<span class="badge block green">موفق</span>';
                            else
                                echo '<span class="badge block red">ناموفق</span>';
                            ?></center></td>
                        <td><center><?php echo(jdate::start('تاریخ Y/m/d ساعت H:i:s', $row['date'])); ?></center></td>
                        <td><center><p class="line_p"><a style="font-size: smaller;" onclick="return delete_link('<?php echo($row['id']); ?>');" href="javascript:void(0);"><b>حذف</b></a></p></center></td>
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