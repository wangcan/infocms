@extends('layouts.human')
@section('dynamicMeta')@include('modules._meta', $datas)@endsection
@section('content')
<div id="main">
     <div class="container">
          <section id="typography">
               <div class="hgroup">
                    <h1>Bootstrap Elements</h1>
                    <ul class="breadcrumb pull-right">
                         <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                         <li class="active">Bootstrap Elements</li>
                    </ul>
               </div>
               <article>
                    <div class="row">
                         <div class="span4">
                              <div class="well">
                                   <h1>h1. Heading 1</h1>
                                   <h2>h2. Heading 2</h2>
                                   <h3>h3. Heading 3</h3>
                                   <h4>h4. Heading 4</h4>
                                   <h5>h5. Heading 5</h5>
                                   <h6>h6. Heading 6</h6>
                              </div>
                         </div>
                         <div class="span4">
                              <h3>Example body text</h3>
                              <p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                              <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui.</p>
                         </div>
                         <div class="span4">
                              <h3>Example addresses</h3>
                              <address>
                              <strong>Twitter, Inc.</strong><br />
                              795 Folsom Ave, Suite 600<br />
                              San Francisco, CA 94107<br />
                              <abbr title="Phone">P:</abbr> (123) 456-7890
                              </address>
                              <address>
                              <strong>Full Name</strong><br />
                              <a href="mailto:#">first.last@gmail.com</a>
                              </address>
                         </div>
                    </div>
                    <div class="row">
                         <div class="span6">
                              <blockquote>
                                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                   <small>Someone famous in <cite title="Source Title">Source Title</cite></small> </blockquote>
                         </div>
                         <div class="span6">
                              <blockquote class="pull-right">
                                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                   <small>Someone famous in <cite title="Source Title">Source Title</cite></small> </blockquote>
                         </div>
                    </div>
                    <div class="row">
                         <div class="span12">
                              <div class="alert alert-block"> <a class="close">×</a>
                                   <h4 class="alert-heading">Alert block</h4>
                                   <p>Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                         <div class="span4">
                              <div class="alert alert-error"> <a class="close">×</a> <strong>Error</strong> Change a few things up and try submitting again. </div>
                         </div>
                         <div class="span4">
                              <div class="alert alert-success"> <a class="close">×</a> <strong>Success</strong> You successfully read this important alert message. </div>
                         </div>
                         <div class="span4">
                              <div class="alert alert-info"> <a class="close">×</a> <strong>Information</strong> This alert needs your attention, but it's not super important. </div>
                         </div>
                    </div>
                    <table class="table table-bordered table-striped">
                         <thead>
                              <tr>
                                   <th>Button</th>
                                   <th>class=""</th>
                                   <th>Description</th>
                              </tr>
                         </thead>
                         <tbody>
                              <tr>
                                   <td><button class="btn" type="button">Default</button></td>
                                   <td><code>btn</code></td>
                                   <td>Standard gray button with gradient</td>
                              </tr>
                              <tr>
                                   <td><button class="btn btn-primary" type="button">Primary</button></td>
                                   <td><code>btn btn-primary</code></td>
                                   <td>Provides extra visual weight and identifies the primary action in a set of buttons</td>
                              </tr>
                              <tr>
                                   <td><button class="btn btn-info" type="button">Info</button></td>
                                   <td><code>btn btn-info</code></td>
                                   <td>Used as an alternative to the default styles</td>
                              </tr>
                              <tr>
                                   <td><button class="btn btn-success" type="button">Success</button></td>
                                   <td><code>btn btn-success</code></td>
                                   <td>Indicates a successful or positive action</td>
                              </tr>
                              <tr>
                                   <td><button class="btn btn-warning" type="button">Warning</button></td>
                                   <td><code>btn btn-warning</code></td>
                                   <td>Indicates caution should be taken with this action</td>
                              </tr>
                              <tr>
                                   <td><button class="btn btn-danger" type="button">Danger</button></td>
                                   <td><code>btn btn-danger</code></td>
                                   <td>Indicates a dangerous or potentially negative action</td>
                              </tr>
                              <tr>
                                   <td><button class="btn btn-inverse" type="button">Inverse</button></td>
                                   <td><code>btn btn-inverse</code></td>
                                   <td>Alternate dark gray button, not tied to a semantic action or use</td>
                              </tr>
                              <tr>
                                   <td><button class="btn btn-link" type="button">Link</button></td>
                                   <td><code>btn btn-link</code></td>
                                   <td>Deemphasize a button by making it look like a link while maintaining button behavior</td>
                              </tr>
                         </tbody>
                    </table>
                    <div class="row">
                         <div class="span6">
                              <div class="bs-docs-example">
                                   <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                                        <li><a data-toggle="tab" href="#profile">Profile</a></li>
                                        <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#">Dropdown <b class="caret"></b></a>
                                             <ul class="dropdown-menu">
                                                  <li><a data-toggle="tab" href="#dropdown1">@fat</a></li>
                                                  <li><a data-toggle="tab" href="#dropdown2">@mdo</a></li>
                                             </ul>
                                        </li>
                                   </ul>
                                   <div class="tab-content" id="myTabContent">
                                        <div id="home" class="tab-pane fade in active">
                                             <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                        </div>
                                        <div id="profile" class="tab-pane fade">
                                             <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                                        </div>
                                        <div id="dropdown1" class="tab-pane fade">
                                             <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                                        </div>
                                        <div id="dropdown2" class="tab-pane fade">
                                             <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="span6">
                              <div class="bs-docs-example">
                                   <div id="accordion2" class="accordion">
                                        <div class="accordion-group">
                                             <div class="accordion-heading"> <a href="#collapseOne" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle"> Collapsible Group Item #1 </a> </div>
                                             <div class="accordion-body collapse in" id="collapseOne">
                                                  <div class="accordion-inner"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                             </div>
                                        </div>
                                        <div class="accordion-group">
                                             <div class="accordion-heading"> <a href="#collapseTwo" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle"> Collapsible Group Item #2 </a> </div>
                                             <div class="accordion-body collapse" id="collapseTwo">
                                                  <div class="accordion-inner"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                             </div>
                                        </div>
                                        <div class="accordion-group">
                                             <div class="accordion-heading"> <a href="#collapseThree" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle"> Collapsible Group Item #3 </a> </div>
                                             <div class="accordion-body collapse" id="collapseThree">
                                                  <div class="accordion-inner"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </article>
          </section>
     </div>
    @include('human.modules._footer')
</div>
@endsection
