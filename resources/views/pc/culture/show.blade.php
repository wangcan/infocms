@extends('layouts.culture')
@inject('culturePresenter', 'App\Presenters\Infocms\CulturePresenter')
@section('subnav')
<div class="mainMenu">
    <div class="subnav">
        <div class="hotsearch">
            <span class='font2_2'>当前位置：</span>
            <a href='../'>首页</a>&nbsp;&gt;&nbsp;
            <a href='../news/list_5.html' target='_self'>书法篆刻</a>&nbsp;&gt;&nbsp;
            <a href='../news/list_33.html' target='_self'>毛笔书法</a>
        </div>
    </div>
    <div class="clear"></div>
</div>
@endsection
@section('main')
    <input type="hidden" id="contentImgMaxWidth" name="contentImgMaxWidth" value="665" />
    <div id="mainBody">
        <div class="areaL">
            <div class="webBox">
                <div class="a">
                    <h1>{{$datas['info']['name']}}</h1>
                    <div class="addi2">时间：2020-3-26 7:14:57&nbsp;&nbsp; 作者：书法欣赏&nbsp;&nbsp; 来源：www.yac8.com&nbsp;&nbsp; 阅读：
                        <span id="infoReadNum">58</span>&nbsp;&nbsp; 评论：
                        <span id="infoReplyNum">0</span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="b">
                    <div class="note"><b>内容摘要：</b>{{$datas['info']['description']}}</div>
                    <div id="newsContent">
                        {!!$datas['info']->formatContent()!!}
                        {{--@include('culture.module._show-content-page')--}}
                    </div>
                    {{--@include('culture.module._show-content-share')--}}
                </div>
                <div class="c">
                    上一篇：{!!$culturePresenter->preInfoStr($datas['info'], ['where' => ['category_code' => $datas['info']['category_code']]])!!}
                    <br />下一篇：{!!$culturePresenter->nextInfoStr($datas['info'], ['where' => ['category_code' => $datas['info']['category_code']]])!!}
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="areaR">
            <div class="hotRank">
                <div class="title"><h2>书法篆刻</h2></div>
                <div class="content">
                    <dl>
                        <dd class="liBox1" style="min-height:auto;height:auto;">
                            <ul>
                                @foreach ($culturePresenter->getCategoryDatas(8, ['code' => $datas['info']['category_code']]) as $pData)
                                <li><a href='{{$pData->getUrl()}}'>{{$pData['name']}}</a></li>
                                @endforeach
                            </ul>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="clear"></div>
            <div class="height5"></div>
            <div class="clear"></div>
            <div class="hotRank">
                <div class="title"><h2>热点排行</h2></div>
                <div class="content">
                    <ul>
                        <li>
                            <div class='img'>
                                <a href='../news/72.html' class='font1_2' target='_blank'>
                                    <img src='{{$commonAssetUrl}}/culture/img/247fc-6065.jpg' onerror="if (this.value!='1'){this.value='1';this.src='{{$commonAssetUrl}}/culture/m/img/97a63-8488.gif';}" alt="苏适行书书法作品欣赏" width='70' height='90' /></a>
                            </div>
                            <div class='info'>
                                <div class='ft'>
                                    <a href='../news/72.html' style='font-weight:bold;' class='font1_2' target='_blank' title="苏适行书书法作品欣赏">苏适行书书法作品欣赏</a></div>
                                <p>苏适1935年生，祖籍山东省青州市，后移居北京。早年从师魏长青、杜襄、专攻魏碑和李北海、王义之诸家。...&nbsp;
                                    <a href='../news/72.html' class='font2_2' target='_blank'>阅读全文>></a></p>
                            </div>
                            <div class='clear'></div>
                        </li>
                        <li class='line'></li>
                        <li style='width:100%;height:21px;line-height:21px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/72.html' class='font1_2' style='color:#FF0000;' target='_blank' title="苏适行书书法作品欣赏">苏适行书书法作品欣赏</a></li>
                        <li style='width:100%;height:21px;line-height:21px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/9945.html' class='font1_2' style='color:#0000ff;' target='_blank' title="广西谭华行草书法作品欣赏">广西谭华行草书法作品欣赏</a></li>
                        <li style='width:100%;height:21px;line-height:21px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/8733.html' class='font1_2' style='color:#008000;' target='_blank' title="周慧珺书法集萃网络展示专辑">周慧珺书法集萃网络展示专辑</a></li>
                        <li style='width:100%;height:21px;line-height:21px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/7028.html' class='font1_2' style='color:#ff0000;' target='_blank' title="田英章毛笔书法作品欣赏">田英章毛笔书法作品欣赏</a></li>
                        <li style='width:100%;height:21px;line-height:21px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/101.html' class='font1_2' style='' target='_blank' title="田英章书法作品欣赏">田英章书法作品欣赏</a></li>
                        <li style='width:100%;height:21px;line-height:21px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/6816.html' class='font1_2' style='' target='_blank' title="当代书坛巨匠书法作品欣赏">当代书坛巨匠书法作品欣赏</a></li>
                        <li style='width:100%;height:21px;line-height:21px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/7023.html' class='font1_2' style='color:#0000ff;' target='_blank' title="启功书法作品欣赏">启功书法作品欣赏</a></li>
                        <li style='width:100%;height:21px;line-height:21px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/8699.html' class='font1_2' style='' target='_blank' title="孙晓云书法作品展示专辑">孙晓云书法作品展示专辑</a></li>
                        <li style='width:100%;height:21px;line-height:21px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/5458.html' class='font1_2' style='color:#0000ff;' target='_blank' title="梁光彩行草书法作品欣赏">梁光彩行草书法作品欣赏</a></li>
                        <li style='width:100%;height:21px;line-height:21px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/9934.html' class='font1_2' style='color:#0000ff;' target='_blank' title="刘大勇题字书法作品欣赏">刘大勇题字书法作品欣赏</a></li>
                        <li style='width:100%;height:21px;line-height:21px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/6339.html' class='font1_2' style='' target='_blank' title="杨再春毛笔书法欣赏">杨再春毛笔书法欣赏</a></li>
                        <li style='width:100%;height:21px;line-height:21px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/9710.html' class='font1_2' style='color:#0000ff;' target='_blank' title="苏泽立书法行书作品欣赏">苏泽立书法行书作品欣赏</a></li>
                        <li style='width:100%;height:21px;line-height:21px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/3797.html' class='font1_2' style='color:#FF0000;' target='_blank' title="张旭光行草书法作品欣赏">张旭光行草书法作品欣赏</a></li>
                    </ul>
                </div>
            </div>
            <div class="height5"></div>
            {{--@include('culture.modules._show-right-picture')--}}
            <div class="clear"></div>
            <div class="height5"></div>
            <div class="clear"></div>
            <div class="hotRank">
                <div class="title">
                    <h2>推荐精选</h2></div>
                <div class="content">
                    <ul>
                        <li style='width:100%;height:20px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/72.html' class='font1_2' style='color:#FF0000;' target='_blank' title="苏适行书书法作品欣赏">苏适行书书法作品欣赏</a></li>
                        <div class='clear'></div>
                        <li style='width:100%;height:20px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/9945.html' class='font1_2' style='color:#0000ff;' target='_blank' title="广西谭华行草书法作品欣赏">广西谭华行草书法作品欣赏</a></li>
                        <div class='clear'></div>
                        <li style='width:100%;height:20px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/8733.html' class='font1_2' style='color:#008000;' target='_blank' title="周慧珺书法集萃网络展示专辑">周慧珺书法集萃网络展示专辑</a></li>
                        <div class='clear'></div>
                        <li style='width:100%;height:20px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/7028.html' class='font1_2' style='color:#ff0000;' target='_blank' title="田英章毛笔书法作品欣赏">田英章毛笔书法作品欣赏</a></li>
                        <div class='clear'></div>
                        <li style='width:100%;height:20px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/101.html' class='font1_2' style='' target='_blank' title="田英章书法作品欣赏">田英章书法作品欣赏</a></li>
                        <div class='clear'></div>
                        <li style='width:100%;height:20px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/6816.html' class='font1_2' style='' target='_blank' title="当代书坛巨匠书法作品欣赏">当代书坛巨匠书法作品欣赏</a></li>
                        <div class='clear'></div>
                        <li style='width:100%;height:20px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/7023.html' class='font1_2' style='color:#0000ff;' target='_blank' title="启功书法作品欣赏">启功书法作品欣赏</a></li>
                        <div class='clear'></div>
                        <li style='width:100%;height:20px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/8699.html' class='font1_2' style='' target='_blank' title="孙晓云书法作品展示专辑">孙晓云书法作品展示专辑</a></li>
                        <div class='clear'></div>
                        <li style='width:100%;height:20px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/5458.html' class='font1_2' style='color:#0000ff;' target='_blank' title="梁光彩行草书法作品欣赏">梁光彩行草书法作品欣赏</a></li>
                        <div class='clear'></div>
                        <li style='width:100%;height:20px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/9934.html' class='font1_2' style='color:#0000ff;' target='_blank' title="刘大勇题字书法作品欣赏">刘大勇题字书法作品欣赏</a></li>
                        <div class='clear'></div>
                        <li style='width:100%;height:20px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/6339.html' class='font1_2' style='' target='_blank' title="杨再春毛笔书法欣赏">杨再春毛笔书法欣赏</a></li>
                        <div class='clear'></div>
                        <li style='width:100%;height:20px;overflow:hidden;'>
                            <a href='../news/list_33.html' class='font2_1'>[毛笔书法]</a>
                            <a href='../news/9710.html' class='font1_2' style='color:#0000ff;' target='_blank' title="苏泽立书法行书作品欣赏">苏泽立书法行书作品欣赏</a></li>
                        <div class='clear'></div>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="height10"></div>

<script language="javascript" type="text/javascript" src="{{$commonAssetUrl}}/culture/js/replyandmessage.js"></script>
<script language="javascript" type="text/javascript" src="{{$commonAssetUrl}}/culture/js/newsshow.js"></script>

@endsection
