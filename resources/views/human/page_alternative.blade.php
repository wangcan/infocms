@extends('layouts.human')
@section('dynamicMeta')@include('modules._meta', $datas)@endsection
@section('content')
<div id="main">
     <div class="container">
          <section id="about_us">
               <div class="hgroup">
                    <h1>About us</h1>
                    <h2>This is the contained, plain style of the about us page. There is also the <a href="about_us.html">collapsing header version</a> you should definitely visit!</h2>
                    <ul class="breadcrumb pull-right">
                         <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                         <li class="active">About us</li>
                    </ul>
               </div>
               <figure><img src="{{$commonAssetUrl}}/human/images/promo_13.jpg" class="img-rounded" alt="1" /></figure>
               <article>
                    <div class="row">
                         <div class="span8">
                              <p>In hac habitasse platea dictumst. In hac habitasse platea dictumst. Donec aliquet tellus enim, a tincidunt nulla. Praesent mollis felis at nulla fermentum mattis. Vivamus vestibulum neque quis nunc convallis venenatis. Nulla tristique lorem sit amet ipsum ornare sit amet feugiat nulla condimentum. Sed faucibus volutpat nunc, at ullamcorper augue elementum id. Quisque at lectus leo, nec placerat mi. Curabitur egestas eleifend interdum. Suspendisse potenti. Suspendisse nec risus fermentum sapien congue fermentum sed at lorem. Suspendisse quis sem lorem, a euismod nisl. Nullam eget tortor purus, id molestie sapien. In hac habitasse platea dictumst. Donec aliquet tellus enim, a tincidunt nulla. </p>
                         </div>
                         <div class="span4">
                              <blockquote>
                                   <p>In hac habitasse platea dictumst. Suspendisse non tellus ligula. Morbi molestie feugiat tortor a hendrerit. Ut suscipit, orci eget tristique varius, arcu nibh commodo nisl, a sagittis justo ipsum vel nulla. In semper est iaculis elit pellentesque volutpat. Aenean orci ante, auctor ut egestas ac, gravida non orci.</p>
                                   <small>Someone famous in <cite title="Source Title">Source Title</cite></small> </blockquote>
                         </div>
                    </div>
                    <section class="call_to_action"> <img alt="responsive" src="{{$commonAssetUrl}}/human/images/star.png" />
                         <h3>give your creative ideas a boost</h3>
                         <h4>mouse over our team photos to see a cool effect!</h4>
                    </section>
                    <h2 class="section_header">Meet our Team... <small>they are always up to something good!</small></h2>
                    <div class="row">
                         <div class="span3 team_member">
                              <figure style="background-image: url({{$commonAssetUrl}}/human/images/1b.jpg)"><img src="{{$commonAssetUrl}}/human/images/1a.jpg" alt="1a" /></figure>
                              <h5>Johny Boycot</h5>
                              <small>Web-Developer / Founder</small>
                              <hr />
                              <div class="team_social"> <a href="#facebook"><i class="icon icon-facebook"></i></a> <a href="#twitter"><i class="icon icon-twitter"></i></a> <a href="#pinterest"><i class="icon icon-linkedin"></i></a> <a href="#googleplus"><i class="icon icon-google-plus"></i></a> </div>
                              <p class="short_bio">In hac habitasse platea dictumst. Suspendisse non tellus ligula. Morbi molestie feugiat tortor a hendrerit.</p>
                         </div>
                         <div class="span3 team_member">
                              <figure style="background-image: url({{$commonAssetUrl}}/human/images/2b.jpg)"><img src="{{$commonAssetUrl}}/human/images/2a.jpg" alt="2a" /></figure>
                              <h5>Lisa Starborn</h5>
                              <small>Designer / Founder</small>
                              <hr />
                              <div class="team_social"> <a href="#facebook"><i class="icon icon-facebook"></i></a> <a href="#twitter"><i class="icon icon-twitter"></i></a> <a href="#pinterest"><i class="icon icon-linkedin"></i></a> <a href="#googleplus"><i class="icon icon-google-plus"></i></a> </div>
                              <p class="short_bio">In hac habitasse platea dictumst. Suspendisse non tellus ligula. Morbi molestie feugiat tortor a hendrerit.</p>
                         </div>
                         <div class="span3 team_member">
                              <figure style="background-image: url({{$commonAssetUrl}}/human/images/3b.jpg)"><img src="{{$commonAssetUrl}}/human/images/3a.jpg" alt="3a" /></figure>
                              <h5>Ben Folklore</h5>
                              <small>Photographer / Model</small>
                              <hr />
                              <div class="team_social"> <a href="#facebook"><i class="icon icon-facebook"></i></a> <a href="#twitter"><i class="icon icon-twitter"></i></a> <a href="#pinterest"><i class="icon icon-linkedin"></i></a> <a href="#googleplus"><i class="icon icon-google-plus"></i></a> </div>
                              <p class="short_bio">In hac habitasse platea dictumst. Suspendisse non tellus ligula. Morbi molestie feugiat tortor a hendrerit.</p>
                         </div>
                         <div class="span3 team_member">
                              <figure style="background-image: url({{$commonAssetUrl}}/human/images/4b.jpg)"><img src="{{$commonAssetUrl}}/human/images/4a.jpg" alt="4a" /></figure>
                              <h5>Danny Stronghold</h5>
                              <small>Handsome / Driver</small>
                              <hr />
                              <div class="team_social"> <a href="#facebook"><i class="icon icon-facebook"></i></a> <a href="#twitter"><i class="icon icon-twitter"></i></a> <a href="#pinterest"><i class="icon icon-linkedin"></i></a> <a href="#googleplus"><i class="icon icon-google-plus"></i></a> </div>
                              <p class="short_bio">In hac habitasse platea dictumst. Suspendisse non tellus ligula. Morbi molestie feugiat tortor a hendrerit.</p>
                         </div>
                    </div>
               </article>
          </section>
     </div>
    @include('human.modules._footer')
</div>
@endsection
