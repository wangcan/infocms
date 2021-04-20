@extends('layouts.human')
@section('dynamicMeta')@include('modules._meta', $datas)@endsection
@section('content')
<div id="main">
     <div class="container">
          <section id="register">
               <div class="hgroup">
                    <h1>Register or Sign in</h1>
                    <ul class="breadcrumb pull-right">
                         <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                         <li class="active">Register of Sign in</li>
                    </ul>
               </div>
               <div class="row">
                    <div class="signin span6">

                            <div class="social_sign">
                            <h3>Sign in with your social account</h3>
                                 <a class="fb" href="#facebook"><i class="icon icon-facebook"></i></a> <a class="tw" href="#twitter"><i class="icon icon-twitter"></i></a> <a class="gp" href="#googleplus"><i class="icon icon-google-plus"></i></a>
                            </div>

                            <div class="or">
                                <div class="or_l"></div>
                                <span>or</span>
                                <div class="or_r"></div>
                            </div>
                            
                            <p class="sign_title">Log in with your site account</p>

                            <div class="form">
                                <form />
                                    <input type="text" placeholder="Email" class="input-xlarge" />
                                    <input type="text" placeholder="Password" class="input-xlarge" />
                                    <div class="forgot">
                                         <label class="checkbox">
<input type="checkbox" /> Remember me
</label><a href="#">Forgot password?</a>
                                    </div>
                                   
                                    <button type="submit" class="btn btn-primary btn-large">Sign in</button>
                                </form>
                            </div>

                        </div>
                        
                    <div class="signup span6">

<form />
<fieldset>
<div class="social_sign">
<h3>Don't have a site account yet?</h3>
                                 <a><i class="icon icon-user"></i></a>
                            </div>
<p class="sign_title">Create one now, it's fast & free!</p>



    <input id="Username" name="Username" placeholder="Username" class="input-xlarge" required="" type="text" />



    <input id="Email address" name="Email address" placeholder="Email address" class="input-xlarge" required="" type="text" />




    <input id="Password" name="Password" placeholder="Password" class="input-xlarge" required="" type="password" />




    <label class="checkbox">
      <input name="checkboxes" value="Option one" type="checkbox" />
      I agree to the <a href="#">terms and conditions</a>
    </label>



<button type="submit" class="btn btn-success btn-large">Create your account</button>

</fieldset>
</form>

                        </div>
               </div>
          </section>
     </div>
    @include('human.modules._footer')
</div>
@endsection
