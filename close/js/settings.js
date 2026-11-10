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
});