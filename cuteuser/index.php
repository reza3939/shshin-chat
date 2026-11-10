<!DOCTYPE html>
<html>
    <head>
        <title>طراحی نام کاربری</title>
        <meta charset="utf-8">
        <script type="text/javascript" src="<?php echo(url('theme/cuteuser/js/jquery-latest.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo(url('theme/cuteuser/js/jquery-latest.mins.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo(url('theme/cuteuser/js/scripts20f4.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo(url('theme/cuteuser/js/jquery.autosize.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo(url('theme/cuteuser/js/ticker.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo(url('theme/cuteuser/js/messletters20f4.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo(url('theme/cuteuser/js/messletters_static20f4.js')); ?>"></script>
        <link rel="stylesheet" href="<?php echo(url('theme/cuteuser/css/master20f4.css')); ?>">
		<link rel="stylesheet" href="<?php echo(url('theme/fonts/fonts.css')); ?>">
        <script type="text/javascript">
            /*AMS click count*/
            $(".ad a").one("click", function () {
                var id = $(this).attr("data-aid");
                $.post("http://www.messletters.com/scripts/popular.php", {id: id, cat: 'v2ams', myKey: '934aa317f1f99da0dbba80556acd3f58'});
            });
        </script>
        <script type="text/javascript">

            $(".partnerlink").one("click", function () {
                var id = $(this).attr("data-pid");
                $.post("http://www.messletters.com/scripts/popular.php", {id: id, cat: 'v2partners', myKey: '934aa317f1f99da0dbba80556acd3f58'});
            });
        </script>
    </head>
    <div id="idesigner">
        <div id="main">
            <div id="sidebarLeft">
                <nav>
                    <span class="search rad3">
                        <span>
                            <textarea id="textin" data-value="<?php echo(session('name')); ?>" value="<?php echo(session('name')); ?>" placeholder="<?php echo(session('name')); ?>"></textarea>
                            <input onclick="search();" class="rad-l3" value="بساز" type="button">
                        </span>
                    </span>
                    <nmaish>نمایش :</nmaish>
                    <ul id="options">
                        <a href="javascript:();"><li class="optionToggle noselect" id="checkBreeze" title="bReEzE">استایل 1</li></a>
                        <a href="javascript:();"><li class="optionToggle noselect" id="checkReverse" title="Reverse">استایل 2</li></a>
                        <a href="javascript:();"><li class="optionToggle noselect" id="checkBox" title="Boxed">استایل 3</li></a>
                        <a href="javascript:();"><li class="optionToggle noselect" id="checkWave" title="Waves">استایل 4</li></a>
                        <a href="javascript:();"><li class="optionToggle noselect" id="checkSmoke" title="Smoky">استایل 5</li></a>
                        <a href="javascript:();"><li class="optionToggle noselect" id="checkUpperline" title="Upperline">استایل 6</li></a>
                        <a href="javascript:();"><li class="optionToggle noselect" id="checkUnderline" title="Underline">استایل 7</li></a>
                        <a href="javascript:();"><li class="optionToggle noselect" id="checkStrike" title="Strikethrough">استایل 8</li></a>
                    </ul>
                </nav>
                <div id="content">
                    <div class="article messletters">
                        <ul id="output">
                            <li class="gradientGray" title="Smooth | Likes: 15816, Dislikes: 4063 | Rating: 3.98/5"><pre id="output117"></pre></li>
                            <li class="gradientGray" title="BigOne | Likes: 4739, Dislikes: 1224 | Rating: 3.97/5"><pre id="output144"></pre></li>
                            <li class="gradientGray" title="Smooth v2 | Likes: 10119, Dislikes: 2614 | Rating: 3.97/5"><pre id="output159"></pre></li>	
                            <li class="gradientGray" title="Fullwidth | Likes: 6023, Dislikes: 1556 | Rating: 3.97/5"><pre id="output134"></pre></li>
                            <li class="gradientGray" title="Classic | Likes: 8378, Dislikes: 2165 | Rating: 3.97/5"><pre id="output116"></pre></li>
                            <li class="gradientGray" title="Lower Upper | Likes: 6708, Dislikes: 1734 | Rating: 3.97/5"><pre id="output119"></pre></li>
                            <li class="gradientGray" title="Swipe | Likes: 5547, Dislikes: 1434 | Rating: 3.97/5"><pre id="output147"></pre></li>		
                            <li class="gradientGray" title="Royal | Likes: 4042, Dislikes: 1048 | Rating: 3.97/5"><pre id="output163"></pre></li>
                            <li class="gradientGray" title="Circled | Likes: 4968, Dislikes: 1308 | Rating: 3.96/5"><pre id="output132"></pre></li>
                            <li class="gradientGray" title="MathScript | Likes: 3163, Dislikes: 846 | Rating: 3.94/5"><pre id="output160"></pre></li>
                            <li class="gradientGray" title="Dwarf | Likes: 2663, Dislikes: 724 | Rating: 3.93/5"><pre id="output120"></pre></li>
                            <li class="gradientGray" title="Love | Likes: 3151, Dislikes: 866 | Rating: 3.92/5"><pre id="output149"></pre></li>
                            <li class="gradientGray" title="Handwrite | Likes: 2697, Dislikes: 743 | Rating: 3.92/5"><pre id="output158"></pre></li>
                            <li class="gradientGray" title="Awesome | Likes: 3097, Dislikes: 855 | Rating: 3.92/5"><pre id="output122"></pre></li>
                            <li class="gradientGray" title="FancyCurly | Likes: 3566, Dislikes: 985 | Rating: 3.92/5"><pre id="output154"></pre></li>
                            <li class="gradientGray" title="Celtic | Likes: 2841, Dislikes: 791 | Rating: 3.91/5"><pre id="output130"></pre></li>
                            <li class="gradientGray" title="Fasion | Likes: 2452, Dislikes: 698 | Rating: 3.89/5"><pre id="output156"></pre></li>
                            <li class="gradientGray" title="Japanese | Likes: 2885, Dislikes: 822 | Rating: 3.89/5"><pre id="output128"></pre></li>
                            <li class="gradientGray" title="Writing | Likes: 2574, Dislikes: 738 | Rating: 3.89/5"><pre id="output143"></pre></li>
                            <li class="gradientGray" title="Gothic | Likes: 1764, Dislikes: 506 | Rating: 3.89/5"><pre id="output148"></pre></li>
                            <li class="gradientGray" title="Greek | Likes: 1767, Dislikes: 507 | Rating: 3.89/5"><pre id="output136"></pre></li>
                            <li class="gradientGray" title="Attila | Likes: 1634, Dislikes: 476 | Rating: 3.87/5"><pre id="output121"></pre></li>
                            <li class="gradientGray" title="MathFraktur | Likes: 1520, Dislikes: 443 | Rating: 3.87/5"><pre id="output162"></pre></li>
                            <li class="gradientGray" title="Ribbon | Likes: 1702, Dislikes: 502 | Rating: 3.86/5"><pre id="output141"></pre></li>
                            <li class="gradientGray" title="Swirly | Likes: 1318, Dislikes: 401 | Rating: 3.83/5"><pre id="output157"></pre></li>
                            <li class="gradientGray" title="Cute | Likes: 1987, Dislikes: 612 | Rating: 3.82/5"><pre id="output124"></pre></li>
                            <li class="gradientGray" title="Bent | Likes: 198, Dislikes: 61 | Rating: 3.82/5"><pre id="output164"></pre></li>
                            <li class="gradientGray" title="Cranky | Likes: 1501, Dislikes: 464 | Rating: 3.82/5"><pre id="output155"></pre></li>
                            <li class="gradientGray" title="Stupid | Likes: 1324, Dislikes: 411 | Rating: 3.82/5"><pre id="output135"></pre></li>
                            <li class="gradientGray" title="Twisted | Likes: 1639, Dislikes: 520 | Rating: 3.8/5"><pre id="output138"></pre></li>
                            <li class="gradientGray" title="Maniac | Likes: 1135, Dislikes: 387 | Rating: 3.73/5"><pre id="output139"></pre></li>
                            <li class="gradientGray" title="Strange | Likes: 1088, Dislikes: 401 | Rating: 3.65/5"><pre id="output115"></pre></li>
                            <li class="gradientGray" title="Russian | Likes: 1188, Dislikes: 439 | Rating: 3.65/5"><pre id="output131"></pre></li>
                            <li class="gradientGray" title="Tamil | Likes: 1397, Dislikes: 528 | Rating: 3.63/5"><pre id="output140"></pre></li>
                            <li class="gradientGray" title="Dotted | Likes: 1058, Dislikes: 408 | Rating: 3.61/5"><pre id="output129"></pre></li>
                            <li class="gradientGray" title="Hazy | Likes: 1048, Dislikes: 413 | Rating: 3.59/5"><pre id="output123"></pre></li>
                            <li class="gradientGray" title="Hyves | Likes: 1362, Dislikes: 545 | Rating: 3.57/5"><pre id="output118"></pre></li>
                            <li class="gradientGray" title="Wiggly | Likes: 1002, Dislikes: 449 | Rating: 3.45/5"><pre id="output145"></pre></li>
                            <li class="gradientGray" title="Slammer | Likes: 1036, Dislikes: 525 | Rating: 3.32/5"><pre id="output153"></pre></li>
                            <li class="gradientGray" title="Crazy | Likes: 1127, Dislikes: 580 | Rating: 3.3/5"><pre id="output142"></pre></li>
                            <li class="gradientGray" title="Mirrored | Likes: 1070, Dislikes: 571 | Rating: 3.26/5"><pre id="output137"></pre></li>
                            <li class="gradientGray" title="FlipRev | Likes: 1229, Dislikes: 668 | Rating: 3.24/5"><pre id="output151"></pre></li>
                            <li class="gradientGray" title="Big Momma | Likes: 1786, Dislikes: 995 | Rating: 3.21/5"><pre id="output146"></pre></li>
                            <li class="gradientGray" title="Flip | Likes: 1501, Dislikes: 884 | Rating: 3.15/5"><pre id="output150"></pre></li>
                            <li class="gradientGray" title="Bubbles | Likes: 1513, Dislikes: 923 | Rating: 3.11/5"><pre id="output133"></pre></li>
                            <li class="gradientGray" title="1337 | Likes: 2578, Dislikes: 1621 | Rating: 3.07/5"><pre id="output152"></pre></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>	
    </div>
	
</body>
</html>