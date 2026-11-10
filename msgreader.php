<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript">
    var $sender = '0', $geter = '0', $keyword;
    function getmsgs(sender, geter, page) {
        $.ajax({
            type: "POST",
            url: '<?php echo(url('ajax/admin.msgreader')); ?>',
            data: {sender: sender, geter: geter, page: page},
            success: function (data) {
                $('#result').html('');
                $('#pagespm').html($('pages', data).text()).trigger("liszt:updated");
                $('#pagerow').slideDown(1000);
                data = $('msg', data);
                for (x = 0; x != data.length; x++) {
                    addrow(data[x]);
                }
                $('#pms_table').slideDown(1000);
            }, error: function (data) {
                $('#page').slideUp(1000);
                $('#pms_table').slideUp(1000);
            },
            dataType: 'xml'
        });

    }
    function getmsgsearch(keyword, page) {

        $.ajax({
            type: "POST",
            url: '<?php echo(url('ajax/admin.msgreader')); ?>',
            data: {keyword: keyword, page: page},
            success: function (data) {
                $('#resultsearch').html('');
                $('#pagespmsearch').html($('pages', data).text()).trigger("liszt:updated");
                $('#pagerowsearch').slideDown(1000);
                data = $('msg', data);
                for (x = 0; x != data.length; x++) {
                    addrowsearch(data[x]);
                }
                $('#pms_tablesearch').slideDown(1000);
            }, error: function (data) {
                $('#pagesearch').slideUp(1000);
                $('#pms_tablesearch').slideUp(1000);
            },
            dataType: 'xml'
        });

    }

    function getmessage_offline(name_sender1, name_reciver1, keyword, page) {
        $.ajax({
            type: "POST",
            url: '<?php echo(url('ajax/admin.offlinemsgreader')); ?>',
            data: {name_sender1: name_sender1, name_reciver1: name_reciver1, keyword: keyword, page: page},
            success: function (data) {
                $('#resultsearch1').html('');
                $('#pagespmsearch1').html($('pages', data).text()).trigger("liszt:updated");
                $('#pagerowsearch1').slideDown(1000);
                data = $('msg', data);
                for (x = 0; x != data.length; x++) {
                    addrowsearch_offline(data[x]);
                }
                $('#pms_tablesearch1').slideDown(1000);
            }, error: function (data) {
                $('#pagesearch').slideUp(1000);
                $('#pms_tablesearch1').slideUp(1000);
            },
            dataType: 'xml'
        });
    }
function delall() {
        del_all_private_message($sender);
    }

    function search() {
        getmsgs($sender, $geter, 1);
    }
    function searchKey() {
        getmsgsearch($('#search').val(), 1);
    }
    function searchKey_offline() {
        getmessage_offline($('#search_byname_sender').val(), $('#search_byname_reciver').val(), $('#search1').val(), 1);
    }
    function setpage(elem) {
        getmsgs($sender, $geter, elem.value);
    }
    function setpagesearch(elem) {
        getmsgsearch($keyword, elem.value);
    }
    function setpagesearch_offline(elem) {
        getmessage_offline($keyword, elem.value);
    }
    function addrow(data) {
        $('#result').append($(data).text());
    }
    function addrowsearch(data) {
        $('#resultsearch').append($(data).text());
    }
    function addrowsearch_offline(data) {
        $('#resultsearch1').append($(data).text());
    }
    function del_offline_message(id, text, random) {
        $.ajax({
            type: "POST",
            url: '<?php echo(url('ajax/admin.offlinemsgreader.del')); ?>',
            data: {id: id, text: text},
            success: function (data) {
                if (data == 'ok') {
                    $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'با موفقیت حذف شد'});
                    $('#msg-' + random).slideUp(1000);
                } else {
                    alert(data);
                }
            }
        });
    }
    function del_private_message(id) {
        $.ajax({
            type: "POST",
            url: '<?php echo(url('ajax/admin.msgreader')); ?>',
            data: {id: id},
            success: function (data) {
                if (data == 'ok') {
                    $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'با موفقیت حذف شد'});
                    $('#priv-' + id).slideUp(1000);
                } else {
                    alert(data);
                }
            }
        });
    }
	function del_all_private_message(user) {
        $.ajax({
            type: "POST",
            url: '<?php echo(url('ajax/admin.msgreader')); ?>',
            data: {user: user},
            success: function (data) {
                if (data == 'ok') {
                    $.msgGrowl({type: 'success', title: 'موفقیت آمیز', text: 'با موفقیت حذف شد'});
                    getmsgs($sender, $geter, 1); 
               } else {
                    alert(data);
                }
            }
        });
    }
    $(document).ready(function () {
<?php
if (giu('el3'))
    $id = safe::number(giu('el3'));
if (isset($id) and $sender = db::get('users', "`id`,`username`", "`id`='$id'")) {
    ?>
            $sender = '<?php echo($sender['id']); ?>';
    <?php
}
?>
        $("#customuser").autocomplete({
            source: "<?php echo(url('ajax/admin.users.autocomplete')); ?>",
            minLength: 2,
            select: function (event, ui) {
                if (ui.item)
                    $sender = ui.item.id;
            }
        });
        $("#customgeter").autocomplete({
            source: "<?php echo(url('ajax/admin.users.autocomplete')); ?>",
            minLength: 2,
            select: function (event, ui) {
                if (ui.item)
                    $geter = ui.item.id;
            }
        });
        $('.radiobutton').click(function () {
            var $val = $('input[name=sender]:checked').val();
            if ($val == 'all') {
                $("#customuser").slideUp(1000);
                $('#torow').slideUp(1000);
            } else if ($val == 'custom') {
                $("#customuser").css('display', 'inline');
                $('#torow').slideDown(1000);
            }
            $val = $('input[name=geter]:checked').val();
            if ($val == 'all') {
                $("#customgeter").slideUp(1000);
            } else if ($val == 'custom') {
                $("#customgeter").css('display', 'inline');
            }
        });
        $('#pms_table').slideUp(1000);
        $('#pms_tablesearch').slideUp(1000);


    })
</script>
<style>
#repbox{background-color:#f2f2ff;border:1px solid #f2f2ff;border-radius:10px;margin:0;min-width:100px;overflow:hidden;position:relative;width:100%;word-wrap:break-word;float:right;margin:10px 0 0}
#khat{border-right:3px solid #809fff;margin-right:15px;margin-top:5px;position:relative;cursor:pointer}
#name{color:#809fff;font-weight:700;margin-right:7px;margin-top:-2px;position:relative}
#text{margin-right:7px;position:relative}
#means{margin-right:22px;margin-top:5px}
.pmbox{text-align:right;clear:right;overflow:hidden;width:100%}
.pmbox .mess_back{float:right;width:100%}
</style>
<script type="text/javascript">
    function filemanager_password_checker() {
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.filemanager.checkpw')); ?>",
            data: {password: $("#filemanager_password").val()},
            success: function (data) {
                switch (data) {
                    case('ok'):
                        window.location.reload();
                        break;
                case('invalid'):$.jGrowl('پسورد اشتباه است', { header: 'خطا' });break;
                default:alert(data);break;
                }
            }
        });
    }
</script>
<?php if (session('filemanager_password') == $options['filemanager_password']) { ?>
<section id="content" class="container_12 clearfix" data-sort=true>
    <h1 class="grid_12 margin-top no-margin-top-phone">خصوصی خوان</h1>
    <div class="grid_12">
        <div class="grid_12">
            <form class="box  validate" id="formsendmsg">
                <div class="header">
                    <h2>خصوصی خوان</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>فرستنده:</strong></label>
                        <div>
                            همه <input type="radio" name="sender" value="all" /><br />
                            یک شخص <input type="radio" name="sender" value="custom" checked="checked" />
                            <input type="text"  id="customuser"  style="width: 250px;" value="<?php
                            if (isset($sender)) {
                                echo($sender['username']);
                            }
                            ?>"/>
                            <br />
                        </div>
                    </div>
                    <div class="row" id="torow">
                        <label><strong>به:</strong></label>
                        <div>
                            همه <input type="radio" name="geter" value="all" checked="checked" /><br />
                            یک شخص <input type="radio" name="geter" value="custom"  />
                            <input type="text"  id="customgeter"  style="width: 250px;display: none;" value=""/>
                            <br />
                        </div>
                    </div>
                    <div class="row" >

                        <div><button class="button blue flat block" onclick="search();return false;">جستجو</button></div>
                    </div>
                    <div class="row" id="pagerow" style="display: none;">
                        <label><strong>صفحه:</strong></label>
                        <div><select id="pagespm" class="search" onchange="setpage(this);"></select></div>
                    
                      <button  onclick="delall();return false;" style="margin-top:20px; margin-bottom:5px; float:left;" > حذف تمام پیام های فرستنده و گیرنده </button>  </div>

                    <table class="styled" id="pms_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="width: 25%;">فرستنده</th>
                                <th style="width: 25%;">گیرنده</th>
                                <th style="width: 25%;">تاریخ</th>
                                <th>متن</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody id="result">
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        <div class="grid_12">
            <form class="box  validate" id="formsendmsg2">
                <div class="header">
                    <h2>جستجو در خصوصی ها</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>عبارت یا کلمه:</strong></label>
                        <div>
                            <input type="text"  id="search"  />
                        </div>
                    </div>
                    <div class="row" >

                        <div><button class="button grey flat block" onclick="searchKey();return false;">جستجو</button></div>
                    </div>
                    <div class="row" id="pagerowsearch" style="display: none;">
                        <label><strong>صفحه:</strong></label>
                        <div><select id="pagespmsearch" class="search" onchange="setpagesearch(this);"></select></div>
                    </div>

                    <table class="styled" id="pms_tablesearch">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="width: 25%;">فرستنده</th>
                                <th style="width: 25%;">گیرنده</th>
                                <th style="width: 25%;">تاریخ</th>
                                <th>متن</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody id="resultsearch">
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        <div class="grid_12">
            <form class="box  validate" id="formsendmsg2">
                <div class="header">
                    <h2>جستجو در پیام های آفلاین</h2>
                </div>
                <div class="content tabbed">
                    <div class="row">
                        <label><strong>نام کاربری فرستنده:</strong></label>
                        <div>
                            <input type="text"  id="search_byname_sender"  />
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>نام کاربری گیرنده:</strong></label>
                        <div>
                            <input type="text"  id="search_byname_reciver"  />
                        </div>
                    </div>
                    <div class="row">
                        <label><strong>عبارت یا کلمه:</strong></label>
                        <div>
                            <input type="text"  id="search1"  />
                        </div>
                    </div>
                    <div class="row" >
                        <div><button class="button grey flat block" onclick="searchKey_offline();return false;">جستجو</button></div>
                    </div>
                    <div class="row" id="pagerowsearch1" style="display: none;">
                        <label><strong>صفحه:</strong></label>
                        <div><select id="pagespmsearch1" class="search" onchange="setpagesearch_offline(this);"></select></div>
                    </div>
                    <table class="styled" id="pms_tablesearch1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="width: 25%;">فرستنده</th>
                                <th style="width: 25%;">گیرنده</th>
                                <th>متن</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody id="resultsearch1">
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</section>
<?php } else { ?> 
    <center>
        <div style="background-image:url('<?php echo(theme::url('img/filess.png')); ?>');height: 300px;width: 300px;margin-top:80px;margin-right:180px;color:#F00;border-radius: 5px;">
            <br><br>
            <input type="password" style="text-align: center; margin-top: 120px; width: 35%;" placeholder="پسورد خصوصی خوان" id="filemanager_password" name="filemanager_password">
            <button onclick="filemanager_password_checker();" class="grey cancel">باز کن</button>
        </div>
<p><b>رمز خصوصی خوان را وارد کنید</b></p>
<p><b>این رمز از پنل اضطراری قابل تغییر است</b></p>
</center>
<?php } ?>
<?php include('footer.php'); ?>