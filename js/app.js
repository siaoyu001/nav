$(function()
{
    setClass();
    window.onscroll = function()
    {
        setClass();
    }
});

function getScrollTop()
{
    var scrollTop = 0;
    if(document.documentElement && document.documentElement.scrollTop)
        scrollTop = document.documentElement.scrollTop;
    else if(document.body)
        scrollTop = document.body.scrollTop;
    return scrollTop;
}

function setClass()
{
    $('#slidebar').find('li>a').each(function(){
        $(this).attr('class','');
    });

    var topheight = getScrollTop();

    // Win
    if(topheight>=0 && topheight<2500)
        $('a[href=#win-terminal]').attr('class','act');
    // Linux
    else if(topheight>=2500 && topheight<2840)
        $('a[href=#linux-terminal]').attr('class','act');
    // Mac
    else if(topheight>=2840 && topheight<5700)
        $('a[href=#mac-terminal]').attr('class','act');
    // IOS
    else if(topheight>=5700 && topheight<7800)
        $('a[href=#ios-mobile]').attr('class','act');
    // Android
    else if(topheight>=7800 && topheight<10550)
        $('a[href=#android-mobile]').attr('class','act');
    // MI
    else if(topheight>=10550 && topheight<11552)
        $('a[href=#mi-router]').attr('class','act');
    // JK
    else if(topheight>=11552 && topheight<12650)
        $('a[href=#jk-router]').attr('class','act');
    // Other
    else if(topheight>=12650)
        $('a[href=#other-router]').attr('class','act');
}