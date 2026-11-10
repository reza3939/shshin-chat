<?php
$admin = session('admin');
if ($admin != '0') {
    if (!isset($_REQUEST['ajaxload'])) {
        ?><!doctype html>
        <!--[if lt IE 7]>
                <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en">
                <![endif]-->
        <!--[if IE 7]>
                <html class="no-js lt-ie9 lt-ie8" lang="en">
                <![endif]-->
        <!--[if IE 8]>
                <html class="no-js lt-ie9" lang="en">
                <![endif]-->
        <!--[if gt IE 8]>
        <!-->

        <html class="no-js" lang="en">

            <!--<![endif]-->
            <head>
                <meta charset="utf-8"/>
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
                <title>پنل مدیریت</title>
                <meta name="author" content="<?php echo($options['author']); ?>"/>
                <meta name="viewport" content="width=device-width,initial-scale=1"/>
                <meta name="format-detection" content="telephone=no"/>
                <link rel="shortcut icon" href="<?php echo(theme::url('favicon.ico')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/style.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/grid.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/layout.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/icons.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/fonts/font-awesome.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(url('theme/fonts/fonts.css')); ?>"/>
                <!--[if IE 8]><link rel="stylesheet" href="css/fonts/font-awesome-ie7.css"><![endif]-->
                <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery-ui-1.8.21.custom.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(url('fonts')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery.chosen.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery.cleditor.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery.colorpicker.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery.elfinder.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery.fancybox.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery.jgrowl.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery.plupload.queue.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/external/syntaxhighlighter/shCore.css')); ?>" />
                <link rel="stylesheet" href="<?php echo(theme::url('css/external/syntaxhighlighter/shThemeDefault.css')); ?>" />
                <link rel="stylesheet" href="<?php echo(theme::url('css/elements.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/forms.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/print-invoice.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/typographics.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/media-queries.css')); ?>"/>
                <link rel="stylesheet" href="<?php echo(theme::url('css/ie-fixes.css')); ?>">
                <link rel="stylesheet" href="<?php echo(theme::url('css/msgGrowl.css')); ?>">
                <script src="<?php echo(theme::url('js/mylibs/polyfills/modernizr-2.6.1.min.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/polyfills/respond.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/polyfills/matchmedia.js')); ?>"></script>
                <!--[if lt IE 9]><script src="<?php echo(theme::url('js/mylibs/polyfills/selectivizr-min.js')); ?>"></script><![endif]-->
                <!--[if lt IE 10]><script src="<?php echo(theme::url('js/mylibs/charts/excanvas.js')); ?>"></script><![endif]-->
                <!--[if lt IE 10]><script src="<?php echo(theme::url('js/mylibs/polyfills/classlist.js')); ?>"></script><![endif]-->
                <script src="<?php echo(theme::url('js/jquery.min.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/jquery-ui.min.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/msgGrowl.js')); ?>"></script>
                <script>window.jQuery || document.write('<script src="<?php echo(theme::url('js/libs/jquery-1.7.2.min.js')); ?>"><\/script>')</script>

                <script>window.jQuery.ui || document.write('<script src="<?php echo(theme::url('js/libs/jquery-ui-1.8.21.min.js')); ?>"><\/script>')</script>
                <script src="<?php echo(theme::url('js/lodash.min.js')); ?>"></script>
                <script>window._ || document.write('<script src="<?php echo(theme::url('js/libs/lodash.min.js')); ?>"><\/script>')</script>
                <script src="<?php echo(theme::url('js/mylibs/jquery.hashchange.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/jquery.idle-timer.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/jquery.plusplus.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/jquery.jgrowl.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/jquery.scrollTo.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/jquery.ui.touch-punch.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/jquery.ui.multiaccordion.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/number-functions.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.autosize.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.checkbox.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.chosen.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.cleditor.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.colorpicker.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.ellipsis.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.fileinput.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.fullcalendar.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.maskedinput.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.mousewheel.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.placeholder.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.pwdmeter.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.ui.datetimepicker.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.ui.spinner.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/jquery.validate.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/uploader/plupload.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/uploader/plupload.html5.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/uploader/plupload.html4.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/uploader/plupload.flash.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/forms/uploader/jquery.plupload.queue/jquery.plupload.queue.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/charts/jquery.flot.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/charts/jquery.flot.orderBars.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/charts/jquery.flot.pie.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/charts/jquery.flot.resize.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/explorer/jquery.elfinder.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/fullstats/jquery.css-transform.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/fullstats/jquery.animate-css-rotate-scale.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/fullstats/jquery.sparkline.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/syntaxhighlighter/shCore.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/syntaxhighlighter/shAutoloader.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/dynamic-tables/jquery.dataTables.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/dynamic-tables/jquery.dataTables.tableTools.zeroClipboard.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/dynamic-tables/jquery.dataTables.tableTools.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/gallery/jquery.fancybox.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mylibs/tooltips/jquery.tipsy.js')); ?>"></script>
                <script src="<?php echo(theme::url('js/mango.js')); ?>"></script>
                <script src="<?php echo(url('jsloader/admin/script')); ?>"></script>
                <script src="<?php echo(url('jsloader/admin/plugins')); ?>"></script>
                <script src="<?php echo(url('jsloader/admin/app')); ?>"></script>
  <style type="text/css">
<?php if ($options['blur'] == 'false') { ?>  
.pvimg { filter:none !important;}
<?php } ?> </style>
            </head>
            <body>

                <div id="lock-screen" title="قفل صفحه">
                    <a href="<?php echo(url('admin/login')); ?>" class="header right button grey flat">خروج</a>
                    <p>
                        شما مدتی است در پنل مدیریتتان فعالیتی نداشته اید وما نگران مسائل امنیتی هستیم!
                    </p>
                    <p>
                        برای همین صفحه را قفل کرده ایم تا کسی غیر از شما تا هنگام برگشت شما از پنل استفاده نکند.
                    </p>
                    <div class="actions">
                        <div id="slide_to_unlock" style="direction: ltr;">
                            <img src="<?php echo(theme::url('img/elements/slide-unlock/lock-slider.png')); ?>" alt="مرا بکشید">
                            <span>
                                برای باز کردن بکشید
                            </span>
                        </div>
                        <form action="#" method="GET">
                            <input type="password" name="pwd" id="pwd" placeholder="لطفا رمزتان را بزنید" autocorrect="off" autocapitalize="off">
                            <input type="submit" name="send" value="بازکردن" disabled>
                            <input type="reset" value="X">
                        </form>
                    </div>
                </div>

                <section id="toolbar">
                    <div class="container_12">
                        <div class="left">
                            <ul class="breadcrumb">
                                <li>
                                    <a href="<?php echo(url()); ?>"><?php echo(site_title); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo(url('admin')); ?>">پنل مدیریت</a>
                                </li>
                            </ul>
                        </div>
                        <div class="right">
                            <ul>
                                <li class="red">
                                    <a href="<?php echo(url('admin/login')); ?>">خروج</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" id="btn-lock"><span>--:--</span> قفل صفحه</a>
                                </li>
                                <li class="space">
                                </li>
                                <?php if (adminpanel::check_Permission('bool', 'letters')) { ?>
                                    <li>
                                        <?php $numsgs = db::num('letters', "`to`='" . session('id') . "' and `status`='0'"); ?>
                                        <a href="<?php echo( $numsgs != 0 ? '#' : url('admin/letters')); ?>"><span><?php echo($numsgs); ?></span>پیام ها</a>
                                        <?php if ($numsgs != 0) { ?>
                                            <div class="popup">
                                                <h3>
                                                    پیام های جدید
                                                </h3>
                                                <a class="button flat left grey" onclick="$(this).parent().fadeToggle($$.config.fxSpeed)">ببند</a>
                                                <a class="button flat right" href="<?php echo(url('admin/letters')); ?>">صندوق</a>
                                                <div class="content mail">
                                                    <ul>
                                                        <?php
                                                        $query = db::query("SELECT * FROM {prefix}letters WHERE `to`='" . session('id') . "' and `status`='0' ORDER BY `time` DESC  LIMIT 0, 3");
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            ?>
                                                            <li>
                                                                <div class="avatar">
                                                                    <img src="<?php echo(theme::url('img/elements/mail/mail.png')); ?>" height="40" width="40" />
                                                                </div>
                                                                <div class="info">
                                                                    <strong>
                                                                        <?php echo($row['author']); ?>
                                                                    </strong>
                                                                    <span>
                                                                        <?php echo($row['subject']); ?>
                                                                    </span>
                                                                    <small>
                                                                        <?php echo(jdate::start(("h:i A"))); ?>
                                                                    </small>
                                                                </div>
                                                                <div class="text">
                                                                    <p><?php echo($row['content']); ?></p>
                                                                    <div class="actions">
                                                                        <a onclick="deleteletters('<?php echo($row['id']); ?>', this);" class="red right" href="javascript:void(0);">حذف</a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php } ?>


                                                    </ul>
                                                    <?php
                                                    mysqli_free_result($query);
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a href="<?php echo(url("profile/" . session('id'))); ?>"><span class="icon i14_admin-user"></span>پروفایل</a>
                                </li>
                            </ul>
                        </div>
                        <div class="phone">
                            <li>
                                <a href="<?php echo(url("profile/" . session('id'))); ?>"><span class="icon icon-user"></span></a>
                            </li>
                            <li>
                                <a class="navigation" href="#"><span class="icon icon-list"></span></a>
                            </li>
                        </div>
                    </div>
                </section>
                			<header class="container_12">
                        <div><a href="https://www.mehtarh.ir/" target="_blank" class="logo"></a></div>
			<a href="https://www.mehtarh.ir/" target="_blank"><img src="/theme/adminpanel/img/logo.png" alt="<?php echo($options['author']); ?>"></a>
			<a class="phone-title" href="https://www.mehtarh.ir/" target="_blank"><img src="/theme/adminpanel/img/logo-light.png" alt="<?php echo($options['author']); ?>" height="22" width="70"/></a>
                    <div class="buttons">
                        <a href="<?php echo(url('admin/settings/general')); ?>"> <span class="icon icon-sitemap"></span> تنظیمات </a>
			<a href="<?php echo(url('admin/filemanager')); ?>"> <span class="icon icon-list-alt"></span> فایل ها </a>
                        <a href="<?php echo(url('admin/users')); ?>"> <span class="icon icon-table"></span> کاربران </a>
                    </div>
                </header>

                <div role="main" id="main" class="container_12 clearfix">
                <?php } ?>
                <section class="toolbar">
                    <div class="user">
                        <div class="avatar">
                            <img src="<?php echo(theme::url('img/layout/content/toolbar/user/avatar.png')); ?>">
                            <span>
                                <?php echo(db::num('letters', "`to`='" . session('id') . "' and `status`='0'")); ?>
                            </span>
                        </div>
                        <span>
                            <?php echo(session('name')); ?>
                        </span>
                        <ul>
                            <li><a href="<?php echo(url('admin/settings/general')); ?>">تنظیمات</a></li>
                            <li><a href="<?php echo(url('profile/' . session('id'))); ?>">پروفایل</a></li>
                            <li class="line"></li>
                            <li><a href="<?php echo(url('admin/logout')); ?>">خروج</a></li>
                        </ul>
                    </div>
                    <ul class="shortcuts">
                        <?php if (adminpanel::check_Permission('bool', 'users')) { ?>
                            <li id="shortcuts_creatuser">
                                <a href="javascript:void(0);"><span class="icon i24_user-business"></span></a>
                                <div class="small">
                                    <h3>ساخت کاربر</h3>
                                    <button class="button flat left grey" onclick="$(this).parent().fadeToggle($$.config.fxSpeed).parent().removeClass('active')">بستن</button>
                                    <button class="button flat right" onclick="shortcut_newuser(this);">بساز</button>
                                    <div class="content">
                                        <form class="full grid" onsubmit="return false;">
                                            <div class="row no-bg">
                                                <p class="_100 small">
                                                    <label for="p1_username">نام کاربری</label>
                                                    <input type="text" name="p1_username" id="p1_username" />
                                                </p>
                                            </div>
                                            <div class="row no-bg">
                                                <p class="_100 small">
                                                    <label for="p1_password">
                                                        کلمه عبور
                                                    </label>
                                                    <input type="password" name="p1_password" id="p1_password" />
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>

                        <li>
                            <a href="javascript:void(0);"><span class="icon i24_application-blue"></span></a>
                            <div class="small" style="width:420px;right:-192px">
                                <h3>
                                    اطلاعات
                                </h3>
                                <button class="button flat left grey" onclick="$(this).parent().fadeToggle($$.config.fxSpeed).parent().removeClass('active')">
                                    بستن
                                </button>
                                <div class="content">
                                    <p>امروزه چت روم بیشتر از آن که محلی برای صحبت های دوستانه باشد ، محلی برای کسب در آمد میباشد.با توجه ظرفیت در این زمینه شرکت "<span style="color: blue;cursor: pointer;" onclick="location.href = 'https://www.mehrtarh.ir/'">مهر طرح</span>" با زیر مجموعه حرفه ای "<span style="color: blue;cursor: pointer;" onclick="location.href = 'https://www.mehrtarh.ir/'">مهر طرح</span>" پا به عرصه رقابت نهاد.</p>
                                    <p>برتری که این مجموعه نسبت به رقبای خود دارد ابتدا استفاده از برنامه ای است که حاصل چند سال تلاش و زحمت مجموعه ذیل است.میتوان گفت این پشتیبانی شرکت ماست که توانسته جای نقوص این برنامه را پر کند و اصل رضایت همیشگی مشتریان رعایت شود</p>
                                    <p>پروژه <span style="cursor: help;" title="برنامه تحت وب">اسکریپت</span> در سال 1394 کلید خورد و بعد از عبور از مشکلات متعددی که در رو به روی خود دید در مهر ماه سال 1394 بصورت حرفه ای وارد دنیای مجازی ایرانیان شد.پیشرفت محسوس این برنامه باعث تحسین بسیاری از دوستان و حتی باعث شد بازار رقابت در سیستم های چت رومی داغ تر شود.</p>
                                    <p><span><span style="color: blue;cursor: pointer;" onclick="location.href = 'https://www.mehrtarh.ir/'">ادامه را در اینجا بخوانید...</span></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <input id="searchinput" type="search" data-source="extras/search.php" placeholder="جستجو..." autocomplete="off" class="tooltip" title="مثال: کاربران" data-gravity=s>
                </section>
                <?php
            } else {
                include("pages/notfound.php");
            }
            ?>

