
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="shortcut icon" href="{{asset('frontend/img/fav.png')}}">

<meta name="author" content="CodePixar">

<meta name="description" content="">

<meta name="keywords" content="">

<meta charset="UTF-8">

<title>Outdoor</title>

<link rel="stylesheet" href="{{asset('frontend/css/linearicons.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/themify-icons.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/nice-select.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/nouislider.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/ion.rangeSlider.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/ion.rangeSlider.skinFlat.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/main.css')}}">
@toastr_css
</head>
<body>

@include('layouts.frontend.includes.header')
@yield('content')
@include('sweetalert::alert')

@include('layouts.frontend.includes.footer')

<script src="{{asset('frontend/js/vendor/jquery-2.2.4.min.js')}}" type="c225d57e7330fb20342c3e79-text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous" type="c225d57e7330fb20342c3e79-text/javascript"></script>
<script src="{{asset('frontend/js/vendor/bootstrap.min.js')}}" type="c225d57e7330fb20342c3e79-text/javascript"></script>
<script src="{{asset('frontend/js/jquery.ajaxchimp.min.js')}}" type="c225d57e7330fb20342c3e79-text/javascript"></script>
<script src="{{asset('frontend/js/jquery.nice-select.min.js')}}" type="c225d57e7330fb20342c3e79-text/javascript"></script>
<script src="{{asset('frontend/js/jquery.sticky.js')}}" type="c225d57e7330fb20342c3e79-text/javascript"></script>
<script src="{{asset('frontend/js/nouislider.min.js')}}" type="c225d57e7330fb20342c3e79-text/javascript"></script>
<script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}" type="c225d57e7330fb20342c3e79-text/javascript"></script>
<script src="{{asset('frontend/js/owl.carousel.min.js')}}" type="c225d57e7330fb20342c3e79-text/javascript"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE" type="c225d57e7330fb20342c3e79-text/javascript"></script>
<script src="{{asset('frontend/js/gmaps.min.js')}}" type="c225d57e7330fb20342c3e79-text/javascript"></script>
<script src="{{asset('frontend/js/main.js')}}" type="c225d57e7330fb20342c3e79-text/javascript"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="c225d57e7330fb20342c3e79-text/javascript"></script>
<script type="c225d57e7330fb20342c3e79-text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/95c75768/cloudflare-static/rocket-loader.min.js" data-cf-settings="c225d57e7330fb20342c3e79-|49" defer=""></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

@jquery
@toastr_js
@toastr_render

</body>
</html>
