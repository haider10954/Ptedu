@extends('user.layout')

@section('title', 'PTEdu - Inquiry')

@section('content')

<div class="section pt-125" style="min-height: 70vh;">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 padding-left">
                <div class="page-sidemenu-heading mb-3">
                    <h5 class="mb-0 font-weight-600">{{ __('translation.Inquiry') }}</h5>
                    <a href="javscript:void(0)" class="btn btn-dark btn-custom-sm btn-theme-black page-side-menu-toggle">{{ __('translation.menu') }}</a>
                </div>
                <div class="page-side-menu">
                    <ul class="menu">
                        <li><a href="{{ route('my_classroom') }}">{{ __('translation.My Classroom') }}</a></li>
                        <li><a href="{{ route('shopping_bag') }}">{{ __('translation.Shopping Bag') }}</a></li>
                        <li><a href="{{ route('user_info') }}">{{ __('translation.Modifying Member Info') }}</a></li>
                        <li><a href="{{ route('user_inquiry')  }}">{{ __('translation.Inquiry') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="section-heading mb-3">
                    <h5 class="mb-1">{{ __('translation.Inquiry') }}</h5>
                    <p class="mb-0">{{ __('translation.Questions & Answers in PTEdu') }}</p>
                </div>
                <div class="mt-3">
                    <div class="w-100">
                        <table class="table shopping-table text-center table-responsive">
                            <thead>
                                <tr>
                                    <td>{{ __('translation.No') }}</td>
                                    <td>{{ __('translation.Title') }}</td>
                                    <td>{{ __('translation.Writer') }}</td>
                                    <td>{{ __('translation.Registration date') }}</td>
                                    <td>{{ __('translation.Progress') }}</td>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($inquiry->count() > 0)

                                @foreach($inquiry as $inq)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ Str::limit($inq->title, 70) }}</td>
                                    <td>{{ $inq->getStudentName->name }}</td>
                                    <td>{{ Carbon\Carbon::parse($inq->created_at)->format('d M, Y')}}</td>
                                    @if($inq->answer == null)
                                    <td><a class="btn btn-sm btn-theme-delete rounded-0" href="{{ route('inquiry_not_answered',$inq->id) }}">답변준비중 </a></td>
                                    @else
                                    <td><a class="btn btn-sm btn-theme-black-inquiry text-white rounded-0" href="{{ route('inquiry_answered',$inq->id) }}">답변완료</a></td>
                                    @endif
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img" class="img-fluid" style="height: 300px;">
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="5">
                                        <div class="text-right margin">
                                            <a class="btn btn-theme-white" href="{{ route('add_inquiry') }}">{{ __('translation.Contact us') }}</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $inquiry->links('vendor.pagination.custom-pagination') }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    $('.page-side-menu-toggle').on('click', function() {
        $('.page-side-menu').slideToggle();
    });

    $('.select_payment_method').height($('.payment_info').height());
</script>
@endsection
