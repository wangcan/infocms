@extends('layouts.layout')
@section('main')
<div class="szwrap">
@include('modules.petcms._top')
@include('modules.petcms._nav')
@yield('content')
@include('modules.petcms._footer')
@include('modules.petcms._footer-js')
</div>
@endsection
@section('dynamicMeta')
@section('jscss')
@section('bodyClass')
