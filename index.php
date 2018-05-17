<?
// 配置文件
require("./config.php");

// download page
if(isset($_GET['act']) && $_GET['act'] == 'download')
{
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>安全上网导航</title>
</head>
<body onunload="jump();">
</body>
</html>
<script type="text/javascript">
/**
 * jump url
 */
function jump(){window.location.href='<?=$thisUrl;?>';}

/**
 * timer
 */
setTimeout(function(){jump();}, 1);
</script>

<?
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$sysconfig['host']['title'];?> - 安全上网导航</title>
	<meta name="keywords" content="<?=$sysconfig['host']['title'];?> - 安全上网导航" />
	<meta name="description" content="<?=$sysconfig['host']['title'];?> - 安全上网导航" />
    <link rel="stylesheet" type="text/css" href="<?=$thisUrl;?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=$thisUrl;?>css/bootstrap.css">
    <script type="text/javascript" src="<?=$thisUrl;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$thisUrl;?>js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript">
        $.test = function(id)
        {
            var span, d = document, li, a, i, lis = d.getElementById(id).getElementsByTagName('div');

            for(i = 1; li = lis[i++];)
            {
                a = li.getElementsByTagName('a')[0];
                if(!a || i % 2 == 0) continue;
                span = d.createElement('div');
				span.className = "OpenUrl";
                span.ctime = new Date();
                span.innerHTML = '测速中...<img src="' + a.href + '?s='+Math.random()+'" border="0" width="1" height="1" onerror="$.result(this)" />';
                li.appendChild(span);
            }
        };

        // get domain
        function getdomain(url)
        {
            var a = document.createElement('a'); a.href = url;
            return a.hostname;
        }

        // result
        $.result = function(img)
        {
            var span = img.parentNode, n = 'em';
            if(!$.result.isrun)
            {
                $('.FastOpen').each(function(){
                    // var main = '<?=url($sysconfig['host']['ssl'], $sysconfig['host']['url']);?>', url = getdomain($(img).attr('src')), rep = $(this).attr('href').replace(main,url).replace('https://','http://');
                    // $(this).attr('href', rep);
                });
                $.result.isrun = true;
                span.innerHTML = '<span id="Fast" style="font-weight:bolder;color:red;">' + ((new Date() - span.ctime) / 1000).toFixed(2) + 's 快<\/span>';
            }
            else
                span.innerHTML = '<span>' + ((new Date() - span.ctime) / 1000).toFixed(2) + 's<\/span>';
        };

        $(function()
        {
<?
if(!$isMobile)
{
?>
            // test
            $.test('Login');
            $.test('Register');
<?
}
?>
            // book markme
            $('#bookmarkme').click(function()
            {
                if(window.sidebar && window.sidebar.addPanel) { // Mozilla Firefox Bookmark
                    window.sidebar.addPanel(document.title, window.location.href, '');
                } else if(window.external && ('AddFavorite' in window.external)) { // IE Favorite
                    window.external.AddFavorite(location.href, document.title);
                } else if(window.opera && window.print) { // Opera Hotlist
                    this.title = document.title;
                    return true;
                } else { // webkit - safari/chrome
                    alert('Press ' + (navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? '按Ctrl / Cmd ' : 'CTRL') + '+ D将此页加入书签。');
                }
            });
<?
if(!$isMobile)
{
?>
            // OpenUrl
            $("#Register,#Login").on("click", ".OpenUrl", function(){
                window.open($(this).parent().find(".LinkTip").attr("href"));
            }).find(".back_LX").css("cursor", "pointer");
<?
}
?>
        });
    </script>

    <style type="text/css">
        /* css 重置 */
        *{margin:0; padding:0; list-style:none; }
        /*body{ background:#fff; font:normal 12px/22px 宋体;  }*/
        img{ border:0;  }
        a{ text-decoration:none; color:#333;  }
        a:hover{ color:#1974A1;  }
        .js{width:90%; margin:10px auto 0 auto; }
        .js p{ padding:5px 0; font-weight:bold; overflow:hidden;  }
        .js p span{ float:right; }
        .js p span a{ color:#f00; text-decoration:underline;   }
        .js textarea{ height:100px;  width:98%; padding:5px; border:1px solid #ccc; border-top:2px solid #aaa;  border-left:2px solid #aaa;  }

        /* 本例子css */
        .picFocus{ margin:0 auto;  width:100%; border:1px solid #ccc; padding:5px;  position:relative;  overflow:hidden;  zoom:1;   }
        .picFocus .hd{ width:100%; padding-top:5px;  overflow:hidden; }
        .picFocus .hd ul{ margin-right:-5px;  overflow:hidden; zoom:1; }
        .picFocus .hd ul li{ padding-top:5px; float:left;  text-align:center;  }
        .picFocus .hd ul li img{ width:109px; height:65px; border:2px solid #ddd; cursor:pointer; margin-right:5px;   }
        .picFocus .hd ul li.on{ background:url("images/icoUp.gif") no-repeat center 0; }
        .picFocus .hd ul li.on img{ border-color:#f60;  }
        .picFocus .bd li{ vertical-align:middle; }
        .picFocus .bd img{ max-width:100%; display:block;  }

    </style>


</head>

<body>
    <div class="navia">
        <div class="navia_left">
            <div class="nl_1"></div>
        </div>
<?
// HeadTab
if(!$isMobile)
{
?>
        <div class="navia_right">
            <a href="<?=url($sysconfig['host']['ssl'], $sysconfig['host']['url']);?>" target="_blank">
                <div class="nr_1"><div></div>易记域名: &nbsp;<?=$sysconfig['host']['url'];?></div>
            </a>
            <a href="javascript://" onclick="window.open('dns.html','dns');">
                <div class="nr_2"><div></div>DNS防劫持</div>
            </a>
            <a href="javascript://" id="bookmarkme" rel="sidebar" title="收藏线路导航">
                <div class="nr_1"><div></div>收藏本站</div>
            </a>
            <a href="<?=$thisUrl;?>?act=wap" >
                <div class="nr_2"><div></div>手机版</div>
            </a>
            <a href="<?=$thisUrl;?>?act=download" download=" - 安全上网导航">
                <div class="nr_1"><div></div>电脑桌面</div>
            </a>
            <a href="javascript://" onclick="window.location.reload();">
                <div class="nr_2"><div></div>重新检测</div>
            </a>
        </div>
<?
}
?>
    </div>

    <a href="<?=$sysconfig['online']?>" target="_blank">
        <div class="online_service">
            <div class="os_icon"></div>
            <div class="os_font">在线客服</div>
        </div>
    </a>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 entrance" id="Register">
<?
if(!$isMobile)
{
?>
            <div class="col-xs-6 col-sm-2 col-md-2 back_XL">
                <a href="<?=url($sysconfig['host']['ssl'], $sysconfig['host']['url']);?>" <?if(!$isMobile){?>target="_blank"<?}?> class="LinkTip FastOpen">
                    <div class="back_LX1">
                        <div class="bl1 lineInto">
                           注册地址
                        </div>
                    </div>
                </a>
            </div>
<?
}

// Register
foreach($sysconfig['register'] as $key => $val)
{
?>
            <div class="col-xs-6 col-sm-2 col-md-2 <?if(!$isMobile){?>back_XL<?}?>" <?if(!$isMobile){?>style="width:13.855555%"<?}?>>
                <div class="back_LX">
                    <a href="<?=url($val['ssl'], $val['url']);?>" <?if(!$isMobile){?>target="_blank"<?}?> class="LinkTip">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="ent_font"><?=$key;?></div>
                                <span class="station"></span>
                            </div>
                        </div>
                    </a>
					<?if($isMobile){?>
					<a href="<?=url($val['ssl'], $val['url']);?>" class="LinkTip">
						<div class="de_icon">
							<div class="div_center">
								<div class="ent_font"><?=$key;?></div>
								<span class="station"></span>
							</div>
						</div>
					</a>
					<?}?>
                </div>
            </div>
<?
}
?>
        </div>
    </div>


<?
// Login
if(!$isMobile)
	
{
?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 entrance" id="Login">
            <div class="col-xs-6 col-sm-2 col-md-2 back_XL">
                <a href="<?=url($sysconfig['host']['ssl'], $sysconfig['host']['url']);?>" <?if(!$isMobile){?>target="_blank"<?}?> class="LinkTip FastOpen">
                    <div class="back_LX1">
                        <div class="bl1 lineInto">
                            登录地址
                        </div>
                    </div>
                </a>
            </div>
<?
	foreach($sysconfig['login'] as $key => $val)
	{
?>
            <div class="col-xs-6 col-sm-2 col-md-2 back_XL" style="width:13.855555%">
                <div class="back_LX">
                    <a href="<?=url($val['ssl'], $val['url']);?>" target="_blank" class="LinkTip">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="ent_font"><?=$key;?></div>
                                <span class="station"></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
<?
	}
?>
        </div>
    </div>
<?
}
?>

    <!-- superSlide -->
    <div class="row">
        <div class="picFocus">
            <div class="bd">
                <ul>
                    <li><a href="javascript://"><img src="img/flash/1.jpg" /></a></li>
                    <li><a href="javascript://"><img src="img/flash/2.jpg" /></a></li>
                    <li><a href="javascript://"><img src="img/flash/3.jpg" /></a></li>
                    <li><a href="javascript://"><img src="img/flash/4.jpg" /></a></li>
                </ul>
            </div>

            <!--<div class="hd">
                <ul>
                    <li><img src="img/flash/1.jpg" /></li>
                    <li><img src="img/flash/2.jpg" /></li>
                    <li><img src="img/flash/3.jpg" /></li>
                    <li><img src="img/flash/4.jpg" /></li>
                </ul>
            </div>-->

        </div>

    </div>
    <script type="text/javascript">jQuery(".picFocus").slide({ mainCell:".bd ul",effect:"left",autoPlay:true });</script>

    <div class="row">
       <div class="col-xs-12 col-sm-12 col-md-12 entrance">
	          <img src="./1.png" width="100%" height="100%"/>
            <div class="col-xs-6 col-sm-2 col-md-2 title_div">
                <div class="back_wathet cywz">
                    <div class="bnb_icon_font">
                        <div class="bif_font">常用网址</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.baidu.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_1"></div>
                                <div class="ent_name">百度</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.youku.com/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_7"></div>
                                <div class="ent_name">优酷</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.qq.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_2"></div>
                                <div class="ent_name">腾讯QQ</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.jd.com/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_8"></div>
                                <div class="ent_name">京东商城</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.ifeng.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_3"></div>
                                <div class="ent_name">凤凰网</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.12306.cn/mormhweb/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_9"></div>
                                <div class="ent_name">12306</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.sohu.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_4"></div>
                                <div class="ent_name">搜孤</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.ctrip.com/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_10"></div>
                                <div class="ent_name">携程网</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.163.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_5"></div>
                                <div class="ent_name">网易</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.58.com/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_12"></div>
                                <div class="ent_name">58同城</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 entrance">
            <div class="col-xs-6 col-sm-2 col-md-2 title_div">
                <div class="back_wathet cywy">
                    <div class="bnb_icon_font">
                        <div class="bif_font">常用网银</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.icbc.com.cn/icbc/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_13"></div>
                                <div class="ent_name">工商银行</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.cmbchina.com/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_19"></div>
                                <div class="ent_name">招商银行</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.boc.cn/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_14"></div>
                                <div class="ent_name">中国银行</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.cebbank.com/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_20"></div>
                                <div class="ent_name">光大银行</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.ccb.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_15"></div>
                                <div class="ent_name">建设银行</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.cib.com.cn/cn/index.html" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_21"></div>
                                <div class="ent_name">兴业银行</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.abchina.com/cn/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_16"></div>
                                <div class="ent_name">农业银行</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.bankcomm.com/BankCommSite/default.shtml" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_23"></div>
                                <div class="ent_name">交通银行</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.psbc.com/cn/index.html" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_17"></div>
                                <div class="ent_name">邮政储蓄</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.cgbchina.com.cn/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_24"></div>
                                <div class="ent_name">广发银行</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 entrance">
            <div class="col-xs-6 col-sm-2 col-md-2 title_div">
                <div class="div_entrance1">
                    <div class="back_wathet cyzx">
                        <div class="bnb_icon_font">
                            <div class="bif_font">常用资讯</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://news.sina.com.cn/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_25"></div>
                                <div class="ent_name">新浪新闻</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.zaobao.com/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_31"></div>
                                <div class="ent_name">联合早报</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://news.ifeng.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_26"></div>
                                <div class="ent_name">凤凰资讯</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.people.com.cn/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_32"></div>
                                <div class="ent_name">人民网</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://news.qq.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_27"></div>
                                <div class="ent_name">腾讯新闻</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.huanqiu.com/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_36"></div>
                                <div class="ent_name">环球时报</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://news.sohu.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_28"></div>
                                <div class="ent_name">搜孤新闻</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://news.163.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_29"></div>
                                <div class="ent_name">网易新闻</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://news.baidu.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_30"></div>
                                <div class="ent_name">百度新闻</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.xinhuanet.com/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_35"></div>
                                <div class="ent_name">新华网</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 entrance">
            <div class="col-xs-6 col-sm-2 col-md-2 title_div">
                <div class="div_entrance1">
                    <div class="back_wathet cygw">
                        <div class="bnb_icon_font">
                            <div class="bif_font">常用购物</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.taobao.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_40"></div>
                                <div class="ent_name">淘宝</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.dangdang.com/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_45"></div>
                                <div class="ent_name">当当</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.jd.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_41"></div>
                                <div class="ent_name">京东</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://ju.taobao.com/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_46"></div>
                                <div class="ent_name">聚划算</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.tmall.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_42"></div>
                                <div class="ent_name">天猫精选</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.meilishuo.com/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_47"></div>
                                <div class="ent_name">美丽说</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.suning.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_43"></div>
                                <div class="ent_name">苏宁易购</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.mogujie.com/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_48"></div>
                                <div class="ent_name">蘑菇街</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="div_entrance1">
                    <a href="http://www.gome.com.cn/" target="_blank">
                        <div class="de_icon">
                            <div class="div_center">
                                <div class="icon_ent ie_44"></div>
                                <div class="ent_name">国美在线</div>
                            </div>
                        </div>
                    </a>
                    <a href="http://www.vip.com/" target="_blank">
                        <div class="de_icon de_icon1">
                            <div class="div_center">
                                <div class="icon_ent ie_49"></div>
                                <div class="ent_name">唯品会</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
       </div> 
    </div>

	
</body>
</html>