<?php
include('header.php');
include('sidebar.php');

$page = safe::number($el3) ? ((int)safe::number($el3)) : 1;
if($page == 1)$startpage=0;else $startpage = ($page-1)*50;
?>
<script type="text/javascript">
function changepage(elem){
    window.location.href = '<?php echo(url('admin/avatars/\'+elem.value+\'')); ?>';
}
function delete_avatar(id){
	if ( !id ) return false;
	//alert(id);
    $.ajax({
        type:"POST",
        url:'<?php echo(url('ajax/admin.avatars.delete')); ?>',
        data:{avatar:id},
        success: function(data){
            switch(data){
                case('ok'):$.jGrowl('&#1581;&#1584;&#1601; &#1588;&#1583;', { header: '&#1605;&#1608;&#1601;&#1602;&#1740;&#1578; &#1570;&#1605;&#1740;&#1586;' });$('#avatar-'+id).slideUp(1000);break;
                default:$.jGrowl(data, { header: '&#1662;&#1740;&#1575;&#1605; &#1587;&#1585;&#1608;&#1585;:' });break;
            }
        }
    });
}
function delavatar(request){
 $.ajax({
        url:'<?php echo(url("ajax/admin.avatars.delava")); ?>', 
        type:"POST",
        data:{action:request,token:'<?php echo(session('changepw')); ?>'},
        success: function(data){
            switch(data){
                case('ok'):$.jGrowl('همه ی آواتار های پیشفرض حذف شدند!', { header: 'موفقیت آمیز' });break;
                default:$.jGrowl(data, { header: 'پاسخ سرور:' });break;
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
	<h1 class="grid_12 margin-top no-margin-top-phone">&#1570;&#1608;&#1575;&#1578;&#1575;&#1585; &#1607;&#1575;</h1>
    
    <div class="grid_12">
    <p style="text-align: center;"><a href="<?php echo(url('admin/avatars/add')); ?>"><button class="button grey block">افزودن آواتار</button></a><a href="javascript:delavatar('delavatars');"><button class="button grey block">حذف همه آواتار ها</button></a></p>
		<div class="box">
			<div class="header">
				<h2>
					<img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/animal.png')); ?>">
					&#1570;&#1608;&#1575;&#1578;&#1575;&#1585; &#1607;&#1575;
				</h2>
                
			</div>
			<div class="content">
            <p >
                &#1589;&#1601;&#1581;&#1607;:<select onchange="changepage(this);" class="search">
                <?php
                $num = $sql->getValue('avatars', 'count(*)');
                $msgshostory = 50;
                $totalpages = ceil($num / $msgshostory);
                $x=0;
                while($x < $totalpages ){
                    $nextpage = $x+1;
                    $x++;
                    $num -= $msgshostory;
                    if($nextpage == $page){$selected = " selected=\"selected\"";}else{ $selected = "";}
                    echo("<option$selected>$nextpage</option>");
                }
                if($x == 0){echo("<option>1</option>");}
                ?>
                </select>
                </p>
				<div class="tabletools">
				</div>
				<table class="styled" id="daynmic_table">
					<thead>
						<tr>
							<th>#</th>
                            <th>&#1606;&#1575;&#1605;</th>
                            <th>&#1578;&#1589;&#1608;&#1740;&#1585;</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $query = $sql->get('avatars', array(($page - 1) * $msgshostory, $msgshostory));
foreach ($query as $row) {
                    ?>
					<tr id="avatar-<?php echo($row['id']); ?>">
                        <td><?php echo($row['id']); ?></td>
                        <td>
                       <?php echo($row['name']); ?>
                        <br />
                        <center>
							
							<a href="javascript:delete_avatar('<?php echo($row['id']); ?>');"><span style="font-size: 10px;">[&#1581;&#1584;&#1601;]</span></a>
						</center>
                        </td>
                        <td align="center"><img style="width:50px;height:50px;cursor:pointer;border:5px #eee solid;border-radius:100px;" src="<?php echo url('theme/images/avatars/'.$row['image']); ?>" /></td>
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