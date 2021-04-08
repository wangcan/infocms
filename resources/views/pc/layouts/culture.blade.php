<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="site_home">

<head>
@include('modules.culture._header-meta')
@include('modules.culture._header-jscss')

<body>
{{--@include('modules.culture._common-top')--}}
{{-- @include('modules.culture._common-header') --}}
@include('modules.culture._common-nav')

@yield('main')

@include('modules.culture._common-footer')
</body>
</html>
