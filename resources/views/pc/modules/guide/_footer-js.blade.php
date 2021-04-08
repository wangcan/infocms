<div id="go_top">
    <ul>
        <li class="holidayicon getajaxdata" url="/ajaxstream/holiday/?action=getinfo"></li>
        <li>
            <a class="fff" href="javascript:void(0);" id="kefu" onclick="kefulink();">
                <img src="{{$commonAssetUrl}}/sguide/img/7bd6f-1211.gif">
                <div class="wordout">
                    <div class="word">联 系客 服</div></div>
            </a>
        </li>
        <li>
            <a class="collect fff " href="javascript:;" onclick="collect(this)" onmouseover="loadCollect($(this));">
                <i class="iconfont icon-shoucang"></i>
                <div class="word lh">收 藏</div></a>
            <div class="collectbox" id="collectbox"></div>
        </li>
        <li>
            <a class="share fff" href="javascript:;">
                <i class="iconfont icon-fenxiang"></i>
                <div class="word lh">分 享</div></a>
            <div class="bdsharebuttonbox" id="sharebigbox">
                <a href="javascript:void(0);" class="bds_weixin" data-cmd="weixin" title="分享到微信" onclick="shareclick(this);"></a>
                <a href="javascript:void(0);" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博" onclick="shareclick(this);"></a>
                <a href="javascript:void(0);" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间" onclick="shareclick(this);"></a>
                <a href="javascript:void(0);" class="bds_qq" data-cmd="qq" title="分享到qq好友" onclick="shareclick(this);"></a>
            </div>
        </li>
        <li>
            <a class="qrcode fff" href="javascript:;" onmouseover="$(this).find('img').attr('src',$(this).find('img').attr('data-src'))">
                <i class="iconfont icon-erweima1"></i>
                <div class="word lh" style="width:42px;">二维码</div>
                <img width="682" height="194" data-src="{{$commonAssetUrl}}/sguide/img/af43f-3932.png" /></a>
        </li>
        <li>
            <a class="gotop fff" href="javascript:;" onclick="$('html,body').animate({'scrollTop':'0'},{duration:300})">
                <i class="iconfont icon-shouqi"></i>
                <div class="word">回 到顶 部</div></a>
        </li>
    </ul>
</div>
<!--<script language="javascript">var pac = 'company',
    pdo = 'show',
    pid = '2411',
    siteid = 0,
    CNPP = 'https://cnpp.cn/',
    catid = '797',
    brandid = '2411',
    userid = '0',
    issm = '';
    var authorpiclist = null;</script>
<script type="text/javascript" src="{{$commonAssetUrl}}/sguide/js/company_show_819b40195d362ec635b44bd074e4ee2c.js"></script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?de3f6fd28ec4ac19170f18e2a8777593";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>-->
