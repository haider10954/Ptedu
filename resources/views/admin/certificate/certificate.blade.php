@extends('admin.layout.layout')

@section('title' , 'Certificate Generated')

@section('custom-style')
<style>
    .hr-color {
        border: 1px solid #C4C4C4;
    }

    .certificate_header {
        font-weight: 700;
        font-size: 35px;
        line-height: 54px;
        text-align: center;
        color: #7D5741;
    }

    .certificate_sub_title {
        font-weight: 400;
        font-size: 18px;
        line-height: 27px;
        text-align: center;
        color: #7D5741;
    }

    .divider {
        border: 1px solid #7D5741;
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
        font-size: 11px;
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
        height: 39px;
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
                    <h4 class="mb-sm-0  Card_title">Issuance of Certificate of Completion</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12" id="certificate">
                <div class="position-relative w-75 m-auto">
                    <img src="{{ asset('assets/images/icons/frame.png')}}" class="w-100">
                    <div class="position-absolute text-center w-100" style="padding: 10px 100px 10px 100px; top:15px;">
                        <div class="w-25 mx-auto">
                            <img src="{{ asset('assets/images/icons/certificate_header.png')}}" class="w-100">
                            <div class="divider mt-1"></div>
                        </div>
                        <div class="certificate_header mb-1">CERTIFICATE</div>
                        <div class="certificate_sub_title">OF COMPLETION</div>
                        <div class="w-25 mx-auto">
                            <img src="{{ asset('assets/images/icons/certificate_bottom.png') }}" class="w-100">
                            <div class="divider mt-1"></div>
                        </div>
                        <div class="certificate_name">
                            Hong Gil Dong
                        </div>
                        <div class="certificate_description mb-1">
                            Is hereby cetified as an 2022 PTEdu Pelvic health Physiotherapy ??? <br /> Melissa Davidson with Full Certification for the half-year period <br /> starting on 2022/05/01 and ending on 2022/10/31
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <img src="{{ asset('assets/images/icons/certificate_logo.png') }}" class="certificate_logo">
                                <img src="{{ asset('assets/images/index.png') }}" class="footer_logo" />
                            </div>
                            <div>
                                <img src="{{ asset('assets/images/icons/certificate_footer.png') }}" class="certificate_footer" />
                            </div>
                            <div class="certificate_date">
                                2022.10.12 <br>
                                Date
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <button class="btn btn-sm btn-download" id="download"><span class="me-2"><i class="bi bi-download"></i></span>Download</button>
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
                    margin: 1,
                    filename: 'certificate.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scrollX: 0,
                        scrollY: 0
                    },
                    jsPDF: {
                        orientation: 'l',
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

@endsection