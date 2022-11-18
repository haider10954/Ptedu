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
                    <a href="{{ route('lectures') }}" class="">
                        <div></div>
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon1.png')}}">
                        </i>
                        <span key="t-dashboards">Lecture List</span>
                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('offline_lectures')}}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon2.png')}}">
                        </i>
                        <span key="t-layouts">Offline Lecture List</span>
                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('reviews')}}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon3.png')}}">
                        </i>
                        <span key="t-file-manager">Review Management</span>

                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('student')}}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon4.png')}}">
                        </i>
                        <span key="t-file-manager">Student Information</span>
                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>


                <li>
                    <a href="{{ route('tutor') }}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon5.png')}}">
                        </i>
                        <span key="t-ecommerce">Tutor Information</span>

                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('payment') }}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon6.png')}}">
                        </i>
                        <span key="t-ecommerce">Payment Management</span>

                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('inquiry') }}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon7.png')}}">
                        </i>
                        <span key="t-ecommerce">1:1 Inquiry list</span>

                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('certificate') }}" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon8.png')}}">
                        </i>
                        <span key="t-ecommerce">Certificate</span>
                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon9.png')}}">
                        </i>
                        <span key="t-ecommerce">Notice</span>

                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon10.png')}}">
                        </i>
                        <span key="t-ecommerce">FAQ</span>

                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);" class="">
                        <i>
                            <img class="bx me-2" src="{{ asset('assets/images/icons/icon11.png')}}">
                        </i>
                        <span key="t-ecommerce">Settings</span>

                        <i class="bi bi-chevron-right right-icon"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
