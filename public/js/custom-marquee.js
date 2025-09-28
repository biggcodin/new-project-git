$(function(){
    $('.de-marquee-list').marquee({
        direction: 'right',
        duration: 50000,
        gap: 0,
        delayBeforeStart: 0,
        duplicated: true,
        startVisible: true
    });

    $('.wm-carousel').marquee({
        direction: 'right',
        duration: 20000,
        gap: 100,
        delayBeforeStart: 0,
        duplicated: true,
        startVisible: false
    });
});