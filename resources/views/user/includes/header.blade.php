<header>
    <div class="container header-container">
        <input type="checkbox" name="" id="check">

        <div class="logo-container">
            <h3 class="logo">
                <a class="text-decoration-none text-dark" href="{{ route('web-home') }}">PTEdu<sub>®</sub> </a>
            </h3>
        </div>

        <div class="nav-btn">
            <div class="nav-links navigation-mobile">
                <ul>
                    <li class="nav-link" style="--i: 1.1s">
                        <a href="{{ route('web-home') }}" class="text-decoration-none">Expert course<i class="fas fa-angle-down"></i></a>
                        <div class="dropdown">
                            <ul>
                                <li class="dropdown-link">
                                    <a href="#" class="text-decoration-none">Physical Teraphy<i class="fas fa-angle-down"></i></a>
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
                                    <a href="#">Philates<i class="fas fa-angle-down"></i></a>
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
                                    <a href="javascript:void(0)" class="text-decoration-none">Offline</a>
                                </li>
                                <div class="arrow"></div>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-link" style="--i: .85s">
                        <a href="{{ route('web-home') }}" class="text-decoration-none">Public course<i class="fas fa-angle-down"></i></a>
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
                        <a href="{{ route('web-home') }}" class="text-decoration-none">PTEdu</a>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('review') }}" class="text-decoration-none">Review</a>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('web-notice') }}" class="text-decoration-none">Notice</a>
                    </li>
                </ul>
            </div>
            <div class="nav-links navigation-desktop">
                <ul>
                    <li class="nav-link has-megamenu" style="--i: 1.1s">
                        <a href="#" class="text-decoration-none">Expert course<i class="fas fa-angle-down"></i></a>
                        <div class="dropdown megamenu">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <h4 class="mb-3">Physical Teraphy</h4>
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
                                    <h4 class="mb-3">Pilates</h4>
                                    <ul class="mb-0 px-0 megamenu-list">
                                        @foreach ($online_expert_courses as $expert_courses)
                                        <li><a href="{{ route('online_course_detail' , $expert_courses->id ) }}" class="megamenu-menu-link">{{ $expert_courses->course_title }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <h4 class="mb-3">Offline <i class="fas fa-arrow-circle-right"></i></h4>
                                    <h4 class="mb-3">Online <i class="fas fa-arrow-circle-right"></i></h4>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-link has-megamenu" style="--i: .85s">
                        <a href="javascript:void(0)" class="text-decoration-none">Public course<i class="fas fa-angle-down"></i></a>
                        <div class="dropdown megamenu">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <h4 class="mb-3">Physical Teraphy</h4>
                                    <ul class="mb-0 px-0 megamenu-list">
                                        @foreach ($online_public_courses as $public_courses)
                                        <li>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <a href="{{ route('online_course_detail' , $public_courses->id ) }}" class="megamenu-menu-link">{{ $public_courses->course_title }}</a>
                                                </div>
                                                <div class="col-md-5">
                                                    <a href="javascript:void(0)" class="megamenu-menu-link text-muted">{{ $public_courses->getTutorName->name }}</a>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <h4 class="mb-3">Pilates</h4>
                                    <ul class="mb-0 px-0 megamenu-list">
                                        @foreach ($online_public_courses as $public_courses)
                                        <li><a href="{{ route('online_course_detail' , $public_courses->id ) }}" class="megamenu-menu-link">{{ $public_courses->course_title }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <h4 class="mb-3">Offline <i class="fas fa-arrow-circle-right"></i></h4>
                                    <h4 class="mb-3">Online <i class="fas fa-arrow-circle-right"></i></h4>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('web-home')}}" class="text-decoration-none">PTEdu</a>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('review')}}" class="text-decoration-none">Review</a>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="{{ route('web-notice')}}" class="text-decoration-none">Notice</a>
                    </li>
                </ul>
            </div>
            <div class="log-sign" style="--i: 1.8s">
                @if(auth()->check())
                <div class="dropdown_header">
                    <button onclick="myFunction()" class="btn solid"><i class="fa fa-user" aria-hidden="true"></i></button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="{{ route('user_info') }}">Profile</a>
                        <a href="{{ route('change-user-password') }}">Change password</a>
                        <a href="{{ route('student_logout') }}" class="text-danger">Logout</a>
                    </div>
                </div>
                @else
                <a href="{{ route('user_login') }}" class="btn solid">Login</a>
                @endif
                @if(auth()->check())
                <a href="{{ route('my_classroom') }}" class="btn solid">My Classroom</a>
                <a href="{{ route('shopping_bag') }}" class="btn solid"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                @endif
            </div>
        </div>

        <div class="hamburger-menu-container">
            <div class="hamburger-menu">
                <div></div>
            </div>
        </div>
    </div>
</header>

<script>
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
</script>