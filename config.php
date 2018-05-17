<?php

// 站点配置
$sysconfig = array(
	'title' => '站点名称',
	'host' => array('ssl' => 0, 'url' => 'abc.com'),
	'online' => '#online,
	'register' => array(
		'注册线路一' => array('ssl'=>0, 'url'=>'#url'),
		'注册线路二' => array('ssl'=>0, 'url'=>'#url'),
		'注册线路三' => array('ssl'=>0, 'url'=>'#url'),
		'注册线路四' => array('ssl'=>0, 'url'=>'#url'),
		'注册线路五' => array('ssl'=>0, 'url'=>'#url'),
		'注册线路六' => array('ssl'=>0, 'url'=>'#url'),
	),
	'login' => array(
		'注册线路一' => array('ssl'=>0, 'url'=>'#url'),
		'注册线路二' => array('ssl'=>0, 'url'=>'#url'),
		'注册线路三' => array('ssl'=>0, 'url'=>'#url'),
		'注册线路四' => array('ssl'=>0, 'url'=>'#url'),
		'注册线路五' => array('ssl'=>0, 'url'=>'#url'),
		'注册线路六' => array('ssl'=>0, 'url'=>'#url'),
	),
);


$PHP_SELF = $_SERVER['PHP_SELF'];


// Current Url
$thisUrl = 'http://'.$_SERVER['HTTP_HOST'].substr($PHP_SELF, 0, strrpos($PHP_SELF,'/')+1);


// check mobile
function isMobile()
{
    function dstrpos($string, $arr, $returnvalue = false)
    {
        if (empty($string))
            return false;

        foreach ((array) $arr as $v)
        {
            if (strpos($string, $v) !== false)
            {
                $return = $returnvalue ? $v : true;
                return $return;
            }
        }
        return false;
    }

    global $_G;
    $mobile = array();
    static $touchbrowser_list = array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini', 'ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung', 'palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser', 'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource', 'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone', 'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop', 'benq', 'haier', '^lct', '320x320', '240x320', '176x220', 'windows phone');
    static $wmlbrowser_list = array('cect', 'compal', 'ctl', 'lg', 'nec', 'tcl', 'alcatel', 'ericsson', 'bird', 'daxian', 'dbtel', 'eastcom', 'pantech', 'dopod', 'philips', 'haier', 'konka', 'kejian', 'lenovo', 'benq', 'mot', 'soutec', 'nokia', 'sagem', 'sgh', 'sed', 'capitel', 'panasonic', 'sonyericsson', 'sharp', 'amoi', 'panda', 'zte');
    static $pad_list = array('ipad');
    $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);

    if (dstrpos($useragent, $pad_list))
        return false;

    if ($v = dstrpos($useragent, $touchbrowser_list, true))
    {
        $_G['mobile'] = $v;
        return '2';
    }

    if ($v = dstrpos($useragent, $wmlbrowser_list))
    {
        $_G['mobile'] = $v;
        return '3';
    }

    $brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
    if (dstrpos($useragent, $brower))
        return false;

    $_G['mobile'] = 'unknown';
    if (isset($_G['mobiletpl'][$_GET['mobile']]))
        return true;
    else
        return false;
}


/**
 * create url
 */
function url($ssl, $url)
{
    return ($ssl ? 'https://' : 'http://') . str_ireplace(array('http://', 'https://'), '', $url);
}


// 获取顶级郁闷
function getHost($url='')
{
    // 域名
    if($url=='')
        $url = $_SERVER["HTTP_HOST"];

    // 字符统计
    $num = substr_count($url, '.');

    // 域名截取
    if ($num > 1)
    {
        $strNum = strpos($url, '.');
        $strCount = strlen($url);
        $endNum = $strCount - $strNum;
        $url = substr($url, $strNum + 1, $endNum);
    }

    return $url;
}

// 检查是否为手机
$isMobile = isMobile() || (isset($_GET['act']) && $_GET['act']=='wap');
