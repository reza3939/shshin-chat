<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    function deleteban(id) {
        $.ajax({
            type: "POST",
            url: '<?php echo(url('ajax/admin.ipbanner.delete')); ?>',
            data: {id: id},
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'با موفقیت تحریم لغو شد'});
                        $('#ip-' + id).slideUp(1000);
                        break;
                    default:
                        alert('پیام سرور:' + data);
                        alert('پیام سرور:' + data);
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
	<h1 class="grid_12 margin-top no-margin-top-phone">تحریم آی پی</h1>
    <div class="grid_12">
     <p style="text-align: center;"><a href="<?php echo(url('admin/ipbanner/add')); ?>"><button class="button grey block">تحریم جدید</button></a></p>
		
		<div class="box">
			<div class="header">
				<h2>
					<img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/user-business-boss.png')); ?>">
					تحریم آی پی
				</h2>
                
			</div>
            <div class="content">
                <div class="tabletools">
                </div>
                <table class="styled" id="daynmic_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 25%;">آی پی</th>
                            <th>زمان تحریم</th>
                            <th>انقضا</th>
                            <th>تحریم گر</th>
                            <th>کاربر تحریم شده</th>
                            <th>دلیل</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = db::query("SELECT * FROM {prefix}banns ORDER BY `date` DESC ");
                        while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <tr id="ip-<?php echo($row['id']); ?>">
                                <td><?php echo($row['id']); ?></td>
                                <td><p  style="direction: ltr;"><?php echo($row['ip']); ?></p><a href="javascript:deleteban('<?php echo($row['id']); ?>');">[حذف]</a></td>					
                                <td><?php echo(jdate::start('l d F Y', $row['date'])); ?></td>
                                <td><?php echo($row['to'] == '0' ? 'همیشگی' : jdate::start('l d F Y ساعت H:i:s', $row['to'])); ?></td>
                                <td><?php
                                        if ($row['author'] == '-1') {
                                            echo 'سیستم به صورت هوشمند';
                                        } else {
                                            echo(Users::get('name', $row['author']));
                                        }
                                        ?></td>
                                <td><?php echo($row['user'] == null ? 'همه' : Users::get('name', $row['user'])); ?>
                                <br><a href="../../../admin/users/edit/<?=$row['user'];?>" target="_blank">[ویرایش این کاربر]</a>
                                <br><a href="../../../admin/msgreader/<?=$row['user'];?>" target="_blank">[خواندن خصوصی این کاربر]</a>
                                </td>
                                <td><?php echo($row['reason']); ?></td>
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