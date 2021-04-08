@extends('layouts.human')
@section('dynamicMeta')@include('modules._meta', $datas)@endsection
@section('content')
<div id="main">
     <div class="container">
          <section id="portfolio_item">
               <div class="hgroup">
                    <ul class="breadcrumb pull-left">
                         <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                         <li><a href="portfolio.html">Portfolio</a> <span class="divider">/</span></li>
                         <li class="active">Portfolio Item II</li>
                    </ul>
               </div>
               <div class="row">
                    <div class="span8">
                         <section id="portfolio_slider_wrapper">
                              <div class="flexslider" id="portfolio_slider">
                                   <ul class="slides">
                                        <li class="item" data-thumb="images/portfolio/item/4.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/4.jpg)">
                                             <div class="container"> <a href="images/portfolio/item/4.jpg" rel="prettyPhoto[gal]"></a>
                                                  <div class="carousel-caption">
                                                       <p class="lead">optional description of the photo</p>
                                                  </div>
                                             </div>
                                        </li>
                                        <li class="item" data-thumb="images/portfolio/item/5.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/5.jpg)">
                                             <div class="container"> <a href="images/portfolio/item/5.jpg" rel="prettyPhoto[gal]"></a>
                                                  <div class="carousel-caption">
                                                       <p class="lead">optional description of the photo</p>
                                                  </div>
                                             </div>
                                        </li>
                                        <li class="item" data-thumb="images/portfolio/item/7.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/7.jpg)">
                                             <div class="container"> <a href="images/portfolio/item/7.jpg" rel="prettyPhoto[gal]"></a>
                                                  <div class="carousel-caption">
                                                       <p class="lead">optional description of the photo</p>
                                                  </div>
                                             </div>
                                        </li>
                                        <li class="item" data-thumb="images/portfolio/item/1.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/1.jpg)">
                                             <div class="container"> <a href="images/portfolio/item/1.jpg" rel="prettyPhoto[gal]"></a>
                                                  <div class="carousel-caption">
                                                       <p class="lead">optional description of the photo</p>
                                                  </div>
                                             </div>
                                        </li>
                                        <li class="item" data-thumb="images/portfolio/item/8.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/8.jpg)">
                                             <div class="container"> <a href="images/portfolio/item/8.jpg" rel="prettyPhoto[gal]"></a>
                                                  <div class="carousel-caption">
                                                       <p class="lead">optional description of the photo</p>
                                                  </div>
                                             </div>
                                        </li>
                                        <li class="item" data-thumb="images/portfolio/item/9.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/9.jpg)">
                                             <div class="container"> <a href="images/portfolio/item/9.jpg" rel="prettyPhoto[gal]"></a>
                                                  <div class="carousel-caption">
                                                       <p class="lead">optional description of the photo</p>
                                                  </div>
                                             </div>
                                        </li>
                                        <li class="item" data-thumb="images/portfolio/item/10.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/10.jpg)">
                                             <div class="container"> <a href="images/portfolio/item/10.jpg" rel="prettyPhoto[gal]"></a>
                                                  <div class="carousel-caption">
                                                       <p class="lead">optional description of the photo</p>
                                                  </div>
                                             </div>
                                        </li>
                                        <li class="item" data-thumb="images/portfolio/item/11.jpg" style="background-image: url({{$commonAssetUrl}}/human/images/portfolio/item/11.jpg)">
                                             <div class="container"> <a href="images/portfolio/item/11.jpg" rel="prettyPhoto[gal]"></a>
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
                    </div>
                    <div class="span4">
                         <article class="portfolio_details">
                              <h3 class="well">Suspendisse potenti</h3>
                              <p class="well">In hac habitasse platea dictumst. In hac habitasse platea dictumst. Donec aliquet tellus enim, a tincidunt nulla. Praesent mollis felis at nulla fermentum mattis. Vivamus vestibulum neque quis nunc convallis venenatis. Nulla tristique lorem sit amet ipsum ornare sit amet feugiat nulla condimentum. Sed faucibus volutpat nunc, at ullamcorper augue elementum id. Quisque at lectus leo, nec placerat mi. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus fermentum sapien congue fermentum sed at lorem. </p>
                              <div class="well">
                                   <p><strong>Nulla tristique:</strong> Donec aliquet</p>
                                   <p><strong>Habitasse platea:</strong> Dictumst</p>
                                   <p><strong>Ornare sit:</strong> Ninec risus</p>
                                   <p><strong>Faucibus volutpat:</strong> Bullamcorper</p>
                              </div>
                              <a href="#" class="btn btn-danger btn-large center-block">Fermentum</a> </article>
                    </div>
               </div>
          </section>
          <ul class="pager">
               <li class="previous disabled"><a href="#">← Older</a></li>
               <li class="next"><a href="#">Newer →</a></li>
          </ul>
     </div>
    @include('human.modules._footer')
</div>
@endsection
