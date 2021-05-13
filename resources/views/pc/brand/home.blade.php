@extends('layouts.guide')
@section('dynamicMeta')@include('modules._meta', $datas)@endsection
@section('jscss')@include('modules.brand._jscss', ['view' => $datas['view']])@endsection
@section('bodyClass')class="pc blockstyle2 "@endsection
@section('content')
<div id="wrap">
    <div id="container">
        <div class="leftlay">
            <div class="artcontent">
                @include('brand.modules._brief')
                @include('brand.modules._desc')
                @include('brand.modules._league')
                @include('brand.modules._vote')
                @include('brand.modules._relate-brand')
                @include('brand.modules._shop')
                @include('brand.modules._product')
                {{--@include('brand.modules._comment')--}}
                @include('brand.modules._statement')
            </div>
        </div>
        @include('brand.modules._right')
    </div>
</div>
@endsection
