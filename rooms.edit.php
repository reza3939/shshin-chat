<?php
include('header.php');
include('sidebar.php');
$room = safe::number(giu('el4'));
$room = db::get('rooms', "*", "`id`='$room'");
if (!$room) {
    include('pages/notfound.php');
    return;
}
$defualtroom = $options['chat_defaultroom'] == $room['id'] ? true : false;
$paswd = $room['password'];
if (!empty($paswd) && $paswd != '78' && $paswd != '8') {
    $paswd = true;
} else {
    $paswd = false;
}
$decode = json_decode($room['vip_user'], true);
$vip_user_json = isset($decode['vip_user']) ? true : false;
?>
<script type="text/javascript">
    var proccted = '';
    function edit() {
        var $permission = '';
        var $typepermission = $('input[name=typepermission]:checked').val();
        if ($typepermission == 'all') {
            $permission = '0';
        } else {
            var $options = $('.dualselect .right select option');
            $permission = '';
            for (i = 0; i != $options.length; i++) {
                if ($permission != '')
                    $permission += ',';
                $permission += $($options[i]).attr('name');
            }
        }

        var password = proccted;

        if (password == '0')
            password = $('#password_room_input').val();
        var $form = $('#formeditroom');
        var data = {
            'token': '<?php echo(session('changepw')); ?>',
            'room': '<?php echo($room['id']); ?>',
            'title': $('input[name=title]', $form).val(),
            'defaultroom': $('input[name=defaultroom]', $form).prop('checked'),
            'password': password,
            'wellcomemsg': $('#wellcomemsg').val(),
            'cap': $('#cap').val(),
            'permission': $permission,
            'timeroom':$('input[name=timeroom]', $form).val()
        };
<?php if ($vip_user_json) { ?>
            data.vip_user = $('input[name=vip_user]', $form).val();
            data.vip_time = $('input[name=vip_time]', $form).val();
            data.is_admin = $('input[name=is_admin]', $form).prop('checked') == true ? '1' : '0';
<?php } ?>
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.rooms.edit')); ?>",
            data: data,
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        break;
                    case('title'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا نامی برای اتاق انتخاب کنید'});
                        break;
                    default:
                        alert(data);
                        break;
                }
            }
        });
    }
    $(document).ready(function () {
        $('#passrow input[name=proctd]').click(function () {

            var $val = $(this).val();
            $('#password_room').css('display', 'none');
            if ($val == '8') {
                proccted = '8';
            } else if ($val == '78') {
                proccted = '78';
            } else if ($val == '0') {
                proccted = '0';

                $('#password_room').css('display', 'inline');
            } else if ($val == '') {
                proccted = '';
            }

        });
        $('.checkbox').click(function () {
            var $val = $('input[name=defaultroom]').prop('checked');
            if ($val == true) {
                $('#passrow').css('visibility', 'hidden');
                proccted = '';
            } else {
                $('#passrow').css('visibility', 'visible');
            }


        });
<?php if ($defualtroom) { ?>
            $('#passrow').css('visibility', 'hidden');
<?php } ?>
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
    <h1 class="grid_12 margin-top no-margin-top-phone">ویرایش اتاق</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formeditroom">
                <div class="header">
                    <h2>ویرایش "<?php echo($room['title']); ?>"</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>شماره اتاق:</strong></label>
                        <div><input type="text" name="id" value="<?php echo($room['id']); ?>"  disabled="disabled" readonly="yes"  style="width: 100px;text-align: center;"/></div>
                    </div>
                    <div class="row">
                        <label><strong>نام اتاق:</strong></label>
                        <div><input type="text" name="title" class="required" value="<?php echo($room['title']); ?>"/></div>
                    </div>
                    <div class="row">
                        <label><strong>پیام خوش آمدگویی:</strong></label>
                        <div>
                            <textarea class="editor" name="wellcomemsg" id="wellcomemsg"><?php echo($room['wellcomemsg']); ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>اتاق پیشفرض:</strong></label>
                        <div>
                            <input type="checkbox" name="defaultroom" value="1" <?php if ($defualtroom) echo('checked="checked"'); ?> />

                        </div>
                    </div>
                    <?php if ($vip_user_json) { ?>
                        <div class="row">
                            <label><strong>مالک:</strong></label>
                            <div>
                                <input type="text" name="vip_users" value="<?php echo Users::get('name', $decode['vip_user']); ?>" disabled />
                                <input type="hidden" name="vip_user" value="<?php echo $decode['vip_user']; ?>" />

                            </div>
                        </div> 
                        <div class="row">
                            <label><strong>درجه:</strong></label>
                            <div>
                                <input type="text" name="vip_usertype" value="<?php echo Users::GetType(Users::get('type', $decode['vip_user'])); ?>" disabled />

                            </div>
                        </div> 
                        <div class="row">
                            <label><strong>دسترسی مدیریت در اتاق:</strong></label>
                            <div>
                                <input type="checkbox" name="is_admin" value="1" <?php if ($decode['is_admin'] == '1') echo('checked="checked"'); ?> />

                            </div>
                        </div>
                        <div class="row">
                            <label><strong>تاریخ خرید:</strong></label>
                            <div>
                                <input type="text" name="vip_tim" value="<?php echo jdate::start('l d F Y ساعت H:i:s', $decode['vip_time']); ?>" disabled />
                                <input type="hidden" name="vip_time" value="<?php echo $decode['vip_time']; ?>" />

                            </div>
                        </div>
                    <?php } ?>

                    <div class="row">
                        <label><strong>ظرفیت اتاق:</strong><small>0 = نامحدود</small></label>
                        <div>
                            <input type="text" name="cap" value="<?php echo($room['capacity']); ?>" id="cap"/>

                        </div>
                    </div>     
                                </select></p>
                                <?php 
                                 $room['timeroom'] = json_decode($room['timeroom'],true);
				if($room['timeroom']['time'] != "0"){  	
					    $timeroom = jdate::start('Y/m/d H:i:s', $room['timeroom']['time']);
					}else{
					    $timeroom = 'غیرفعال';	
					}
                                if($room['timeroom'] == "" ){
					    $timeroom = 'غیرفعال';	
					}
				?>                   
                    <div class="row">
                        <label><strong>مدت زمان اتاق:</strong><small>0 = غیرفعال</small></label>
                        <div>
                            <input style="width:100px;" type="text" name="timeroom" value="<?php echo($room['timeroom']['times']); ?>"> روز 
                            <p>
                            زمان حذف شدن اتاق: <input type="text" value="<?php echo($timeroom); ?>" readonly="yes" disabled="disabled">
                              </p>
                        </div>
                    </div>   
                    <div class="row">
                        <label><strong>دسترسی ها:</strong></label>
                        <div>
                            همه دسترسی ها: <input type="radio" name="typepermission" value="all"  />
                            <br />
                            سفارشی: <input type="radio" name="typepermission" value="custom"  checked />
                            <br />
                            <div id="customList">
                                <select multiple class="dualselects" data-size="small" id="permissions">
                                    <?php
                                    $expl = explode(',', $room['type']);
                                    foreach ($usertype as $type) {
                                        ?>
                                        <option <?php if (in_array($type['id'], $expl)) echo('selected'); ?> name="<?php echo($type['id']); ?>"><?php echo($type['title']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="passrow" >
                        <label><strong>حفاظت:</strong></label>
                        <div id="procote">
                            بدون حفاظت:<input type="radio" name="proctd" value="" <?php if ($room['password'] == '') echo('checked="checked"'); ?> /><br />
                            مدیران:<input type="radio" name="proctd" value="8" <?php if ($room['password'] == '8') echo('checked="checked"'); ?> /><br />
                            مدیران و ناظران :<input type="radio" name="proctd" value="78" <?php if ($room['password'] == '78') echo('checked="checked"'); ?> /><br />
                            رمز دلخواه :<input type="radio" name="proctd" value="0" <?php if ($paswd) echo('checked="checked"'); ?> />
                            <div style="display: none;" id="password_room">
                                <input name="password" id="password_room_input" type="text" value="<?php if ($paswd) echo(base64_decode($room['password'])); ?>" />
                            </div><br />
                        </div>
                    </div>


                </div>

            </form>
            <center> <button class="button blue flat block" onclick="edit();">ویرایش</button></center>
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