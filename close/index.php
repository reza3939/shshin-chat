<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title><?php echo(site_title); ?></title>

    <meta name="description" content="<?php echo($options['chat_description']); ?>"/>
    <meta name="author" content="<?php echo($options['author']); ?>">

    <link rel="stylesheet" href="<?php echo(theme::url('css/main.css')); ?>" media="screen">
</head>

	<body>
        <div class="content-wrapper">
            
            <!-- Animated background. Full width. -->
            <div id="bg-animation-clouds"></div>
            <!-- /Animated background. Full width. -->

            <!-- Static Background -->
            <div class="bg-light"></div>
            <div class="bg-clouds"></div>
            <!-- /Static Background -->
            
            <!-- Content. Logo. Subscribe. Social -->
            <div id="content">

                <div id="logo"> <!-- Recommended size for logo = maximum width 160px -->
                    <img src="<?php echo(theme::url('images/logo.png')); ?>" alt="">
                </div>

                <div class="main-title">باز خواهیم برگشت!</div>
                <p><?php echo($options['chat_closeparam']['msg']); ?></p>

            </div>
            <!-- /Content. Logo. Subscribe. Social -->

            <!-- Parallax. Countdown. Footer -->
            <div id="parallax-section">
                <div class="parallax-layer" id="back-layer"></div>
                <div class="parallax-layer" id="countdown-wrapper"><div id="countdown"></div></div>
                <div class="parallax-layer" id="front-layer"></div>
                <div class="footer"><a href="https://portal.mehrtarh.ir/">MehrTarh.ir</a> © Copyrights<br><span>All Rights Reserved</span></div><!-- Footer -->
            </div>i           <!-- /Parallax. Countdown. Footer -->
        </div>

        <script src="<?php echo(theme::url('js/jquery-1.10.2.min.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/retina.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/date.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/countdown.min.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/jquery.parallax.js')); ?>"></script>
        <script src="<?php echo(theme::url('js/jquery.infieldlabel.min.js')); ?>"></script>
        <script type="text/javascript">
    $(document).ready(function() {
        (function (){
        var a = 0;
        function bgmove(){
            ++a;
            var bgimg = document.getElementById('bg-animation-clouds');
            bgimg.style.backgroundPosition = a + "px 0px";
        };
        setInterval(bgmove, 30); /* "30" ms - Animation Speed */
        })();
        jQuery('.parallax-layer').parallax({
            mouseport: jQuery("#parallax-section")
        });
        $(function(){
            $(".flabel").inFieldLabels();
        });
        $('#countdown').artRowCountdown({
            'date': '<?php echo(date('Y-m-d H:i:s', $options['chat_closeparam']['timetolunch'])); ?>',
            'separator': ' ',
            'stop': function () {
                alert('stop');
            }
        });
    });
    </script>
	<script>function baste(){window.location="https://portal.mehrtarh.ir/"} setTimeout("baste()",15000);</script>

    </body>
</html>