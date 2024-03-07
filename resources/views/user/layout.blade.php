<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="naver-site-verification" content="8cba5f36e4afff1e7b37802fbe946fd0f84b08a3" />
  <meta name="description" content="최신 근거 기반, 임상 적용 물리치료 교육, PNF 써티 청구, 움직임 전문가, MAM, APPI, 필라테스, 보행">
  <meta property="og:type" content="website">
  <meta property="og:title" content="물리치료 관련 교육 플랫폼 피티에듀 - 대한중추신경계물리치료학회">
  <meta property="og:description" content="최신 근거 기반, 임상 적용 물리치료 교육, PNF 써티 청구, 움직임 전문가, MAM, APPI, 필라테스, 보행">
  <meta property="og:image" content="{{ asset('web_assets/images/ptedu_logo.png') }}">
  <meta property="og:url" content="https://e-ptedu.com/">
  <title>물리치료 관련 교육 플랫폼 피티에듀 - 대한중추신경계물리치료학회</title>
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/images/icons/favicon.png') }}">
  @yield('custom-stylesheet')
  @include('user.includes.style')
  @yield('custom-style')
</head>

<body>
<div id="cart-loader">
    <div class="d-flex w-100 h-100 align-items-center justify-content-center">
        <div id="loader"></div>
    </div>

</div>
    @if(request()->route()->getName() == 'web-home')
    <div class="top-bottom-btn">
        <img src="{{ asset('web_assets/images/icon-down.png') }}" height="35" alt="icon-img">
    </div>
    @endif
  <!-- header start -->
  @include('user.includes.header')
  <!-- header end -->

  <div class="page-wrapper">
    {{-- content start --}}
    @yield('content')
    {{-- content end --}}
  </div>

  <!-- footer start -->
  @include('user.includes.footer')
  <!-- footer end -->

  @yield('modals')
  <!-- js links -->
  @include('user.includes.script')
  @yield('custom-script')
  <script>

      $(document).ready(function (){
          $(".child-link").hover(

              function () {
                    $(this).parent('li').parent('ul').parent('.sub-category').prev('a').css("background-color", "rgba(128, 128, 128, 0.17)")
                    $(this).parent('li').parent('ul').parent('.sub-category').prev('a').css("font-weight", "500")
              },
              function () {

                  $(this).parent('li').parent('ul').parent('.sub-category').prev('a').css("background-color", "transparent")
                  $(this).parent('li').parent('ul').parent('.sub-category').prev('a').css("font-weight", "400")
              }
          );
      })
      function myfunction2() {
          document.getElementById("myDropdown2").classList.toggle("show");
      }

      function myFunction() {
          document.getElementById("myDropdown").classList.toggle("show");
      }

      window.onclick = function (event) {
          if (!event.target.matches('.solid')) {
              var dropdowns = document.getElementsByClassName("dropdown-content");
              var i;
              for (i = 0; i < dropdowns.length; i++) {
                  var openDropdown = dropdowns[i];
                  if (openDropdown.classList.contains('show')) {
                      openDropdown.classList.remove('show');
                  }
              }
          }
      }

      window.onclick = function (event) {
          if (!event.target.matches('.solid')) {
              var dropdowns = document.getElementsByClassName("dropdown-content-language");
              var i;
              for (i = 0; i < dropdowns.length; i++) {
                  var openDropdown = dropdowns[i];
                  if (openDropdown.classList.contains('show')) {
                      openDropdown.classList.remove('show');
                  }
              }
          }
      }

      $('.top-bottom-btn').on('click', function(){
            $('html, body').animate({scrollTop : $(document).height()}, 800);
            return false;
      });
  </script>
</body>

</html>
