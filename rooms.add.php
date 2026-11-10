<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    var proccted = '';
    function add() {

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
            'title': $('input[name=title]', $form).val(),
            'defaultroom': $('input[name=defaultroom]', $form).prop('checked'),
            'password': password,
            'wellcomemsg': $('#wellcomemsg').val(),
            'cap': $('#cap').val(),
            'permission': $permission,
            'timeroom':$('input[name=timeroom]', $form).val()
        };
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.rooms.add')); ?>",
            data: data,
            success: function (data) {
                switch (data) {
                    case('ok'):
                        $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'ذخیره شد'});
                        break;
                    case('title'):
                        $.msgGrowl({type: 'warning', title: 'خطا', text: 'لطفا نامی را برای اتاق انتخاب کنید'});
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
            }

        });
        $('.checkbox').click(function () {
            var $val = $('input[name=defaultroom]').prop('checked');
            if ($val == true) {
                $('#passrow').css('visibility', 'hidden');
            } else {
                $('#passrow').css('visibility', 'visible');
            }


        });




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
    <h1 class="grid_12 margin-top no-margin-top-phone">اتاق جدید</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formeditroom">
                <div class="header">
                    <h2>ساخت اتاق</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>نام اتاق:</strong></label>
                        <div><input type="text" name="title" class="required" value=""/></div>
                    </div>
                    <div class="row">
                        <label><strong>پیام خوش آمدگویی:</strong></label>
                        <div>
                            <textarea class="editor" name="wellcomemsg" id="wellcomemsg"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>اتاق پیشفرض:</strong></label>
                        <div>
                            <input type="checkbox" name="defaultroom" value="1" />

                        </div>
                    </div>
                    <div class="row">
                        <label><strong>ظرفیت اتاق:</strong><small>0 = نامحدود</small></label>
                        <div>
                            <input type="text" name="cap" value="" id="cap"/>

                        </div>
                    </div>
                                <?php 
                                 $room['timeroom'] = json_decode((string) ($room['timeroom'] ?? ''), true); if (!is_array($room['timeroom'])) $room['timeroom'] = array();
				if(($room['timeroom']['time'] ?? '0') != "0"){  	
					    $timeroom = jdate::start('Y/m/d H:i:s', $room['timeroom']['time']);
					}else{
					    $timeroom = 'غیرفعال';	
					}
                                if(empty($room['timeroom'])){
					    $timeroom = 'غیرفعال';	
					}
				?>                   
                    <div class="row">
                        <label><strong>مدت زمان اتاق:</strong><small>0 = غیرفعال</small></label>
                        <div>
                            <input style="width:100px;" type="text" name="timeroom" value="<?php echo($room['timeroom']['times'] ?? ''); ?>"> روز 
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
                                    foreach ($usertype as $type) {
                                        ?>
                                        <option name="<?php echo($type['id']); ?>"><?php echo($type['title']); ?></option>
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
                            مدیران:<input type="radio" id="proctd" name="proctd" value="8" /><br />
                            مدیران و ناظران :<input type="radio" id="proctd" name="proctd" value="78" /><br />
                            رمز دلخواه :<input type="radio" id="proctd" name="proctd" value="0" />
                            <div style="display: none;" id="password_room">
                                <input name="password" id="password_room_input" type="password" />
                            </div><br />
                        </div>
                    </div>


                </div>

            </form>
            <center> <button class="button blue flat block" onclick="add();">بساز</button></center>
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