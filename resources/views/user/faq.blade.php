@extends('user.layout')

@section('title', 'ptedu - Faq')

@section('custom-stylesheet')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@endsection

@section('content')
<div class="section notice-table pt-150 pb-100 min-height-90">
    <div class="container">
        <div class="w-75 m-auto">
            <div class="table-header pb-3 border-bottom-2">
                <div class="left-content notice_tabs d-flex align-items-center">
                    <h5 class="heading mb-0 mr-5"><a href="{{ route('web-notice') }}" class="text-muted">Notice</a></h5>
                    <h5 class="heading mb-0"><a href="{{ route('web-faq') }}" class="text-muted active">FAQ</a></h5>
                </div>
            </div>
            <div class="accordion faq_tabs" id="accordionExample">
                @php
                $count = 1;
                @endphp
                @if($faqs->count() > 0)
                @foreach ($faqs as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $count }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $count }}" aria-expanded="false" aria-controls="collapse{{ $count }}">
                            {{ $item->title }}
                        </button>
                    </h2>
                    <div id="collapse{{ $loop->index+1 }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            {{ $item->content }}
                        </div>
                    </div>
                </div>
                @php
                $count++;
                @endphp
                @endforeach
                @else
                <div class="text-center">
                    <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img" class="img-fluid" style="height: 300px;">
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<div class="modal fade" id="faqModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel">Faq</h5>
            </div>
            <div class="modal-body">
                <h5 class="heading-h5 mb-3 font-weight-bold notice_title"></h5>
                <p class="mb-4 notice_content"></p>
                <div class="my-3 d-flex align-items-center justify-content-center">
                    <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
@endsection