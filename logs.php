<?php include('header.php'); include('sidebar.php'); ?>
<script type="text/javascript">
var $type = '1';
var $page = 1;
var $elem = false;
$(document).ready(function(){
        $( "#dialog_search" ).dialog({
		autoOpen: false,
		modal: true,
		width: 400,
		open: function(){ $(this).parent().css('overflow', 'visible'); $$.utils.forms.resize() }
	});
	 $('#search_btn').click(opensearch);
    $('#content .header ul li').click(function(){
        var $typeClick = $('a', this).attr('href');
        $typeClick = $typeClick.substr(6);
        getlogs($typeClick, $page, $('a', this)[0]);
        $('#daynmic_table').css('display', 'block');
        return false;
    });
    setTimeout(function(){
        
        var $liselected = $('#content .header ul li.current');
        var $typeClick = $('a', $liselected).attr('href');
        $typeClick = $typeClick.substr(6);
        getlogs($typeClick, 1, $('a', $liselected)[0]);
        $('#daynmic_table').css('display', 'block');
    }, 1000);
    
});
function getlogs(type,page, elem){
    $.ajax({
        type: "POST",
        url: '<?php echo(url('ajax/logs')); ?>',
        data:{type:type, page:page},
        success: function(data) {
            $('#resultLogs').html('');
            var pages = $('pages', data).text();
            $('#pages').html(pages).trigger("liszt:updated");
            $('#page').slideDown(1000);
            data = $('logs',data);
            for(x=0;x!=data.length;x++){
                addrow(data[x]);
            }
            if(elem != false){$('#content .header ul li.current').attr('class', '');$(elem.parentNode).attr('class', 'current');}
            $type = type;
            $page = page;
            $elem = elem;
            $('#daynmic_table').css('display', 'block');
            
        },
        dataType:'xml'
    });
}
function addrow(data){
    $('#resultLogs').append($(data).text());
}
function setpage(elem){
    getlogs($type, elem.value, $elem);
}
function opensearch (){
	$( "#dialog_search" ).dialog( "open" );
	return false;
    
}
</script>

<div style="display: none;" id="dialog_search" title="جستجو">
    <form action="<?php echo(url('admin/logs/search')); ?>" class="full" method="post">
        <div class="row">
    		<label for="name"><strong>نام کاربری</strong></label>
    		<div><input  type="text" name="username" id="username" /></div>
    	</div>
		<div class="row">
    		<label for="name"><strong>نام نمایشی</strong></label>
    		<div><input  type="text" name="name" id="name" /></div>
    	</div>
		<div class="row">
    		<label for="name"><strong>آی پی</strong></label>
    		<div><input  type="text" name="ip" id="ip_search" /></div>
    	</div>
        <div class="row">
    		<label for="gender"><strong>قسمت</strong></label>
    		<div><select class="search" style="padding-bottom: 10px" name="type" id="gender_search" data-placeholder="یکی را انتخاب کنید">
    				<option value="1">ورود و خروج</option>
    				<option value="2">اخطارها</option>
    				<option value="8">اخراج ها</option>
    				<option value="4">فعالیت های چت رومی</option>
    				<option value="9">فعالیت های مدیران</option>
  			</select></div>
    	</div>

    </form>
    <div class="actions">
    	<div class="right">
    		<button class="grey cancel" onclick="$('#dialog_search').dialog('close');">انصراف</button>
    	</div>
    	<div class="left">
            <input type="submit" class="submit" value="بگرد" onclick="$('#dialog_search form')[0].submit();" />
    	</div>
    </div>
    </div>
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
	<h1 class="grid_12 margin-top no-margin-top-phone">رصد خانه</h1>
	<p style="text-align: center;">
		<button id="search_btn" class="button grey block">جستجو</button>
	</p>
    <div class="grid_12">
		<div class="box tabbedBox">
                <div class="header">
                    <h2>رصد خانه</h2>
					
                    <ul>
                        <li><a href="#logs-1">ورود و خروج</a></li>
                        <li><a href="#logs-2">اخطار ها</a></li>
                        <li><a href="#logs-8">اخراج ها</a></li>
                        <li><a href="#logs-4">فعالیت های چت رومی</a></li>
                        <li><a href="#logs-9">فعالیت های مدیران</a></li>
                   </ul>
                </div>
                <div class="content tabbed">
                    <div id="logs-1"></div>
                    <div id="logs-2"></div>
                    <div id="logs-8"></div>
                    <div id="logs-4"></div>
                    <div id="logs-9"></div>
                    <p style="display: none;" id="page">صفحه: <select id="pages" class="search" onchange="setpage(this);"></select></p>
                    <table class="styled" id="daynmic_table" style="width: 100%;">
    					<thead>
    						<tr>
    							<th align="center">#</th>
                                <th align="center">آی پی</th>
                                <th align="center">تاریخ</th>
                                <th align="center">ساعت</th>
                                <th align="center">نام کاربری</th>
                                <th align="center">نام نمایشی</th>
                                <th align="center">شرح</th>
    						</tr>
    					</thead>
    					<tbody id="resultLogs"></tbody>
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