@extends('admin.layout.layout')

@section('title' , 'Certificate Generated')

@section('custom-style')
<style>
    .hr-color {
        border: 1px solid #C4C4C4;
    }

    .certificate_header {
        font-family: 'Cardo' !important;
        font-style: normal;
        font-weight: 700;
        font-size: 40px;
        text-align: center;
        color: #7D5741;
    }

    .certificate_sub_title {
        font-weight: 400;
        font-size: 21px;
        line-height: 40px;
        text-align: center;
        color: #7D5741;
    }

    .divider {
        border: 1px solid #f3ddbd;
    }

    .certificate_name {
        font-weight: 400;
        font-size: 35px;
        line-height: 42px;
        text-align: center;
        color: #7D5741;
    }

    .certificate_description {
        font-weight: 400;
        font-size: 14px;
        line-height: 25px;
        text-align: center;
        color: #7D5741;
    }

    .certificate_date {
        font-weight: 400;
        font-size: 11px;
        line-height: 16px;
        color: #7D5741;
    }

    .certificate_logo {
        height: 52px;
        display: block;
        padding-bottom: 15px;
    }

    .footer_logo {
        width: 92.95px;
        height: 22.22px;
    }

    .certificate_footer {
        width: 104.41px;
        height: 104.41px;
    }

    .btn-download {

        background: #F0F0F0;
        border: 1.43489px solid #DFE0EB;
        border-radius: 2.86978px;
        font-weight: 400;
        font-size: 14px;
        line-height: 33px;
        color: #6F6F6F;

    }

    .btn-download:hover {

        background: #F0F0F0;
        border: 1.43489px solid #DFE0EB;
        border-radius: 2.86978px;
        font-weight: 400;
        font-size: 14px;
        line-height: 33px;
        color: #6F6F6F;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">{{__('translation.Issuance of Certificate of Completion')}}</h4>
                </div>
                <div class="prompt mt-2 mb-2"></div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <input type="hidden" name="id" value="{{ $certificate->id }}">
                <div class="pdfjs-viewer" id="certificate"></div>
            </div>
            <div class="col-12 mt-3">
                <button class="btn btn-sm btn-download" id="download"><span class="me-2"><i class="bi bi-download"></i></span>{{ __('translation.Download') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js" integrity="sha512-pdCVFUWsxl1A4g0uV6fyJ3nrnTGeWnZN2Tl/56j45UvZ1OMdm9CIbctuIHj+yBIRTUUyv6I9+OivXj4i0LPEYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    window.onload = function() {
        document.getElementById("download")
            .addEventListener("click", () => {
                const certificate = this.document.getElementById("certificate");
                console.log(certificate);
                console.log(window);
                var opt = {
                    margin: 0,
                    filename: 'certificate.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 1
                    },
                    html2canvas: {
                        scrollX: 0,
                        scrollY: 0
                    },
                    jsPDF: {
                        orientation: 'p',
                        unit: 'mm',
                        format: 'a4',
                        putOnlyUsedFonts: true,
                        floatPrecision: 16 // or "smart", default is 16
                    }
                };
                html2pdf().from(certificate).set(opt).save();
            })
    }
</script>

<script>
    var pdfjsLib = window['pdfjs-dist/build/pdf'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';
    var pdfViewer = new PDFjsViewer($('.pdfjs-viewer'));
    pdfViewer.loadDocument('{{ asset($certificate->certificate) }}');
</script>
@endsection