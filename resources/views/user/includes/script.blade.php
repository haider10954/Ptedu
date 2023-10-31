<script src="{{ asset('web_assets/js/jquery.js') }}"></script>
<script src="{{ asset('web_assets/js/popper.min.js') }}"></script>
<script src="{{ asset('web_assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('web_assets/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<!-- <script src="{{ asset('assets/js/pdfjs-viewer.js') }}"></script> -->
<script src="{{ asset('assets/js/pdf-viewer.js') }}"></script>

<script>
    $(document).ready(function(){
        const lazyLoadElements = document.querySelectorAll(".lazy");
        lazyLoadElements.forEach(function(element) {
        if (element.tagName === "IMG" && element.hasAttribute("data-src")) {
            element.setAttribute("src", element.getAttribute("data-src"));
        }
        });
    });
</script>