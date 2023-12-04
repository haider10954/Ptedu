<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="naver-site-verification" content="8cba5f36e4afff1e7b37802fbe946fd0f84b08a3" />
  <title>@yield('title')</title>
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/images/icons/favicon.png') }}">
  @yield('custom-stylesheet')
  @include('user.includes.style')
  @yield('custom-style')
</head>

<body>
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
  </script>
</body>

</html>
