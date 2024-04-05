<header>
    <div class="container header-container">
        <input type="checkbox" name="" id="check">

        <div class="logo-container">

            <a class="text-decoration-none text-dark" href="{{ route('web-home') }}"><img
                    src="{{ asset('web_assets/images/ptedu_logo.png') }}" class="logo_img"/></a>
        </div>

        <div class="nav-btn">
            <div class="nav-links navigation-mobile">
                <ul>
                    <li class="nav-link" style="--i: 1.1s">
                        <a href="javascript:void(0)" class="text-decoration-none">{{ __('translation.Online Courses') }}<i
                            class="fas fa-angle-down"></i></a>
                        <div class="dropdown">
                            <ul>
                                @if($course_categories->count() > 0)
                                    @foreach ($course_categories as $category)
                                        <li class="dropdown-link">
                                            <a href="javascript:void(0)"
                                               class="text-decoration-none">{{ $category->name }} @if($category->getCourses->count() > 0)
                                                    <i
                                                        class="fas fa-angle-down"></i>
                                                @endif</a>
                                            @if($category->getCourses->count() > 0)
                                                <div class="dropdown second">
                                                    <ul>
                                                        @foreach ($category->getCourses as $course)
                                                            <li class="dropdown-link">
                                                                <a href="{{ route('online_course_detail',$course->id) }}"
                                                                   class="text-decoration-none">{{ $course->course_title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li class="nav-link" style="--i: .85s">
                        <a href="javascript:void(0)" class="text-decoration-none">{{ __('translation.Offline Courses') }}<i
                            class="fas fa-angle-down"></i></a>
                        <div class="dropdown">
                            <ul>
                                @if($course_offline_categories->count() > 0)
                                    @foreach ($course_offline_categories as $category)
                                        <li class="dropdown-link">
                                            <a href="javascript:void(0)"
                                               class="text-decoration-none">{{ $category->name }} @if($category->getOffineCourses->count() > 0)
                                                    <i
                                                        class="fas fa-angle-down"></i>
                                                @endif</a>
                                            @if($category->getOffineCourses->count() > 0)
                                                <div class="dropdown second">
                                                    <ul>
                                                        @foreach ($category->getOffineCourses as $course)
                                                            <li class="dropdown-link">
                                                                <a href="{{ route('offline_lecture_detail',$course->id) }}"
                                                                   class="text-decoration-none">{{ $course->course_title }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('about_us') }}" class="text-decoration-none">{{ __('translation.PTEdu') }}</a>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <ul>
                            <li class="nav-link has-megamenu" style="--i: 1.1s">
                                <a href="{{ route('review') }}" class="text-decoration-none" style="color: black !important;">{{ __('translation.Review') }}</a>
                            </li>
                        </ul>

                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('web-notice') }}"
                           class="text-decoration-none">{{ __('translation.Notice') }}</a>
                    </li>
                    @if(auth()->check())
                        <li class="nav-link" style="--i: 1.35s">
                            <a href="{{ route('student_logout') }}"
                               class="text-danger">{{ __('translation.Logout') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="nav-links navigation-desktop">
                <ul>
                    <li class="nav-link has-megamenu" style="--i: 1.1s">
                        <a href="javascript:void(0)" class="text-decoration-none online_course">{{ __('translation.Online Courses') }}</a>
                        <div class="dropdown megamenu">
                            <div class="row justify-content-center">
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="mb-0 px-0 megamenu-list ">
                                                @if($course_categories->count() > 0)
                                                    @foreach ($course_categories as $category)
                                                        <li class="mb-2 main-category">
                                                            <a href="javascript:void(0)"
                                                               class="megamenu-menu-link main-link">{{ $category->name }} @if($category->getCourses->count() > 0)
                                                                    <i
                                                                        class="fas fa-angle-right ml-1"></i>
                                                                @endif</a>
                                                            @if($category->getCourses->count() > 0)
                                                                <div class="sub-category shadow-sm">
                                                                    <ul>
                                                                        @foreach ($category->getCourses as $course)
                                                                            <li>
                                                                                <a href="{{ route('online_course_detail',$course->id) }}"
                                                                                   class="megamenu-menu-link child-link">{{ $course->course_title }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="mb-2 main-category">
                                                        <a href="javascript:void(0)"
                                                           class="megamenu-menu-link main-link">No Category Found</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
{{--                                        <div class="col-md-6">--}}
{{--                                            <a class="text-decoration-none" href="{{ route('liveCourse') }}">--}}
{{--                                                <h4 class="mb-3">실시간 강좌 <i class="fas fa-arrow-circle-right"></i></h4>--}}
{{--                                            </a>--}}
{{--                                            <a class="text-decoration-none" href="{{ route('specialCourse') }}">--}}
{{--                                                <h4 class="mb-3">Special Lecture <i--}}
{{--                                                        class="fas fa-arrow-circle-right"></i></h4>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-link has-megamenu" style="--i: 1.35s">
                        <a href="{{ route('offline_lectures') }}" class="text-decoration-none online_course">{{ __('translation.Offline Courses') }}</a>
                        <div class="dropdown megamenu">
                            <div class="row justify-content-center">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="mb-0 px-0 megamenu-list ">
                                                @if($course_offline_categories->count() > 0)
                                                    @foreach ($course_offline_categories as $category)
                                                        <li class="mb-2 main-category">
                                                            <a href="javascript:void(0)"
                                                               class="megamenu-menu-link main-link">{{ $category->name }} @if($category->getOffineCourses->count() > 0)
                                                                    <i
                                                                        class="fas fa-angle-right ml-1"></i>
                                                                @endif</a>
                                                            @if($category->getOffineCourses->count() > 0)
                                                                <div class="sub-category shadow-sm">
                                                                    <ul>
                                                                        @foreach ($category->getOffineCourses as $course)
                                                                            <li>
                                                                                <a href="{{ route('offline_lecture_detail',$course->id) }}"
                                                                                   class="megamenu-menu-link child-link">{{ $course->course_title }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="mb-2 main-category">
                                                        <a href="javascript:void(0)"
                                                           class="megamenu-menu-link main-link">No Category Found</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

{{--                                        <div class="col-md-6">--}}
{{--                                            <a class="text-decoration-none" href="{{ route('offline_liveCourse') }}">--}}
{{--                                                <h4 class="mb-3">실시간 강좌 <i class="fas fa-arrow-circle-right"></i></h4>--}}
{{--                                            </a>--}}
{{--                                            <a class="text-decoration-none" href="{{ route('offline_special_course') }}">--}}
{{--                                                <h4 class="mb-3">Special Lecture <i--}}
{{--                                                        class="fas fa-arrow-circle-right"></i></h4>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('about_us')}}" class="text-decoration-none">{{ __('translation.PTEdu') }}</a>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <ul>
                            <li class="nav-link" style="--i: 1.1s">
                                <a href="{{ route('review') }}" class="text-decoration-none" style="color: black !important;">{{ __('translation.Review') }}</a>
                            </li>
                        </ul>

                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('web-notice')}}"
                           class="text-decoration-none">{{ __('translation.Notice') }}</a>
                    </li>
                </ul>
            </div>
            <div class="log-sign" style="--i: 1.8s">
                <a href="{{ route('shopping_bag') }}" class="btn solid shopping_cart_btn"><span
                        class="shopping_cart_count"
                        data-items-count="{{ count(session('shopping_cart') ?? []) }}">{{ count(session('shopping_cart') ?? []) }}</span>
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                @if(auth()->check())
                    <div class="dropdown_header">
                        <button onclick="myFunction()" class="btn solid"><i class="fa fa-user" aria-hidden="true"></i>
                        </button>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="{{ route('user_info') }}">{{ __('translation.Profile') }}</a>
                            <a href="{{ route('change-user-password') }}">{{ __('translation.Change password') }}</a>
                            <a href="{{ route('student_logout') }}"
                               class="text-danger">{{ __('translation.Logout') }}</a>
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
            <a href="{{ route('shopping_bag') }}" class="btn solid shopping_cart_btn"><span class="shopping_cart_count"
                                                                                            data-items-count="{{ count(session('shopping_cart') ?? []) }}">{{ count(session('shopping_cart') ?? []) }}</span>
                <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
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
