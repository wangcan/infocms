@extends('layouts.human')
@section('dynamicMeta')@include('modules._meta', $datas)@endsection
@section('content')
<div id="main">
     <div class="container">
          <div class="hgroup">
               <h1>Portfolio</h1>
               <h2>This could be a showcase of your work! We are using the Isotope Jquery plugin to filter results. 
                    This is the<strong> strict version</strong>, you should also check out the<a href="gallery.html"><strong> great Masonry version</strong></a>. All photos &copy; by <a href="http://www.cssmoban.com/" target="_blank">Dimitra Giannouka</a>.</h2>
               <ul class="breadcrumb pull-right">
                    <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                    <li class="active">Portfolio</li>
               </ul>
          </div>
          <ul id="portfolio_filters">
               <li><a href="#" data-filter="*">show all</a></li>
               <li><a href="#" data-filter=".cat_artists">artists</a></li>
               <li><a href="#" data-filter=".cat_people">people</a></li>
               <li><a href="#" data-filter=".cat_travel">travel</a></li>
               <li><a href="#" data-filter=".cat_poetic">poetic</a></li>
          </ul>
          <div id="portfolio_container" class="portfolio_strict row">
               <div class="portfolio_item cat_travel span4">
                    <div class="portfolio_photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/t5.jpg)"> <a href="portfolio_item.html"> <i class="icon-2x icon-external-link"></i>
                         <p>Description of the project dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum...</p>
                         </a> </div>
                    <div class="portfolio_description">
                         <h3><a href="portfolio_item.html">Lorem Ipsum</a></h3>
                         <p>travel</p>
                    </div>
               </div>
               <div class="portfolio_item cat_people span4">
                    <div class="portfolio_photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/p4.jpg)"> <a href="portfolio_item.html"> <i class="icon-2x icon-external-link"></i>
                         <p>Description of the project dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum...</p>
                         </a> </div>
                    <div class="portfolio_description">
                         <h3><a href="portfolio_item.html">Lorem Ipsum</a></h3>
                         <p>people</p>
                    </div>
               </div>
               <div class="portfolio_item cat_artists span4">
                    <div class="portfolio_photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/a3.jpg)"> <a href="portfolio_item.html"> <i class="icon-2x icon-external-link"></i>
                         <p>Description of the project dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum...</p>
                         </a> </div>
                    <div class="portfolio_description">
                         <h3><a href="portfolio_item.html">Lorem Ipsum</a></h3>
                         <p>artists</p>
                    </div>
               </div>
               <div class="portfolio_item cat_people span4">
                    <div class="portfolio_photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/p3.jpg)"> <a href="portfolio_item.html"> <i class="icon-2x icon-external-link"></i>
                         <p>Description of the project dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum...</p>
                         </a> </div>
                    <div class="portfolio_description">
                         <h3><a href="portfolio_item.html">Lorem Ipsum</a></h3>
                         <p>people</p>
                    </div>
               </div>
               <div class="portfolio_item cat_travel span4">
                    <div class="portfolio_photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/t3.jpg)"> <a href="portfolio_item.html"> <i class="icon-2x icon-external-link"></i>
                         <p>Description of the project dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum...</p>
                         </a> </div>
                    <div class="portfolio_description">
                         <h3><a href="portfolio_item.html">Lorem Ipsum</a></h3>
                         <p>travel</p>
                    </div>
               </div>
               <div class="portfolio_item cat_people span4">
                    <div class="portfolio_photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/p1.jpg)"> <a href="portfolio_item.html"> <i class="icon-2x icon-external-link"></i>
                         <p>Description of the project dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum...</p>
                         </a> </div>
                    <div class="portfolio_description">
                         <h3><a href="portfolio_item.html">Lorem Ipsum</a></h3>
                         <p>people</p>
                    </div>
               </div>
               <div class="portfolio_item cat_poetic span4">
                    <div class="portfolio_photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/b3.jpg)"> <a href="portfolio_item.html"> <i class="icon-2x icon-external-link"></i>
                         <p>Description of the project dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum...</p>
                         </a> </div>
                    <div class="portfolio_description">
                         <h3><a href="portfolio_item.html">Lorem Ipsum</a></h3>
                         <p>poetic</p>
                    </div>
               </div>
               <div class="portfolio_item cat_artists span4">
                    <div class="portfolio_photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/a4.jpg)"> <a href="portfolio_item.html"> <i class="icon-2x icon-external-link"></i>
                         <p>Description of the project dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum...</p>
                         </a> </div>
                    <div class="portfolio_description">
                         <h3><a href="portfolio_item.html">Lorem Ipsum</a></h3>
                         <p>artists</p>
                    </div>
               </div>
               <div class="portfolio_item cat_travel span4">
                    <div class="portfolio_photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/t4.jpg)"> <a href="portfolio_item.html"> <i class="icon-2x icon-external-link"></i>
                         <p>Description of the project dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum...</p>
                         </a> </div>
                    <div class="portfolio_description">
                         <h3><a href="portfolio_item.html">Lorem Ipsum</a></h3>
                         <p>travel</p>
                    </div>
               </div>
               <div class="portfolio_item cat_artists span4">
                    <div class="portfolio_photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/a5.jpg)"> <a href="portfolio_item.html"> <i class="icon-2x icon-external-link"></i>
                         <p>Description of the project dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum...</p>
                         </a> </div>
                    <div class="portfolio_description">
                         <h3><a href="portfolio_item.html">Lorem Ipsum</a></h3>
                         <p>artists</p>
                    </div>
               </div>
               <div class="portfolio_item cat_poetic span4">
                    <div class="portfolio_photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/b5.jpg)"> <a href="portfolio_item.html"> <i class="icon-2x icon-external-link"></i>
                         <p>Description of the project dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum...</p>
                         </a> </div>
                    <div class="portfolio_description">
                         <h3><a href="portfolio_item.html">Lorem Ipsum</a></h3>
                         <p>poetic</p>
                    </div>
               </div>
               <div class="portfolio_item cat_artists span4">
                    <div class="portfolio_photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/a1.jpg)"> <a href="portfolio_item.html"> <i class="icon-2x icon-external-link"></i>
                         <p>Description of the project dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum...</p>
                         </a> </div>
                    <div class="portfolio_description">
                         <h3><a href="portfolio_item.html">Lorem Ipsum</a></h3>
                         <p>artists</p>
                    </div>
               </div>
          </div>
     </div>
    @include('human.modules._footer')
</div>
@endsection
