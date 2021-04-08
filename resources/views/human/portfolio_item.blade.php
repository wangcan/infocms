@extends('layouts.human')
@section('dynamicMeta')@include('modules._meta', $datas)@endsection
@section('content')
<div id="main">
     <div class="container">
          <section id="portfolio_item">
               <div class="hgroup">
                    <h1>Portfolio item title</h1>
                    <h2>Description of the project dapibus, tellus ac cursus commodo, there is also <a href="portfolio_item_2.html"><strong>another layout for portfolio item</strong></a>, ut fermentum...</h2>
                    <ul class="breadcrumb pull-right">
                         <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                         <li><a href="portfolio.html">Portfolio</a> <span class="divider">/</span></li>
                         <li class="active">Portfolio Item</li>
                    </ul>
               </div>
               <section id="portfolio_slider_wrapper">
                    <div class="flexslider" id="portfolio_slider">
                         <ul class="slides">
                              <li class="item" data-thumb="{{$commonAssetUrl}}/human/images/portfolio/item/4.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/4.jpg)">
                                   <div class="container"> <a href="{{$commonAssetUrl}}/human/images/portfolio/item/4.jpg" rel="prettyPhoto[gal]"></a>
                                        <div class="carousel-caption">
                                             <p class="lead">optional description of the photo</p>
                                        </div>
                                   </div>
                              </li>
                              <li class="item" data-thumb="{{$commonAssetUrl}}/human/images/portfolio/item/5.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/5.jpg)">
                                   <div class="container"> <a href="{{$commonAssetUrl}}/human/images/portfolio/item/5.jpg" rel="prettyPhoto[gal]"></a>
                                        <div class="carousel-caption">
                                             <p class="lead">optional description of the photo</p>
                                        </div>
                                   </div>
                              </li>
                              <li class="item" data-thumb="{{$commonAssetUrl}}/human/images/portfolio/item/7.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/7.jpg)">
                                   <div class="container"> <a href="{{$commonAssetUrl}}/human/images/portfolio/item/7.jpg" rel="prettyPhoto[gal]"></a>
                                        <div class="carousel-caption">
                                             <p class="lead">optional description of the photo</p>
                                        </div>
                                   </div>
                              </li>
                              <li class="item" data-thumb="{{$commonAssetUrl}}/human/images/portfolio/item/1.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/1.jpg)">
                                   <div class="container"> <a href="{{$commonAssetUrl}}/human/images/portfolio/item/1.jpg" rel="prettyPhoto[gal]"></a>
                                        <div class="carousel-caption">
                                             <p class="lead">optional description of the photo</p>
                                        </div>
                                   </div>
                              </li>
                              <li class="item" data-thumb="{{$commonAssetUrl}}/human/images/portfolio/item/8.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/8.jpg)">
                                   <div class="container"> <a href="{{$commonAssetUrl}}/human/images/portfolio/item/8.jpg" rel="prettyPhoto[gal]"></a>
                                        <div class="carousel-caption">
                                             <p class="lead">optional description of the photo</p>
                                        </div>
                                   </div>
                              </li>
                              <li class="item" data-thumb="{{$commonAssetUrl}}/human/images/portfolio/item/9.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/9.jpg)">
                                   <div class="container"> <a href="{{$commonAssetUrl}}/human/images/portfolio/item/9.jpg" rel="prettyPhoto[gal]"></a>
                                        <div class="carousel-caption">
                                             <p class="lead">optional description of the photo</p>
                                        </div>
                                   </div>
                              </li>
                              <li class="item" data-thumb="{{$commonAssetUrl}}/human/images/portfolio/item/10.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/10.jpg)">
                                   <div class="container"> <a href="{{$commonAssetUrl}}/human/images/portfolio/item/10.jpg" rel="prettyPhoto[gal]"></a>
                                        <div class="carousel-caption">
                                             <p class="lead">optional description of the photo</p>
                                        </div>
                                   </div>
                              </li>
                              <li class="item" data-thumb="{{$commonAssetUrl}}/human/images/portfolio/item/11.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/11.jpg)">
                                   <div class="container"> <a href="{{$commonAssetUrl}}/human/images/portfolio/item/11.jpg" rel="prettyPhoto[gal]"></a>
                                        <div class="carousel-caption">
                                             <p class="lead">optional description of the photo</p>
                                        </div>
                                   </div>
                              </li>
                         </ul>
                    </div>
                    <div id="carousel" class="flexslider">
                         <ul class="slides">
                              <li> <img src="{{$commonAssetUrl}}/human/images/portfolio/item/4.jpg" alt="" /> </li>
                              <li> <img src="{{$commonAssetUrl}}/human/images/portfolio/item/5.jpg" alt="" /> </li>
                              <li> <img src="{{$commonAssetUrl}}/human/images/portfolio/item/7.jpg" alt="" /> </li>
                              <li> <img src="{{$commonAssetUrl}}/human/images/portfolio/item/1.jpg" alt="" /> </li>
                              <li> <img src="{{$commonAssetUrl}}/human/images/portfolio/item/8.jpg" alt="" /> </li>
                              <li> <img src="{{$commonAssetUrl}}/human/images/portfolio/item/9.jpg" alt="" /> </li>
                              <li> <img src="{{$commonAssetUrl}}/human/images/portfolio/item/10.jpg" alt="" /> </li>
                              <li> <img src="{{$commonAssetUrl}}/human/images/portfolio/item/11.jpg" alt="" /> </li>
                         </ul>
                    </div>
               </section>
               <article>
                    <div class="row">
                         <div class="span9">
                              <p class="well">In hac habitasse platea dictumst. In hac habitasse platea dictumst. Donec aliquet tellus enim, a tincidunt nulla. Praesent mollis felis at nulla fermentum mattis. Vivamus vestibulum neque quis nunc convallis venenatis. Nulla tristique lorem sit amet ipsum ornare sit amet feugiat nulla condimentum. Sed faucibus volutpat nunc, at ullamcorper augue elementum id. Quisque at lectus leo, nec placerat mi. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus fermentum sapien congue fermentum sed at lorem. Suspendisse quis sem lorem, a euismod nisl. Nullam eget tortor purus, id molestie sapien. In hac habitasse platea dictumst. Donec aliquet tellus enim, a tincidunt nulla. </p>
                         </div>
                         <div class="span3 well border-box">
                              <p><strong>Nulla tristique:</strong> Donec aliquet</p>
                              <p><strong>Habitasse platea:</strong> Dictumst</p>
                              <p><strong>Ornare sit:</strong> Ninec risus</p>
                              <p><strong>Faucibus volutpat:</strong> Bullamcorper</p>
                         </div>
                    </div>
               </article>
               <ul class="pager">
                    <li class="previous disabled"><a href="#">← Older</a></li>
                    <li class="next"><a href="#">Newer →</a></li>
               </ul>
          </section>
     </div>
    @include('human.modules._footer')
</div>
@endsection
