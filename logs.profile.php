<?php
include('header.php');
include('sidebar.php');
include('inc/classes/bbcode.php');
include('inc/classes/profile.php');
$page = safe::number($el3) ? ((int) safe::number($el3)) : 1;
if ($page == 1) {
    $startpage = 0;
} else {
    $startpage = ($page - 1) * 20;
}
?>

<script>
    function changepage(elem) {
        window.location.href = '<?php echo(url('admin/logs/profile/\'+elem.value+\'')); ?>';
    }
    function delete_postid(id) {
        if (!id)
            return false;
        //alert(id);
        $.ajax({
            type: "POST",
            url: '<?php echo(url('ajax/admin.logs.profile.post')); ?>',
            data: {postid: id},
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.jGrowl('حذف شد', {header: 'موفقیت آمیز'});
                        $('#postid-' + id).slideUp(1000);
                        break;
                    case('id'):
                        $.jGrowl('این پست وجود ندارد', {header: 'موفقیت آمیز'});
                        $('#postid-' + id).slideUp(1000);
                        break;
                    default:
                        $.jGrowl(data, {header: 'پیام سرور:'});
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
    <h1 class="grid_12 margin-top no-margin-top-phone">آمارگیر</h1>

    <div class="grid_12">
        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/calendar-select.png')); ?>">
                    پست های پروفایل
                </h2>
            </div>
            <div class="content">
                <p >
                    صفحه:<select onchange="changepage(this);" class="search">
                        <?php
                        $num = db::num('profile_posts');
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
                <ul class="searchresults grid_12">
                    <?php
                    $el4--;
                    $query = db::query("SELECT `{prefix}profile_posts`.`id`,pr.`avatar`,`{prefix}profile_posts`.`userid`,`{prefix}profile_posts`.`content`,`{prefix}profile_posts`.`time`,`{prefix}users`.`name` FROM `{prefix}profile_posts` INNER JOIN `{prefix}users` ON `{prefix}users`.`id` = `userid` LEFT JOIN {prefix}profiles pr ON pr.`id` = `{prefix}profile_posts`.`userid` ORDER BY `{prefix}profile_posts`.`id` LIMIT $startpage,$msgshostory");

                    while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <li id="post-<?= $row['id']; ?>">
                            <div class="header">
                       
                                 <p>  <a style="color:red;" href="<?= url("admin/users/edit/{$row['userid']}"); ?>"><?=$row['name'];?></a>&nbsp;در<?= jdate::start('l d F Y ساعت H:i:s', $row['time']) ?>&nbsp;نوشت:</p>
                   </div>
                            <div class="content">
                                <div class="left">							
                                   
                                    <p>                                    
                                        <a data-post="<?= $row['id']; ?>" class="action post-delete" href="javascript:delete_postid('<?php echo($row['id']); ?>');"><span class="tooltip icon-ban-circle" original-title="حذف"></span></a>
                                    </p>
                                </div>
                                <div align="center">

                                    <p><?php echo bbcode::tohtml($row['content'], true); ?></p>

                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
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