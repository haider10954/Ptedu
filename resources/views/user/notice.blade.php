@extends('user.layout')

@section('title', 'ptedu - Notice')

@section('content')
    <div class="section notice-table pt-150 min-height-90">
        <div class="container">
            <div class="w-75 m-auto">
                <div class="table-header mb-3">
                    <div class="left-content notice_tabs d-flex align-items-center">
                        <h5 class="heading mb-0 mr-5"><a href="{{ route('web-notice') }}" class="active text-muted">{{ __('translation.Notice') }}</a>
                        </h5>
                        <h5 class="heading mb-0"><a href="{{ route('web-faq') }}" class="text-muted">{{ __('translation.FAQ') }}</a></h5>
                    </div>
                    <div class="right-content d-flex align-items-center">
                        <input type="text" placeholder="Enter Search Items" id="myInput" onkeyup="myFunction()"
                            class="form-control search_box">
                        <button class="btn btn-theme-black text-white font-size-12">Search</button>
                    </div>
                </div>
                <table class="table w-100" id="table-notice">
                    <thead class="notice-table-header">
                        <tr>
                            <th>{{ __('translation.Number') }}</th>
                            <th>{{ __('translation.Title') }}</th>
                            <th>{{ __('translation.Date') }}</th>
                        </tr>
                    </thead>
                    <tbody class="font-14px">
                        @if ($notices->count() > 0)
                            @php
                                $count = 1;
                            @endphp
                            @foreach ($notices as $item)
                                <tr data-toggle="modal" data-target="#noticeModal" class="click_record"
                                    data-title="{{ $item->title }}" data-content="{{ $item->content }}"
                                    style="cursor: pointer">
                                    <td>{{ $count == 1 ? $notices->count() : $notices->count() + 1 - $count }}</td>
                                    <td>{{ Str::limit($item->title, 70) }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}</td>
                                </tr>
                                @php
                                    $count++;
                                @endphp
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">
                                    <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img"
                                        class="img-fluid" style="height: 300px;">
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $notices->links('vendor.pagination.custom-pagination') }}
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-custom modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel">{{ __('translation.Notice') }}</h5>
                </div>
                <div class="modal-body">
                    <h5 class="heading-h5 mb-3 font-weight-bold notice_title"></h5>
                    <p class="mb-4 notice_content"></p>
                    <div class="my-3 d-flex align-items-center justify-content-center">
                        <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">{{ __('translation.Close') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script>
        $('.click_record').on('click', function() {
            $('.notice_title').text($(this).attr('data-title'));
            $('.notice_content').text($(this).attr('data-content'));
        });

        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("table-notice");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
