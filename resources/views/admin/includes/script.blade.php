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

<!-- form repeater js -->
<script src="{{ asset('assets/libs/jquery.repeater/jquery.repeater.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/form-repeater.int.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<script src="{{ asset('assets/js/main.js') }}"></script>


<!-- include summer_note css/js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
