<?php
include('header.php');
include('sidebar.php');
?>
<script type="text/javascript" src="<?php echo(url('jsloader/admin/filemanger')); ?>"></script>
<script type="text/javascript" src="<?php echo(theme::url('js/ajaxfileupload.js')); ?>"></script>
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
    <div style="display: none;" id="upload_filemanager" title="آپلود فایل">
        <form action="" class="full" enctype="multipart/form-data">

            <div class="row">
                <label for="file_filemanager"><strong>انتخاب فایل</strong></label>
                <div>
                    <input type="file" id="file_filemanager" name="file_filemanager" />
                </div>
            </div>
            <div class="row">
                <label for="file_filemanager_password"><strong>کلمه عبور: </strong></label>
                <div>
                    <input type="password" id="file_filemanager_password" name="newfilename_filemanager_password" />
                </div>
            </div>
        </form>
        <div class="actions">
            <div class="left"><button class="grey cancel">انصراف</button></div>
            <div class="right"><button class="submit">آپلود</button></div>
        </div>
    </div>
    <div style="display: none;" id="newfile_filemanager" title="فایل جدید">
        <form action="" class="full" enctype="multipart/form-data">

            <div class="row">
                <label for="newfilename_filemanager"><strong>نام فایل: </strong></label>
                <div>
                    <input type="text" id="newfilename_filemanager" name="newfilename_filemanager" />
                </div>
            </div>
            <div class="row">
                <label for="newfilename_filemanager_password"><strong>کلمه عبور: </strong></label>
                <div>
                    <input type="password" id="newfilename_filemanager_password" name="newfilename_filemanager_password" />
                </div>
            </div>
        </form>
        <div class="actions">
            <div class="left"><button class="grey cancel">انصراف</button></div>
            <div class="right"><button class="submit">بساز</button></div>
        </div>
    </div>
    <div style="display: none;" id="zip_filemanager" title="فشرده سازی">
        <form action="" class="full" enctype="multipart/form-data">

            <div class="row">
                <label for="zipname_filemanager"><strong>نام فایل: </strong></label>
                <div>
                    <input type="text" id="zipname_filemanager" name="zipname_filemanager" />
                </div>
            </div>
            <div class="row">
                <label for="zipname_filemanager_password"><strong>کلمه عبور: </strong></label>
                <div>
                    <input type="password" id="zipname_filemanager_password" name="newfilename_filemanager_password" />
                </div>
            </div>
        </form>
        <div class="actions">
            <div class="left"><button class="grey cancel">انصراف</button></div>
            <div class="right"><button class="submit">فشرده سازی</button></div>
        </div>
    </div>
    <div style="display: none;" id="newdir_filemanager" title="پوشه حدید">
        <form action="" class="full" enctype="multipart/form-data">

            <div class="row">
                <label for="newnewdirname_filemanager"><strong>نام پوشه: </strong></label>
                <div>
                    <input type="text" id="newnewdirname_filemanager" name="newnewdirname_filemanager" />
                </div>
            </div>
            <div class="row">
                <label for="newnewdirname_filemanager_password"><strong>کلمه عبور: </strong></label>
                <div>
                    <input type="password" id="newnewdirname_filemanager_password" name="newfilename_filemanager_password" />
                </div>
            </div>
        </form>
        <div class="actions">
            <div class="left"><button class="grey cancel">انصراف</button></div>
            <div class="right"><button class="submit">بساز</button></div>
        </div>
    </div>
    <section id="content" class="container_12 clearfix" data-sort=true>
        <h1 class="grid_12 margin-top no-margin-top-phone">مدیریت فایل ها</h1>
        <div class="grid_12" id="editgrid" style="display: none;">
            <div class="box">
                <div class="header">
                    <h2>
                        <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/folder-share.png')); ?>">
                        ویرایش فایل
                    </h2>
                </div>
                <div class="content">
                    <div class="tabletools" style="display: inherit">
                        <label>کلمه عبور : </label><input type="password" id="save_filemanager_password" name="save_filemanager_password" placeholder="کلمه عبور" />
                        <button id="canceleditbtn">انصراف</button>
                        <button id="saveditbtn">ذخیره کردن</button>
                    </div>
                    <textarea dir="ltr" style="width: 100%;height: 500px;font-family: sans-serif;"></textarea>
                </div>
            </div>
        </div>
        <div class="grid_12" id="maingrid">
            <div class="box">
                <div class="header">
                    <h2>
                        <img class="icon" src="<?php echo(theme::url('img/icons/packs/fugue/16x16/folder-share.png')); ?>">
                        فایل منیجر
                    </h2>
                </div>
                <div class="content">
                    <div class="tabletools" style="display: inherit">
                        <button id="newfilebtn">فایل جدید</button>
                        <button id="newdirbtn">فولدر جدید</button>
                        <button id="upbtn">اپلود</button>
                        <button id="editbtn">ویرایش</button>
                        <button id="delbtn">حذف کردن</button>
                        <button id="copybtn">کپی</button>
                        <button id="movebtn">انتقال</button>
                        <button id="renamebtn">تغییر نام</button>
                        <button id="downbtn">دانلود</button>
                        <button id="zipbtn">فشرده سازی</button>
                        <button id="unzipbtn">خارچ کردن از حالت فشرده</button>
                    </div>
                    <table class="styled" id="daynmic_table">
                        <thead>
                            <tr>
                                <th  width="40%">نام فایل</th>
                                <th>اندازه</th>
                                <th>تاریخ و زمان آخرین تغییر</th>
                                <th>نوع</th>
                                <th>مجوز</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyfilemaneger"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php } else { ?> 
    <center>
        <div style="background-image:url('<?php echo(theme::url('img/filess.png')); ?>');height: 300px;width: 300px;margin-top:80px;margin-right:180px;color:#F00;border-radius: 5px;">
            <br><br>
            <input type="password" style="text-align: center; margin-top: 120px; width: 35%;" placeholder="پسورد فایل منیجر" id="filemanager_password" name="filemanager_password">
            <button onclick="filemanager_password_checker();" class="grey cancel">باز کن</button>
        </div>
<p><b>رمز فایل منیجر را وارد کنید</b></p>
<p><b>این رمز از پنل اضطراری قابل تغییر است</b></p>
</center>
<?php } ?>
<?php include('footer.php'); ?>