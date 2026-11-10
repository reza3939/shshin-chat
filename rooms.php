<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
<?php
$jquery = db::query("SELECT * FROM {prefix}rooms");
while ($jrow = mysqli_fetch_array($jquery)) {
    $jdecode = json_decode($jrow['vip_user'], true);
    if (!isset($jdecode['vip_user']))
        continue;
    ?>
        function info_vipuser_<?php echo $jrow['id']; ?>() {
            alert("مالک اتاق :‌ <?php echo Users::get('name', $jdecode['vip_user']); ?>\nدرجه : <?php echo Users::GetType(Users::get('type', $jdecode['vip_user'])); ?>\nدسترسی مدیریت‌ :‌ <?php echo $jdecode['is_admin'] == '1' ? 'دارد' : 'ندارد'; ?>\nتاریخ خرید‌ :‌ <?php echo jdate::start('l d F Y ساعت H:i:s', $jdecode['vip_time']); ?>");
        }
<?php } ?>
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
    <h1 class="grid_12 margin-top no-margin-top-phone">اتاق ها</h1>

    <div class="grid_12">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/balloons-box.png')); ?>">
                    اتاق ها
                </h2>
            </div>
            <div class="content">


                <p style="text-align: center;"><a href="../../../admin/rooms/add"><button class="button grey block">اتاق جدید</button></a></p>

                <div class="tabletools">
                </div>
                <table class="styled" id="daynmic_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 30%;">عنوان</th>
                            <th>حفاظت</th>
                            <th>تعداد افراد آنلاین</th>
                            <th>درجه های کاربری مجاز</th>
                            <th>ظرفیت اتاق</th>
                            <th>زمان انقضای اتاق</th>
                            <th>مالک اتاق</th>
                            <th>اتاق پیشفرش</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $x = 0;
                        $query = db::query("SELECT * FROM {prefix}rooms");
                        while ($row = mysqli_fetch_array($query)) {
                            $x++;
                            $procted = $row['password'] ? true : false;
                            $onlines = db::num('onlines', "`roomid`='$row[0]'");
                            $visualOnlines = db::num('onlines', "`roomid`='$row[0]' and `time`='0'");
                            $defualtroom = $options['chat_defaultroom'] == $row['id'] ? true : false;
                            $vip_user = json_decode($row['vip_user'], true);
                            $timeroomj = json_decode($row['timeroom'],true);
                            $timeroom = jdate::start('Y/m/d H:i:s', $timeroomj['time']);
                            $json = false;
                            if (isset($vip_user['vip_user']))
                                $json = true;
                            ?>
                            <tr id="room-<?php echo($row['id']); ?>">
                                <td><?php echo($x); ?></td>
                                <td>
                                    <a href="../../../admin/rooms/edit/<?php echo $row[0] ?>"><?php echo($row['title']); ?></a>
                                    <br />
                        <center><a href="../../../admin/rooms/edit/<?php echo $row[0] ?>">[ویرایش]</a>  <a href="../../../admin/rooms/delete/<?php echo $row[0]; ?>"><span>[حذف]</span></a></center>
                        </td>
                        <td align="center"><?php if ($procted) { ?><span class="badge block red">بلی</span><?php } else { ?><span class="badge block green">خیر</span><?php } ?></td>
                        <td><?php echo'<center><span class="badge block green">' . $onlines . ' نفر</span>'; ?><?php if ($visualOnlines > 0) echo('<span class="badge block red">' . $visualOnlines . ' کاربر مجازی</span>'); ?></td>
                        <td><?php
                                if ($row['type'] == 0) {
                                    echo '<center><span class="badge block green">همه کاربران</span></center>';
                                } else {
                                    $explode = explode(',', $row['type']);
                                    foreach ($explode as $expl) {
                                        if (isset($usertype[$expl]['title'])) echo '<span class="badge block red">' . $usertype[$expl]['title'] . '</span>';
                                    }
                                }
                                ?>
                        </td>
                        <td><?php
                                if ($row['capacity'] == 0) {
                                    echo '<span class="badge block green">نا محدود</span>';
                                } else {
                                    echo '<span class="badge block red">' . $row['capacity'] . ' نفر</span>';
                                }
                                ?></td>
                        <td><?php
                                if($timeroomj['time'] != "0" && $row['timeroom'] != ""){ 
                                    echo '<span class="badge block green">' .$timeroom. '</span>';
                                } else {
                                    echo '<span class="badge block red">غیرفعال</span>';
                                }
                                ?></td>
                        <td><?php
                                if ($json) {
                                    echo("<span class='badge block green'><a href='javascript:void(0);' onclick='info_vipuser_" . $row['id'] . "();'>برای دیدن اطلاعات کلیک کنید</a></span>");
                                } else {
                                    echo '<span class="badge block red">بدون مالک</span>';
                                }
                                ?></td>
                        <td align="center"><?php if ($defualtroom) { ?><span class="badge block blue dark">بلی</span><?php } else { ?><span class="badge block orange">خیر</span><?php } ?></td>
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