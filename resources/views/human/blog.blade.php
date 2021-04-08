@extends('layouts.human')
@section('dynamicMeta')@include('modules._meta', $datas)@endsection
@section('content')
<div id="main">
     <div class="container">
          <section id="blog">
               <div class="hgroup">
                    <h1>Blog, the News Section</h1>
                    <h2>Nullam eget tortor purus, id molestie sapien. In hac habitasse platea dictumst. Donec aliquet tellus enim, a tincidunt nulla.</h2>
                    <ul class="breadcrumb pull-right">
                         <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                         <li class="active">Blog</li>
                    </ul>
               </div>
               <div class="row">
                    <div id="leftcol" class="span8">
                         <article class="post">
                              <div class="post_header">
                                   <h3 class="post_title"><a href="single_post.html">Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo sitters amet risus.</a></h3>
                                   <div class="post_sub"><i class="icon-time"></i> March 1, 2013 <a href="single_post.html#post_comments"><i class="icon-comments-alt"></i> 6 comments</a> </div>
                              </div>
                              <div class="post_content">
                                   <figure><a href="single_post.html"><img alt="0" src="{{$commonAssetUrl}}/human/images/portfolio/p4.jpg" /></a></figure>
                                   <p>Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo sitters amet risus. Cras mattis cosi sectetut amet fermens etrsaters tum aecenas faucib sadips amets. Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo sitters amet risus. Cras mattis cosi sectetut amet fermens etrsaters tum aecenas faucib sadips amets....</p>
                                   <a href="single_post.html" class="btn btn-primary">Read More</a> </div>
                         </article>
                         <article class="post">
                              <div class="post_header">
                                   <h3 class="post_title"><a href="single_post.html">Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo sitters amet risus.</a></h3>
                                   <div class="post_sub"><i class="icon-time"></i> February 3, 2013 <a href="single_post.html#post_comments"><i class="icon-comments-alt"></i> 6 comments</a> </div>
                              </div>
                              <div class="post_content">
                                   <figure><a href="single_post.html">
                                        <iframe src="{{$commonAssetUrl}}/human/http://player.vimeo.com/video/50924290?title=0&amp;byline=0&amp;portrait=0" width="100%" height="400" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
                                        </a></figure>
                                   <p>Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo sitters amet risus. Cras mattis cosi sectetut amet fermens etrsaters tum aecenas faucib sadips amets. Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo sitters amet risus. Cras mattis cosi sectetut amet fermens etrsaters tum aecenas faucib sadips amets....</p>
                                   <a href="single_post.html" class="btn btn-primary">Read More</a> </div>
                         </article>
                         <article class="post">
                              <div class="post_header">
                                   <h3 class="post_title"><a href="single_post.html">Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo sitters amet risus.</a></h3>
                                   <div class="post_sub"><i class="icon-time"></i> January 12, 2013 <i class="icon-comments-alt"></i> 0 comments </div>
                              </div>
                              <div class="post_content">
                                   <figure><a href="single_post.html"><img alt="0" src="{{$commonAssetUrl}}/human/images/portfolio/a4.jpg" /></a></figure>
                                   <p>Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo sitters amet risus. Cras mattis cosi sectetut amet fermens etrsaters tum aecenas faucib sadips amets. Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo sitters amet risus. Cras mattis cosi sectetut amet fermens etrsaters tum aecenas faucib sadips amets....</p>
                                   <a href="single_post.html" class="btn btn-primary">Read More</a> </div>
                         </article>
                         <div class="pagination pagination-centered">
                              <ul>
                                   <li class="disabled"><a href="#">«</a></li>
                                   <li class="active"><a href="#">1</a></li>
                                   <li><a href="#">2</a></li>
                                   <li><a href="#">3</a></li>
                                   <li><a href="#">4</a></li>
                                   <li><a href="#">5</a></li>
                                   <li><a href="#">»</a></li>
                              </ul>
                         </div>
                    </div>
                    <div id="sidebar" class="span4">
                         <aside class="widget">
                              <h4>Blog Categories</h4>
                              <ul class="nav nav-tabs nav-stacked">
                                   <li class="active"><a href="#">All</a></li>
                                   <li><a href="#">News</a></li>
                                   <li><a href="#">Press</a></li>
                              </ul>
                         </aside>
                         <aside class="widget">
                              <h4>Text Widget</h4>
                              <p>Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo sitters amet risus. Cras mattis cosi sectetut amet fermens etrsaters tum aecenas faucib sadips amets.</p>
                         </aside>
                         <aside class="widget ads clearfix">
                              <h4>Ads</h4>
                              <a href="#"><img src="{{$commonAssetUrl}}/human/http://placehold.it/110" alt="" /></a> <a href="#"><img src="{{$commonAssetUrl}}/human/http://placehold.it/110" alt="" /></a> <a href="#"><img src="{{$commonAssetUrl}}/human/http://placehold.it/110" alt="" /></a> <a href="#"><img src="{{$commonAssetUrl}}/human/http://placehold.it/110" alt="" /></a> </aside>
                         <aside class="widget">
                              <h4>Tabs</h4>
                              <ul class="nav nav-tabs" id="myTab">
                                   <li class="active"><a data-toggle="tab" href="#recent">Recent</a></li>
                                   <li class=""><a data-toggle="tab" href="#tags">Tags</a></li>
                              </ul>
                              <div class="tab-content" id="myTabContent">
                                   <div id="recent" class="tab-pane fade active in">
                                        <ul class="media-list">
                                             <li class="media"> <a href="#" class="media-photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/t5.jpg)"></a> <a href="#" class="media-date">19<span>FEB</span></a>
                                                  <h5 class="media-heading"><a href="#">Media heading, this is a title of a news...</a></h5>
                                                  <p>Fugiat dapibus, tellus ac cursus commodo, ut fermentum...</p>
                                             </li>
                                             <li class="media"> <a href="#" class="media-photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/t4.jpg)"></a> <a href="#" class="media-date">18<span>FEB</span></a>
                                                  <h5 class="media-heading"><a href="#">Media heading, of a news item.</a></h5>
                                                  <p>Fugiat dapibus, tellus ac cursus commodo, condime ntum nibh, ut fermentum...</p>
                                             </li>
                                             <li class="media"> <a href="#" class="media-photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/t5.jpg)"></a> <a href="#" class="media-date">17<span>FEB</span></a>
                                                  <h5 class="media-heading"><a href="#">Media heading, this is a title of a news...</a></h5>
                                                  <p>Fugiat dapibus, tellus ac cursus commodo, ut fermentum...</p>
                                             </li>
                                             <li class="media"> <a href="#" class="media-photo" style="background-image:url({{$commonAssetUrl}}/human/images/portfolio/t4.jpg)"></a> <a href="#" class="media-date">16<span>FEB</span></a>
                                                  <h5 class="media-heading"><a href="#">Media heading, of a news item.</a></h5>
                                                  <p>Fugiat dapibus, tellus ac cursus commodo, condime ntum nibh, ut fermentum...</p>
                                             </li>
                                        </ul>
                                   </div>
                                   <div id="tags" class="tab-pane fade"> <a class="label">Default</a> <a class="label label-success">Success</a> <a class="label label-warning">Warning</a> <a class="label label-important">Important</a> <a class="label label-info">Info</a> <a class="label label-inverse">Inverse</a> <a class="label">Default</a> <a class="label label-success">Success</a> <a class="label label-important">Important</a> <a class="label label-info">Info</a> <a class="label label-inverse">Inverse</a> <a class="label">Default</a> <a class="label label-success">Success</a> <a class="label label-success">Success</a> <a class="label label-warning">Warning</a> <a class="label label-important">Important</a> <a class="label label-warning">Warning</a> <a class="label label-warning">Warning</a> <a class="label label-important">Important</a> <a class="label label-info">Info</a> <a class="label label-inverse">Inverse</a> </div>
                              </div>
                         </aside>
                    </div>
               </div>
          </section>
     </div>
    @include('human.modules._footer')
</div>
@endsection
