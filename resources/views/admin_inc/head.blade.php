<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="token" content="{{ csrf_token() }}"/>
<meta name="url" content="{{ URL('/') }}"/>
<title>Datalumni</title>
<!-- jQuery library -->
@jquery
<!-- toastr library -->
@toastr_css
<!-- Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<!-- Custom -->
<link href="{{ asset('css/custom/animate.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom/custom-style.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom/owl.theme.default.min.css') }}" rel="stylesheet">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137180997-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-137180997-1');
</script>