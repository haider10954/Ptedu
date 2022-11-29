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
        width: 138.67px;
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
                <div class="position-relative">
                    <img src="{{ asset('assets/images/icons/frame.png')}}" class="w-100">
                    <div class="position-absolute text-center w-100" style="padding: 10px 100px 10px 100px; top:50px;">
                        <div class="w-25 mx-auto">
                            <img src="{{ asset('assets/images/icons/certificate_header.png')}}" class="w-100">
                            <hr class="divider" />
                        </div>
                        <div class="certificate_header mb-3">CERTIFICATE</div>
                        <div class="certificate_sub_title mb-3">OF COMPLETION</div>
                        <div class="w-25 mx-auto">
                            <img src="{{ asset('assets/images/icons/certificate_bottom.png') }}" class="w-100">
                            <hr class="divider" />
                        </div>
                        <div class="certificate_name mb-3">
                            Hong Gil Dong
                        </div>
                        <div class="certificate_description mb-3">
                            Is hereby cetified as an 2022 PTEdu Pelvic health Physiotherapy – <br /> Melissa Davidson with Full Certification for the half-year period <br /> starting on 2022/05/01 and ending on 2022/10/31
                        </div>
                        <div class="d-flex justify-content-around align-items-center mt-5">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<script>
    window.onload = function() {
        document.getElementById("download").addEventListener("click", () => {
            const certificate = this.document.getElementById("certificate");
            var opt = {

                margin: 1.25,
                marginTop: 0.25,
                filename: 'certificate.pdf',
                image: {
                    type: 'jpeg',
                },
                jsPDF: {
                    unit: 'in',
                    orientation: 'landscape'
                }
            };
            html2pdf().set(opt).from(certificate).save();
        })
    }
</script>

@endsection
