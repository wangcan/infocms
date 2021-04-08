<link href="{{$commonAssetUrl}}/sguide/img/e4ba2-6910.ico" rel="shortcut icon" />
<link href="{{$commonAssetUrl}}/sguide/css/86dbe-1933.css" type="text/css" rel="stylesheet" />
<link href="{{$commonAssetUrl}}/sguide/css/9012f-9612.css" type="text/css" rel="stylesheet" />
@switch($view)
@case('home')
<link href="{{$commonAssetUrl}}/sguide/css/83e5a-9697.css" type="text/css" rel="stylesheet" />
@break
@case('detail')
<link href="{{$commonAssetUrl}}/sguide/css/4fe5c-5506.css" type="text/css" rel="stylesheet" />
@break
@case('product')
<link href="{{$commonAssetUrl}}/sguide/css/30800-8219.css" type="text/css" rel="stylesheet" />
@break
@case('shop')
<link href="{{$commonAssetUrl}}/sguide/css/7ba7a-9877.css" type="text/css" rel="stylesheet" />
@break
@case('store')
<link href="{{$commonAssetUrl}}/sguide/css/0df83-3637.css" type="text/css" rel="stylesheet" />
@break
@case('human-detail')
<link href="{{$commonAssetUrl}}/sguide/css/8bfd9-7295.css" type="text/css" rel="stylesheet" />
@break
{{--@case('detail')
@break--}}
@endswitch
@include('modules.guide._common-js');
