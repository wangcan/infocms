<link href="{{$commonAssetUrl}}/sguide/img/e4ba2-8294.ico" rel="shortcut icon" />
<link href="{{$commonAssetUrl}}/sguide/m/css/30cdb-6621.css" type="text/css" rel="stylesheet" />
<link href="{{$commonAssetUrl}}/sguide/css/9a030-1171.css" type="text/css" rel="stylesheet" />

@switch($view)
@case('home')
<link href="{{$commonAssetUrl}}/sguide/css/46fb4-5182.css" type="text/css" rel="stylesheet" />
@break
@case('detail')
<link href="{{$commonAssetUrl}}/sguide/css/92999-4570.css" type="text/css" rel="stylesheet" />
@break
@case('product')
<link href="{{$commonAssetUrl}}/sguide/css/30800-2632.css" type="text/css" rel="stylesheet" />
@break
@case('shop')
<link href="{{$commonAssetUrl}}/sguide/css/7ba7a-2311.css" type="text/css" rel="stylesheet" />
@break
@case('store')
<link href="{{$commonAssetUrl}}/sguide/css/4cb42-2569.css" type="text/css" rel="stylesheet" />
@break
@case('human-detail')
<link href="{{$commonAssetUrl}}/sguide/css/8bfd9-7295.css" type="text/css" rel="stylesheet" />
@break
{{--@case('detail')
@break--}}
@endswitch
@include('modules.guide._common-js');
