<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('.image .removeavatar').click(function(e){
            if($(this).attr('disabled') != 'true'){
                $(this).attr('disabled', 'true');
                var $img = $(this).parents('.image');
                $user = $img.attr('data-user');
                $.ajax({
                    url:'/ajax/admin.logs.cover',
                    type:'post',
                    data:{user:$user,action:'delete'},
                    dataType:'json',
                    success:function(data){
                        $(this).attr('disabled', 'false');
                        if(data.status){
                            $('img', $img).parent().parent().remove();
                            $.jGrowl('حذف شد', { header: 'موفقیت آمیز' });
                        }else{
                            switch(data.error){
                                case('login'):
                                    $.jGrowl('لطفا وارد سیستم شوید', { header: 'خطا' });
                                    break;
                                case('permission'):
                                    $.jGrowl('لطفا وارد سیستم شوید', { header: 'خطا' });
                                    break;
                                case('profile'):
                                    $.jGrowl('کاربر منتخب، معتبر نیست', { header: 'خطا' });
                                    break;
                                case('action'):
                                    $.jGrowl('درخواست معتبر نیست', { header: 'خطا' });
                                    break;
                                case('unexpectederror'):
                                    $.jGrowl('خطای غیر منتظره ای رخ داد', { header: 'خطا' });
                                    break;
                                default:
                                    $.jGrowl('خطای غیر منتظره ای رخ داد', { header: 'خطا' });
                                    break;
                            }
                        }
                    },
                    error:function(){
                        $(this).attr('disabled', 'false');
                        $.jGrowl('خطای غیر منتظره ای رخ داد', { header: 'خطا' });
                    }
                });
            }
        });
    });
    function changepage(elem){
        window.location.href = '/admin/logs/cover/'+elem.value+'';
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
<section class="container_12 clearfix" id="content">
    <div class="grid_12">
        <div class="box">
            <div class="header">
                <h2>مشاهده لیست جلد ها</h2>
            </div>
            <div class="content">
                <p>
                    صفحه:
                    <select class="search" onchange="changepage(this);">
                        <?php
                            $el4 = giu('el4');
                            $el4=safe::number($el4);
                            if($el4=='' || $el4<1){
                                $el4=1;
                            }
                            $count=db::num('profiles',"`cover`!=''");
                            for($i=1;$i<=ceil($count/20);$i++){
                                echo("<option".($i==$el4?' selected="selected"':'').">{$i}</option>");
                            }
                        ?>
                    </select>
                </p>
		<div class="gallery">
                    <?php
                        $el4--;
                        
                 $query=db::query("SELECT `{prefix}profiles`.`id`,`{prefix}profiles`.`cover`,`{prefix}users`.`username` FROM `{prefix}profiles` INNER JOIN `{prefix}users` ON `{prefix}users`.`id`=`{prefix}profiles`.`id` WHERE `{prefix}profiles`.`cover`!='' LIMIT ".($el4*20).",20");      
                      $i=0;
                        while($row=mysqli_fetch_assoc($query)){
                    ?>
                    <div data-user="<?=$row['id'];?>" class="image">
                        <div class="tools">
                            <a class="menu icon-cog" href="javascript:void(0);"></a>
                            <menu style="display: none;position: absolute; top: 22.5px; left: 119.55px;z-index: 1000;">
                                <a class="removeavatar with-icon" href="javascript:void(0);"><div class="icon icon-remove"></div> حذف</a>
                            </menu>
                        </div>
                        <a href="/theme/images/covers/<?=$row['cover'];?>" rel="gallery<?=$i++;?>"><img src="/theme/images/covers/<?=$row['cover'];?>" style="width: 125px;height: 125px;" /></a>
                        <span><?=$row['username'];?></span>
                    </div>
                    <?php
                        }
                    ?>
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