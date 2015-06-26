<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('js/jquery.js') ?>"></script>
<script type="text/javascript">
$(document).ready(function () {
    /* 延迟函数  */
    jQuery.fn.delay = function (time, func) {
        return this.each(function () {
            setTimeout(func, time);
        });
    };


    jQuery.fn.countDown = function (settings, to) {
        settings = jQuery.extend({
            startFontSize: '36px',
            endFontSize: '12px',
            duration: 500,
            startNumber: 5,
            endNumber: 0,
            callBack: function () { }
        }, settings);
        return this.each(function () {

            if (!to && to != settings.endNumber) { to = settings.startNumber; }

            //设定倒计时开始的号码
            $(this).text(to).css('fontSize', settings.startFontSize);

            //页面动画
            $(this).animate({
                'fontSize': settings.endFontSize
            }, settings.duration, '', function () {
                if (to > settings.endNumber + 1) {
                    $(this).css('fontSize', settings.startFontSize).text(to - 1).countDown(settings, to - 1);
                }
                else {
                    settings.callBack(this);
                }
            });

        });
    };
    //使用
    $('#countdown').countDown({
        startNumber: 5,
        callBack: function () {
        	window.location = $('#currPage').val();
        }
    });

});


</script>
</head>
<body>
<div class='col-md-12'>
<span><?php echo $message?></span><h1>5秒后自动跳转，如果没有跳转，请点击<a href="<?php echo $currPage ?>">此链接</a>直接跳转</h1>
<span id="countdown">5</span>

</div>
<input id="currPage" type="hidden" value="<?php echo $currPage ?>"/>
</body>
</html>
