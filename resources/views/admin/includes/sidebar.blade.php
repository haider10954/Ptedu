<style>
    .bx {
        height: 20px;
        width: 20px;
    }

    .right-icon {
        float: right;
        font-size: 0.75rem !important;
    }
</style>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="{{ route('category') }}" class="">
                        <div></div>
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon.png')}}">
                        </i>
                        <span key="t-dashboards">{{ __('translation.Category') }}</span>
                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('course') }}" class="">
                        <div></div>
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon1.png')}}">
                        </i>
                        <span key="t-dashboards">{{ __('translation.Online Course List') }}</span>
                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('offline_lectures_admin')}}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon2.png')}}">
                        </i>
                        <span key="t-layouts">{{ __('translation.Offline Course List') }}</span>
                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('reviews')}}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon3.png')}}">
                        </i>
                        <span key="t-file-manager">{{ __('translation.Review Management') }}</span>

                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('student')}}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon4.png')}}">
                        </i>
                        <span key="t-file-manager">{{ __('translation.Student Information') }}</span>
                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>


                <li>
                    <a href="{{ route('tutor') }}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon5.png')}}">
                        </i>
                        <span key="t-ecommerce">{{ __('translation.Tutor Information') }}</span>

                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('payment') }}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon6.png')}}">
                        </i>
                        <span key="t-ecommerce">{{ __('translation.Payment Management') }}</span>

                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('inquiry') }}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon7.png')}}">
                        </i>
                        <span key="t-ecommerce">{{ __('translation.1:1 Inquiry list') }}</span>

                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('certificate') }}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon8.png')}}">
                        </i>
                        <span key="t-ecommerce">{{ __('translation.Certificate') }}</span>
                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('notice') }}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon9.png')}}">
                        </i>
                        <span key="t-ecommerce">{{ __('translation.Notice') }}</span>

                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('faqs') }}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon10.png')}}">
                        </i>
                        <span key="t-ecommerce">{{ __('translation.FAQ') }}</span>

                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>


                <li>
                    <a href="{{ route('settings') }}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon11.png')}}">
                        </i>
                        <span key="t-ecommerce">{{ __('translation.Settings') }}</span>

                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>