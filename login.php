<?php
$admin = session('admin');
if ($admin != '0') {
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->

<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

        <title><?php echo(site_title); ?> | ورود | پنل شاهین طرح </title>
        <meta name="description" content="<?php echo($options['chat_description']) ?>"/>
        <meta name="author" content="<?php echo($options['author']); ?>"/>

        <!-- Mobile viewport optimized: h5bp.com/viewport -->
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <!-- iPhone: Don't render numbers as call links -->
        <meta name="format-detection" content="telephone=no"/>

        <link rel="shortcut icon" href="<?php echo(theme::url('favicon.ico')); ?>" />
        <!-- Layout Styles -->
        <link rel="stylesheet" href="<?php echo(theme::url('css/style.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo(theme::url('css/grid.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo(theme::url('css/layout.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo(url('theme/fonts/fonts.css')); ?>"/>

        <!-- Icon Styles -->
        <link rel="stylesheet" href="<?php echo(theme::url('css/icons.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo(theme::url('css/fonts/font-awesome.css')); ?>"/>
        <!--[if IE 8]><link rel="stylesheet" href="css/fonts/font-awesome-ie7.css"><![endif]-->

        <!-- External Styles -->
        <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery-ui-1.8.21.custom.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery.chosen.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery.cleditor.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery.colorpicker.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery.elfinder.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery.fancybox.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery.jgrowl.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo(theme::url('css/external/jquery.plupload.queue.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo(theme::url('css/external/syntaxhighlighter/shCore.css')); ?>" />
        <link rel="stylesheet" href="<?php echo(theme::url('css/external/syntaxhighlighter/shThemeDefault.css')); ?>" />

        <!-- Elements -->
        <link rel="stylesheet" href="<?php echo(theme::url('css/elements.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo(theme::url('css/forms.css')); ?>"/>

        <!-- OPTIONAL: Print Stylesheet for Invoice -->
        <link rel="stylesheet" href="<?php echo(theme::url('css/print-invoice.css')); ?>"/>

        <!-- Typographics -->
        <link rel="stylesheet" href="<?php echo(theme::url('css/typographics.css')); ?>"/>

        <!-- Responsive Design -->
        <link rel="stylesheet" href="<?php echo(theme::url('css/media-queries.css')); ?>"/>

        <!-- Bad IE Styles -->
        <link rel="stylesheet" href="<?php echo(theme::url('css/ie-fixes.css')); ?>">


        <!-- Load Webfont loader -->
        <script defer async src="<?php echo(theme::url('js/webfont.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/polyfills/modernizr-2.6.1.min.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/polyfills/respond.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/polyfills/matchmedia.js')); ?>"></script>
        <!--[if lt IE 9]><script src="<?php echo(theme::url('js/mylibs/polyfills/selectivizr-min.js')); ?>"></script><![endif]-->
        <!--[if lt IE 10]><script src="<?php echo(theme::url('js/mylibs/charts/excanvas.js')); ?>"></script><![endif]-->
        <!--[if lt IE 10]><script src="<?php echo(theme::url('js/mylibs/polyfills/classlist.js')); ?>"></script><![endif]-->

        <script src="<?php echo(theme::url('js/jquery.min.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/jquery-ui.min.js')); ?>"></script>
        <script>window.jQuery || document.write('<script src="<?php echo(theme::url('js/libs/jquery-1.7.2.min.js')); ?>"><\/script>')</script>

        <!-- Do the same with jQuery UI -->
        <script src="<?php echo(theme::url('js/lodash.min.js')); ?>"></script>
        <script>window.jQuery.ui || document.write('<script src="<?php echo(theme::url('js/libs/jquery-ui-1.8.21.min.js')); ?>"><\/script>')</script>
        <script>window._ || document.write('<script src="<?php echo(theme::url('js/libs/lodash.min.js')); ?>"><\/script>')</script>

        <!-- General Scripts -->
        <script src="<?php echo(theme::url('js/mylibs/jquery.hashchange.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/jquery.idle-timer.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/jquery.plusplus.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/jquery.jgrowl.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/jquery.scrollTo.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/jquery.ui.touch-punch.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/jquery.ui.multiaccordion.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/number-functions.js')); ?>"></script>

        <!-- Forms -->
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

        <!-- Charts -->
        <script src="<?php echo(theme::url('js/mylibs/charts/jquery.flot.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/charts/jquery.flot.orderBars.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/charts/jquery.flot.pie.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/charts/jquery.flot.resize.js')); ?>"></script>

        <!-- Explorer -->
        <script src="<?php echo(theme::url('js/mylibs/explorer/jquery.elfinder.js')); ?>"></script>

        <!-- Fullstats -->
        <script src="<?php echo(theme::url('js/mylibs/fullstats/jquery.css-transform.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/fullstats/jquery.animate-css-rotate-scale.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/fullstats/jquery.sparkline.js')); ?>"></script>

        <!-- Syntax Highlighter -->
        <script src="<?php echo(theme::url('js/mylibs/syntaxhighlighter/shCore.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/syntaxhighlighter/shAutoloader.js')); ?>"></script>

        <!-- Dynamic Tables -->
        <script src="<?php echo(theme::url('js/mylibs/dynamic-tables/jquery.dataTables.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/dynamic-tables/jquery.dataTables.tableTools.zeroClipboard.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/dynamic-tables/jquery.dataTables.tableTools.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/gallery/jquery.fancybox.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/mylibs/tooltips/jquery.tipsy.js')); ?>"></script>
        <script src="<?php echo(url('jsloader/admin/mango')); ?>"></script>
        <script src="<?php echo(url('jsloader/admin/plugins')); ?>"></script>
        <script src="<?php echo(url('jsloader/admin/script')); ?>"></script>
        <script src="<?php echo(url('jsloader/admin/app')); ?>"></script>
        <script type="text/javascript">



    $(document).ready(function(){
        $('#login_btn').click(function(){
            var username = $('#login_name').val();
            var password = $('#login_pw').val();
            $('#login_btn').val('لطفا صبر کنید...');

            $.ajax({
                type: "POST",
                url: '<?php echo(url('ajax/login/admins')); ?>',
				data:{username:username, password:password},
				success: function(data) {
                    $('#login_btn').val('ورود');
                    if (data && data.length > 200) { alert('پاسخ نامعتبر از سرور - ابتدا از چت روم با اکانت ادمین وارد شوید'); return; }
                    switch(data){
                        case('ok'):top.location.href='<?php echo(session('afterlogin') ? session('afterlogin') : url('admin')); ?>';break;
                        case('pass'):alert('کلمه عبور اشتباه است');break;
                        case('user'):alert('این نام وجود ندارد');break;
                        default:alert(data);break;
                    }
                },
                error: function(xhr) {
                    $('#login_btn').val('ورود');
                    alert('خطا ' + xhr.status + ' - همین پیام را گزارش کنید');
                }
            });
                    return false;
            });
            });</script>
    </head>
   
        <body class=login>
            <section id="toolbar">
                <div class="container_12">


                    <!-- Right side -->
                    <div class="right">
                        <ul>

                            <li><a href="<?php echo(url('chat')); ?>"><span class="icon i14_bended-arrow-left"></span>برگشت به چت روم</a></li>
                            <li class="red"><a target="_blank" href="http://www.shahinn.cfd">شاهین طرح</a></li>

                        </ul>
                    </div><!-- End of .right -->



                    <!-- Left side -->
                    <div class="left">
                        <ul class="breadcrumb">

                            <li><a href="<?php echo(url()); ?>"><?php echo(site_title); ?></a></li>
                            <li><a href="<?php echo(url('admin')); ?>">پنل مدیریت</a></li>

                        </ul>
                    </div>
                    <!-- End of .left -->



                    <!-- Phone only items -->
                    <div class="phone">

                        <!-- User Link -->
                        <li><a href="<?php echo(url()); ?>"><span class="icon icon-home"></span></a></li>
                        <!-- Navigation -->
                        <li><a href="#"><span class="icon icon-heart"></span></a></li>

                    </div><!-- End of .phone -->

                </div><!-- End of .container_12 -->
            </section><!-- End of #toolbar -->

            <!-- The header containing the logo -->
        <center>
            <header class="container_12">
                <div class="container">
                    <!-- Your logos -->
                    <a href="http://www.shahinrtarh.ir"><img  src="<?php echo(theme::url('img/logo-light.png')); ?>" alt=" شاهین طرح - ارائه انواع خدمات چت روم" width="227" height="55"></a>
                    <a class="phone-title" href="http://www.shahintarh.ir"><img src="<?php echo(theme::url('img/logo-mobile.png')); ?>" alt="شاهین طرح - ارائه انواع خدمات چت روم" height="22" width="70" /></a>
                </div><!-- End of .container -->

            </header>
        </center><!-- End of header -->

        <!-- The container of the sidebar and content box -->
        <section id="login" class="container_12 clearfix">

            <form action="<?php echo(url('form/login/admins')); ?>" method="post" id="login-form" class="box">

                <div class="header">
                    <h2><span class="icon icon-lock"></span>ورود:</h2>
                </div>

                <div class="content">

                    <!-- Login messages -->
                    <div class="login-messages">
                        <div class="message welcome">خوش آمدید</div>
                        <div class="message failure">ورودی اشتباه.</div>
                    </div>
                    <div class="form-box">
                        <div class="row">
                            <label for="login_name">
                                <strong>نام کاربری</strong>
                                <small></small>
                            </label>
                            <div style="margin-right: 63px;">
                                <input tabindex=1 type="text" class="required noerror" name="username" id=login_name />
                            </div>
                        </div>
                        <div class="row">
                            <label for="login_pw">
                                <strong>کلمه عبور</strong>
                            </label>
                            <div style="margin-right: 63px;">
                                <input tabindex=2 type="password" class="required noerror" name="password" id=login_pw />
                            </div>
                        </div>

                <div class="actions">
                    <div class="right">
                    </div>
                    <div class="left">
                        <input tabindex=3 type="submit" value="ورود" name="login_btn" id="login_btn" />
                    </div>
                </div><!-- End of .actions -->

            </form><!-- End of form -->
        </section>
        <!-- Spawn $$.loaded -->
        <script>
                    $$.loaded();
        </script>
    </body>
<?php } else {
include("pages/notfound.php");
} ?>
</html>