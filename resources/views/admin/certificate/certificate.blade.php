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
                    <h4 class="mb-sm-0  Card_title">Issuance of Certificate of Completion</h4>
                </div>
                <div class="prompt mt-2 mb-2"></div>
                <hr class="hr-color" />
            </div>
            <div class="col-12" id="certificate">
                <input type="hidden" name="id" value="{{ $download->id }}">
                <div class="position-relative m-auto" style="width: 64%; background-color: #fff8f0;">
                    <img src="{{ asset('assets/images/icons/frame.png')}}" class="w-100">
                    <div class="position-absolute text-center w-100" style="padding: 10px 80px 10px 80px; top:30px;">
                        <div class="w-25 mx-auto">
                            <img src="{{ asset('assets/images/icons/certificate_header.png')}}" class="w-100">
                        </div>
                        <div class="w-50 mx-auto">
                            <div class="divider mt-1"></div>
                        </div>
                        <div class="certificate_header">CERTIFICATE</div>
                        <div class="certificate_sub_title">OF COMPLETION</div>
                        <div class="w-25 mx-auto">
                            <img src="{{ asset('assets/images/icons/certificate_bottom.png') }}" class="w-100">
                        </div>
                        <div class="w-50 mx-auto">
                            <div class="divider mt-1"></div>
                        </div>
                        <div class="certificate_name mb-3 mt-3">
                            {{ $certificate->getUser->english_name }}
                        </div>
                        <div class="certificate_description mb-2">
                            Is hereby cetified as an <span class="fw-bold">{{ $certificate->getCourses->course_title }} – <br /> {{ $certificate->getCourses->getTutorName->english_name  }} </span> with Full Certification for the {{ $certificate->course_duration }} period <br /> starting on {{\Carbon\Carbon::parse($certificate->getCourses->created_at)->format('d M, Y')}} and ending on {{\Carbon\Carbon::parse($certificate->getCourses->expired_at)->format('d M, Y')}}
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3 me-5">
                            <div>
                                <img src="{{ asset('assets/images/icons/certificate_logo.png') }}" class="certificate_logo">
                                <img src="{{ asset('assets/images/index.png') }}" class="footer_logo" />
                            </div>
                            <div>
                                <img src="{{ asset('assets/images/icons/certificate_footer.png') }}" class="certificate_footer" />
                            </div>
                            <div class="certificate_date">
                                {{ $certificate->issue_date }} <br>
                                Date
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <button class="btn btn-sm btn-download" onclick="download('{{ $download->id }}')" id="download"><span class="me-2"><i class="bi bi-download"></i></span>Download</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js" integrity="sha512-pdCVFUWsxl1A4g0uV6fyJ3nrnTGeWnZN2Tl/56j45UvZ1OMdm9CIbctuIHj+yBIRTUUyv6I9+OivXj4i0LPEYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function download(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('download_certificate') }}",
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
            },
            beforeSend: function() {},
            success: function(res) {
                if (res.success == true) {

                    $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');
                    setTimeout(function() {
                        location.reload();
                    }, 3000);

                } else {
                    $('.prompt').html('<div class="alert alert-danger mb-3">' + res.message + '</div>');
                }
            },

            error: function(e) {
                console.log('error');
            }
        });
    }
    window.onload = function() {
        document.getElementById("download")
            .addEventListener("click", () => {
                const certificate = this.document.getElementById("certificate");
                console.log(certificate);
                console.log(window);
                var opt = {
                    margin: [30, 0, 30, 0],
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