@inject('culturePresenter', 'App\Presenters\Infocms\CulturePresenter')
<div class="mainMenu">
    <div>
        <ul class='topnavNum7 topnav'>
            <li class='b'>
                <div class='itemMenu'>
                    <a href='./' style='' target='_self'>网站首页</a></div>
            </li>
            @foreach ($culturePresenter->getCategoryTrees() as $pKey => $pData)
            <li class='b'>
                <div class='itemMenu'>
                    <a href='news/list_5.html' style='' target='_self'>书法篆刻</a></div>
                <ul class='subnav'>
                    <li>
                        <a href='news/list_33.html' target='_self' style=''>毛笔书法</a></li>
                    <li>
                        <a href='news/list_32.html' target='_self' style=''>硬笔书法</a></li>
                    <li>
                        <a href='news/list_148.html' target='_self' style=''>篆刻作品</a></li>
                    <li>
                        <a href='news/list_153.html' target='_self' style=''>书法展览</a></li>
                </ul>
            </li>
            @endforeach
            <li class='b'>
                <div class='itemMenu'>
                    <a href='news/list_94.html' style='' target='_self'>书法字帖</a></div>
                <ul class='subnav'>
                    <li>
                        <a href='news/list_97.html' target='_self' style=''>楷书字帖</a></li>
                    <li>
                        <a href='news/list_141.html' target='_self' style=''>行书字帖</a></li>
                    <li>
                        <a href='news/list_142.html' target='_self' style=''>草书字帖</a></li>
                    <li>
                        <a href='news/list_143.html' target='_self' style=''>隶书字帖</a></li>
                    <li>
                        <a href='news/list_144.html' target='_self' style=''>篆书字帖</a></li>
                    <li>
                        <a href='news/list_145.html' target='_self' style=''>钢笔字帖</a></li>
                </ul>
            </li>
            <li class='b'>
                <div class='itemMenu'>
                    <a href='news/list_135.html' style='' target='_self'>碑帖长卷</a></div>
                <ul class='subnav'>
                    <li>
                        <a href='news/list_134.html' target='_self' style=''>书法长卷</a></li>
                    <li>
                        <a href='news/list_101.html' target='_self' style=''>书法碑帖</a></li>
                    <li>
                        <a href='news/list_140.html' target='_self' style=''>墓志塔铭</a></li>
                    <li>
                        <a href='news/list_156.html' target='_self' style=''>兰亭集序</a></li>
                </ul>
            </li>
            <li class='b'>
                <div class='itemMenu'>
                    <a href='news/list_136.html' style='' target='_self'>名家书法</a></div>
                <ul class='subnav'>
                    <li>
                        <a href='news/list_139.html' target='_self' style=''>苏黄米蔡</a></li>
                    <li>
                        <a href='news/list_146.html' target='_self' style=''>颜柳欧赵</a></li>
                    <li>
                        <a href='news/list_147.html' target='_self' style=''>二王书法</a></li>
                    <li>
                        <a href='news/list_155.html' target='_self' style=''>明清书家</a></li>
                </ul>
            </li>
            <li class='b'>
                <div class='itemMenu'>
                    <a href='news/list_31.html' style='' target='_self'>书法资料</a></div>
                <ul class='subnav'>
                    <li>
                        <a href='news/list_133.html' target='_self' style=''>书法讲座</a></li>
                    <li>
                        <a href='news/list_38.html' target='_self' style=''>书法图书</a></li>
                    <li>
                        <a href='news/list_120.html' target='_self' style=''>理论知识</a></li>
                    <li>
                        <a href='news/list_157.html' target='_self' style=''>书法空间</a></li>
                    <li>
                        <a href='news/list_158.html' target='_self' style=''>敦煌书法</a></li>
                    <li>
                        <a href='news/list_159.html' target='_self' style=''>传世字画</a></li>
                </ul>
            </li>
            <li class='b'>
                <div class='itemMenu'>
                    <a href='news/list_75.html' style='' target='_self'>名家手迹</a></div>
                <ul class='subnav'>
                    <li>
                        <a href='news/list_76.html' target='_self' style=''>书法题签</a></li>
                    <li>
                        <a href='news/list_112.html' target='_self' style=''>名人手迹</a></li>
                    <li>
                        <a href='news/list_137.html' target='_self' style=''>心经书法</a></li>
                    <li>
                        <a href='news/list_154.html' target='_self' style=''>书法专题</a></li>
                </ul>
            </li>
        </ul>
        <div class='clear'></div>
    </div>
    <!--<div class="subnav">
        <div class="hotsearch">
            <marquee id='marInfo' direction='left' width='590' loop='-1' class='disClass' scrollamount='3' scrolldelay='30' onmouseover='this.stop()' onmouseout='this.start()'>
                <a href='news/10785.html' target='_blank' class='font2_2' style='color:#008000;'>◆关注“书法欣赏”微信公众号：yac8com</a>&nbsp;&nbsp;&nbsp;&nbsp;</marquee></div>
        <div class="search">
            <div>
                <form id="referForm" name="referForm" method="get" action="" onsubmit="return CheckRefForm()">
                    <input type="hidden" id="mudi2" name="mudi2" value="refer" />
                    <input type="button" class="kst" value="" />
                    <input type="text" id="refContent" name="refContent" class="inputtext" value="" />
                    <select id="refMode" name="refMode" class="searchSelect" style="width:120px;">
                        <option value='baidu'>百度站内搜索</option>
                        <option value='theme'>站内搜索(标题)</option></select>
                    <input type="submit" class="searchBtn button" value="搜 索" /></form>
            </div>
            <input type='hidden' id='zhannei_domain' name='zhannei_domain' value='so.yac8.com' />
            <input type='hidden' id='zhannei_id' name='zhannei_id' value='12241538364760410328' /></div>
    </div>
    <div class="clear"></div>-->
</div>
{{--<div class="contentBlank adClass ad3Style">
    <script type="text/javascript">OTca('ot003');</script>
    <div class="ad4Style">
        <script type="text/javascript">OTca('ot004');</script></div>
    <div class="clear"></div>
</div>--}}
