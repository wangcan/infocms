@extends('layouts.human')
@section('dynamicMeta')@include('modules._meta', $datas)@endsection
@section('bodyClass')class="collapsing_header"@endsection
@section('content')
<div class="full_page_photo">
     <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.gr/maps?f=q&amp;source=s_q&amp;geocode=&amp;q=london&amp;aq=&amp;sll=40.621192,22.946027&amp;sspn=0.108928,0.264187&amp;ie=UTF8&amp;hq=&amp;&amp;ll=51.517099,-0.146084&amp;spn=0.35721,1.318359&amp;t=m&amp;z=11&amp;output=embed"></iframe>
</div>
<div id="main">
     <div class="container">
          <section id="contact">
               <div class="hgroup">
                    <h1>Contact us</h1>
                    <h2>This is a subtitle used optionally for explaining more...</h2>
                    <ul class="breadcrumb pull-right">
                         <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                         <li class="active">Contact</li>
                    </ul>
               </div>
               <div class="row">
                    <div class="span4 office_address">
                         <address>
                         <strong>Twitter, Inc.</strong><br />
                         795 Folsom Ave, Suite 600<br />
                         San Francisco, CA 94107<br />
                         <abbr title="Phone">P:</abbr> (123) 456-7890
                         </address>
                         <address>
                         <strong>Full Name</strong><br />
                         <a href="mailto:#">first.last@example.com</a>
                         </address>
                    </div>
                    <div class="span8 contact_form">
                         <form />
                              <div class="row">
                                   <div class="span4">
                                        <label>Name</label>
                                        <input type="text" class="span4" />
                                   </div>
                                   <div class="span4">
                                        <label>E-mail</label>
                                        <input type="text" class="span4" />
                                   </div>
                                   <div class="span8">
                                        <label>Subject</label>
                                        <input type="text" class="span8" />
                                   </div>
                                   <div class="span8">
                                        <label>Message</label>
                                        <textarea rows="8" class="span8"></textarea>
                                   </div>
                                   <div class="span8"> <a class="btn btn-large btn-success"><span>Submit Message</span></a> </div>
                              </div>
                         </form>
                    </div>
               </div>
          </section>
          <!--END Contact-->
     </div>
    @include('human.modules._footer')
</div>
@endsection
