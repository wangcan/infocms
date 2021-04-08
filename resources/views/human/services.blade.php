@extends('layouts.human')
@section('dynamicMeta')@include('modules._meta', $datas)@endsection
@section('bodyClass')class="collapsing_header"@endsection
@section('content')
<div class="full_page_photo" style="background-image: url({{$commonAssetUrl}}/human/images/services.jpg);">
     <div class="container">
          <section class="call_to_action">
               <h3 class="animated bounceInDown">we design <strong>value</strong> into profit</h3>
               <br />
               <h4 class="animated bounceInUp">our <strong>customers</strong> are always <strong>happy</strong>!</h4>
          </section>
     </div>
</div>
<div id="main">
     <div class="container">
          <section id="services">
               <div class="hgroup">
                    <h1>Services</h1>
                    <h2>Nullam eget tortor purus, id molestie sapien. In hac habitasse platea dictumst. Donec aliquet tellus enim, a tincidunt nulla.</h2>
                    <ul class="breadcrumb pull-right">
                         <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                         <li class="active">Services</li>
                    </ul>
               </div>
               <div class="row-fluid service_teaser">
                    <div class="span4 teaser_photo"> <img src="{{$commonAssetUrl}}/human/images/der.jpg" alt="a" class="img-rounded" /> </div>
                    <div class="span8">
                         <h3>Clean, Responsive Design</h3>
                         <p>{re}<strong>start</strong> is a multipurpose but <strong>mainly business oriented</strong> design, built to serve as a foundation for your web projects. It is built upon Bootstrap, a front-end development framework with a steep learning curve. It comes with a style.less file that tries to use <strong>all the power of {less} and bootstrap combined</strong>. Suspendisse nec risus fermentum sapien congue fermentum sed at lorem. Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo.Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo. </p>
                         <p>&nbsp;</p>
                         <hr />
                         <div class="row-fluid">
                              <div class="span6 service">
                                   <figure class="span4"> <i class="icon-bullhorn blue"></i> </figure>
                                   <div class="desc span8">
                                        <h4>Fermentum mas justo sitters</h4>
                                        <p>Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo. </p>
                                   </div>
                              </div>
                              <div class="span6 service">
                                   <figure class="span4"> <i class="icon-user-md blue"></i> </figure>
                                   <div class="desc span8">
                                        <h4>Fermentum mas justo sitters</h4>
                                        <p>Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo. </p>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </section>
          <div class="row pricing_wrapper">
               <div class="span4">
                    <div class="pricing_plan">
                         <h3>Lite<strong>Plan</strong> <small>this is what you should choose</small></h3>
                         <div class="the_price"><span>$</span>150<small>/year</small></div>
                         <div class="the_offerings">
                              <p> <strong>1</strong> Design Template </p>
                              <p> <strong>2</strong> Revisions </p>
                              <p> <strong>5</strong> HTML Pages </p>
                         </div>
                         <a href="#" class="btn btn-primary btn-large">Get it Now!</a> </div>
               </div>
               <div class="span4">
                    <div class="pricing_plan special">
                         <h3>Medium<strong>Plan</strong> <small>this is what you should choose</small></h3>
                         <div class="the_price"><span>$</span>250<small>/year</small></div>
                         <div class="the_offerings">
                              <p> <strong>1</strong> Design Template </p>
                              <p> <strong>2</strong> Revisions </p>
                              <p> <strong>5</strong> HTML Pages </p>
                         </div>
                         <a href="#" class="btn btn-primary btn-large">Get it Now!</a> </div>
               </div>
               <div class="span4">
                    <div class="pricing_plan">
                         <h3>Pro<strong>Plan</strong> <small>this is what you should choose</small></h3>
                         <div class="the_price"><span>$</span>350<small>/year</small></div>
                         <div class="the_offerings">
                              <p> <strong>1</strong> Design Template </p>
                              <p> <strong>2</strong> Revisions </p>
                              <p> <strong>5</strong> HTML Pages </p>
                         </div>
                         <a href="#" class="btn btn-primary btn-large">Get it Now!</a> </div>
               </div>
          </div>
          <div class="row">
               <div class="span3 service text-center">
                    <figure> <i class="icon-cloud-download"></i> </figure>
                    <div class="desc">
                         <h4>Fermentum mas justo sitters</h4>
                         <p>Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo. </p>
                    </div>
               </div>
               <div class="span3 service text-center">
                    <figure> <i class="icon-beaker"></i> </figure>
                    <div class="desc">
                         <h4>Fermentum mas justo sitters</h4>
                         <p>Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo. </p>
                    </div>
               </div>
               <div class="span3 service text-center">
                    <figure> <i class="icon-group"></i> </figure>
                    <div class="desc">
                         <h4>Fermentum mas justo sitters</h4>
                         <p>Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo. </p>
                    </div>
               </div>
               <div class="span3 service text-center">
                    <figure> <i class="icon-thumbs-up"></i> </figure>
                    <div class="desc">
                         <h4>Fermentum mas justo sitters</h4>
                         <p>Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo. </p>
                    </div>
               </div>
          </div>
     </div>
    @include('human.modules._footer')
</div>
@endsection
