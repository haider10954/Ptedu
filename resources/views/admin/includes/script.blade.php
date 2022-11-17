<!-- JAVASCRIPT -->
<script src="{{ asset( 'assets/libs/jquery/jquery.min.js ') }}"></script>
<script src="{{ asset( 'assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset( 'assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset( 'assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset( 'assets/libs/node-waves/waves.min.js') }}"></script>

<!-- apexcharts -->
<script src="{{ asset( 'assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- dashboard init -->
<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
    // When the user scrolls down 20px from the top of the document, slide down the navbar
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            $("#header").css("background-color", "#ffffff");
        } else {
            $("#header").css("background-color", "transparent");
        }
    }
</script>
