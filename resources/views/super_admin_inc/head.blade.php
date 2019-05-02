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
<link href="{{ asset('css/super_admin/custom.css') }}" rel="stylesheet">
<!-- froala -->
<link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.0/css/froala_style.min.css" rel="stylesheet" type="text/css" />
<!-- Icons-->
<link href="{{ asset('css/template/coreui-icons.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/template/flag-icon.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/template/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/template/simple-line-icons.css') }}" rel="stylesheet">
<!-- Main styles for this application-->
<link href="{{ asset('css/template/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/template/pace.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137180997-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-137180997-1');
</script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/jq-3.3.1/dt-1.10.18/datatables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.0.0/css/scroller.bootstrap4.min.css">
