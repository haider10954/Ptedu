@extends('user.layout')

@section('title', 'ptedu - Notice Details')

@section('content')
<div class="section pt-150">
    <div class="container mb-80">
        <div class="w-75 m-auto">
            <div class="section-heading">
                <h6 class="mb-0">공지사항</h5>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-4 col-sm-12">
                    <div class="d-flex align-items-center pt-3">
                        <div class="mr-3">
                            <h5 class="heading text-left mb-0">{{ __('translation.Title')}}</h5>
                        </div>
                        <div class="text-justify">
                            <p class="mb-0 text-dark">{{ $notices->title }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-4 col-sm-12">
                    <div class="pt-3">
                        <h5 class="heading mb-3 text-left">{{ __('translation.Description')}}</h5>
                    </div>
                    <div class="pt-2 text-justify">
                        <p class="mb-0 text-dark"><?= html_entity_decode($notices->content) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
<script>
    $('.table').each(function(index, entry) {
        $(entry).children().first().addClass('table').addClass('table-bordered');
        $(entry).children().first().children().first().addClass('w-100');
        $(entry).find('td').css('vertical-align', 'middle');
    });
</script>
@endsection