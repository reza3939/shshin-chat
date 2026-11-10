<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    function delete_link(link_id) {
        $('#link-' + link_id + ' td')[0].innerHTML = "لطفا صبر کنید...";
        $.ajax({
            url: '<?php echo(url('ajax/admin.links.del')); ?>',
            type: "POST",
            data: {link: link_id},
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'با موفقیت پیوند زوده شد'});
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
    <h1 class="grid_12 margin-top no-margin-top-phone">پیوند ها</h1>

    <div class="grid_12">
        <p style="text-align: center;"><a href="<?php echo(url('admin/links/add')); ?>"><button class="button grey block">پیوند جدید</button></a></p>

        <div class="box">
            <div class="header">
                <h2>
                    <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/sitemap.png')); ?>">
                    پیوند ها
                </h2>

            </div>
            <div class="content">
                <div class="tabletools">
                </div>
                <table class="styled" id="daynmic_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>آدرس</th>
                            <th>وضعیت</th>
                            <th>بازدید ها</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = db::query("SELECT `id`, `title`, `url`, `active`,`click` FROM {prefix}links");
                        while ($link = mysqli_fetch_array($query)) {
                            switch ($link['active']) {
                                case('1'):$link['active'] = 'فعال';
                                    break;
                                case('0'):$link['active'] = 'غیر فعال';
                                    break;
                            }
                            ?> 
                            <tr id="link-<?php echo($link['id']); ?>">
                                <td><?php echo($link['id']); ?></td>
                                <td>
                                    <a href="<?php echo(url("link/$link[0]/$link[1]")); ?>"><?php echo($link['title']); ?></a>
                                    <p class="line_p"><a href="<?php echo(url("admin/links/edit/$link[0]")); ?>">ويرايش</a> | <a style="font-size: smaller;" onclick="return delete_link('<?php echo($link['id']); ?>');" href="#">حذف</a></p>
                                </td>
                                <td><a href="<?php echo(url("link/$link[0]/$link[1]")); ?>" style="direction: ltr;"><?php echo($link['url']); ?></a></td>
                                <td><?php echo($link['active']); ?></td>
                                <td><?php echo($link['click']); ?> بار</td>
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