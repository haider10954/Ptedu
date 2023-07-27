<header>
    <div class="container header-container">
        <input type="checkbox" name="" id="check">

        <div class="logo-container">

            <a class="text-decoration-none text-dark" href="{{ route('web-home') }}"><img src="{{ asset('web_assets/images/ptedu_logo.png') }}" class="logo_img" /></a>
        </div>

        <div class="nav-btn">
            <div class="nav-links navigation-mobile">
                <ul>
                    <li class="nav-link" style="--i: 1.1s">
                        <a href="javascript:void(0)" class="text-decoration-none">온라인 강좌</a>
                        <div class="dropdown">
                            <ul>
                                <li class="dropdown-link">
                                    <a href="javascript:void(0)" class="text-decoration-none">{{ __('translation.Physical Teraphy') }}<i class="fas fa-angle-down"></i></a>
                                    <div class="dropdown second">
                                        <ul>
                                            @foreach ($online_expert_courses as $expert_courses)
                                            <li class="dropdown-link">
                                                <a href="{{ route('online_course_detail' , $expert_courses->id ) }}" class="text-decoration-none">{{ $expert_courses->course_title }}</a>
                                            </li>
                                            @endforeach
                                            <div class="arrow"></div>
                                        </ul>
                                    </div>
                                </li>
                                <li class="dropdown-link">
                                    <a href="javascript:void(0)">{{ __('translation.Philates') }}<i class="fas fa-angle-down"></i></a>
                                    <div class="dropdown second">
                                        <ul>
                                            @foreach ($online_expert_courses as $expert_courses)
                                            <li class="dropdown-link">
                                                <a href="{{ route('online_course_detail' , $expert_courses->id ) }}" class="text-decoration-none">{{ $expert_courses->course_title }}</a>
                                            </li>
                                            @endforeach
                                            <div class="arrow"></div>
                                        </ul>
                                    </div>
                                </li>
                                <li class="dropdown-link">
                                    <a class="text-decoration-none" href="{{ route('liveCourse') }}">
                                        실시간 강좌
                                    </a>
                                    <a class="text-decoration-none" href="{{ route('specialCourse') }}">
                                        Special Lecture
                                    </a>
                                </li>
                                <div class="arrow"></div>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-link" style="--i: .85s">
                        <a href="{{ route('offline_lectures') }}" class="text-decoration-none">오프라인 강좌</a>
                        <div class="dropdown">
                            <ul>
                                @foreach ($online_public_courses as $public_courses)
                                <li class="dropdown-link">
                                    <a href="{{ route('online_course_detail' , $public_courses->id ) }}" class="text-decoration-none">{{ $public_courses->course_title }}</a>
                                </li>
                                @endforeach
                                <div class="arrow"></div>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('about_us') }}" class="text-decoration-none">피티에듀</a>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('review') }}" class="text-decoration-none">{{ __('translation.Review') }}</a>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('web-notice') }}" class="text-decoration-none">{{ __('translation.Notice') }}</a>
                    </li>
                    @if(auth()->check())
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('student_logout') }}" class="text-danger">{{ __('translation.Logout') }}</a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="nav-links navigation-desktop">
                <ul>
                    <li class="nav-link has-megamenu" style="--i: 1.1s">
                        <a href="javascript:void(0)" class="text-decoration-none online_course">온라인 강좌</a>
                        <div class="dropdown megamenu">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <ul class="mb-0 px-0 megamenu-list">
                                        @foreach ($online_expert_courses as $expert_courses)
                                        <li>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <a href="{{ route('online_course_detail' , $expert_courses->id ) }}" class="megamenu-menu-link">{{ $expert_courses->course_title }}</a>
                                                </div>
                                                <div class="col-md-5">
                                                    <a href="javascript:void(0)" class="megamenu-menu-link text-muted">{{ $expert_courses->getTutorName->name }}</a>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <ul class="mb-0 px-0 megamenu-list">
                                        @foreach ($online_expert_courses as $expert_courses)
                                        <li><a href="{{ route('online_course_detail' , $expert_courses->id ) }}" class="megamenu-menu-link">{{ $expert_courses->course_title }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <a class="text-decoration-none" href="{{ route('liveCourse') }}">
                                        <h4 class="mb-3">실시간 강좌 <i class="fas fa-arrow-circle-right"></i></h4>
                                    </a>
                                    <a class="text-decoration-none" href="{{ route('specialCourse') }}">
                                        <h4 class="mb-3">Special Lecture <i class="fas fa-arrow-circle-right"></i></h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('offline_lectures') }}" class="text-decoration-none">오프라인 강좌</a>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('about_us')}}" class="text-decoration-none">피티에듀</a>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('review')}}" class="text-decoration-none">{{ __('translation.Review') }}</a>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('web-notice')}}" class="text-decoration-none">{{ __('translation.Notice') }}</a>
                    </li>
                </ul>
            </div>
            <div class="log-sign" style="--i: 1.8s">
                @if(auth()->check())
                <a href="{{ route('shopping_bag') }}" class="btn solid shopping_cart_btn"><span class="shopping_cart_count" data-items-count="{{ count(session('shopping_cart') ?? []) }}">{{ count(session('shopping_cart') ?? []) }}</span> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>

                <div class="dropdown_header">
                    <button onclick="myFunction()" class="btn solid"><i class="fa fa-user" aria-hidden="true"></i></button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="{{ route('user_info') }}">{{ __('translation.Profile') }}</a>
                        <a href="{{ route('change-user-password') }}">{{ __('translation.Change password') }}</a>
                        <a href="{{ route('student_logout') }}" class="text-danger">{{ __('translation.Logout') }}</a>
                    </div>
                </div>
                @else
                <a href="{{ route('user_login') }}" class="btn solid">{{ __('translation.Login') }}</a>
                @endif
                @if(auth()->check())
                <a href="{{ route('my_classroom') }}" class="btn solid">{{ __('translation.My Classroom') }}</a>
                @endif
            </div>
        </div>

        <div class="hamburger-menu-container">
            <a href="{{ route('shopping_bag') }}" class="btn solid shopping_cart_btn"><span class="shopping_cart_count" data-items-count="{{ count(session('shopping_cart') ?? []) }}">{{ count(session('shopping_cart') ?? []) }}</span> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
            @if(auth()->check())
            @else
            <a href="{{ route('user_login') }}" class="btn solid">{{ __('translation.Login') }}</a>
            @endif
            @if(auth()->check())
            <a href="{{ route('my_classroom') }}" class="btn solid">{{ __('translation.My Classroom') }}</a>
            @endif
            <div class="hamburger-menu">
                <div></div>
            </div>
        </div>
    </div>
</header>

<script>
    function myfunction2() {
        document.getElementById("myDropdown2").classList.toggle("show");
    }

    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    window.onclick = function(event) {
        if (!event.target.matches('.solid')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }

    window.onclick = function(event) {
        if (!event.target.matches('.solid')) {
            var dropdowns = document.getElementsByClassName("dropdown-content-language");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
