<div class="position-relative iq-banner">
    <!--Nav Start-->
    <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
        <div class="container-fluid navbar-inner">
            <a href="../dashboard/index.html" class="navbar-brand">
                <!--Logo start-->
                <!--logo End-->

                <!--Logo start-->
                {{-- <div class="logo-main">
                    <div class="logo-normal">
                        <img src="{{ asset('logo/'. $profile->logo) }}" alt="" width="20%">
                    </div>
                    <div class="logo-mini">
                        <img src="{{ asset('logo/'. $profile->logo) }}" alt="" width="20%">
                    </div>
                </div> --}}
                <!--logo End-->

                <h4 class="logo-title">E-Cashier</h4>
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                    </svg>
                </i>
            </div>
            <div class="caption ms-3 d-none d-md-block">
                <h6 class="mb-0 caption-title">{{date("l")}}</h6>
                <p class="mb-0 caption-sub-title">
                    {{date('d M Y')}}
                </p>
                </div>
            {{-- <div class="input-group search-input">
                <span class="input-group-text" id="search-input">
                    <svg class="icon-18" width="18" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></circle>
                        <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                <input type="search" class="form-control" placeholder="Search..." />
            </div> --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <span class="mt-2 navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                    {{-- <li class="me-0 me-xl-2">
                        <a class="btn btn-primary btn-sm d-flex gap-2 align-items-center" aria-current="page"
                            href="http://hopeui.iqonic.design/pro?utm_source=hopeui-free-demo&utm_medium=hopeui-free-demo&utm_campaign=hopeui-pro-launch"
                            target="_blank">
                            <svg class="icon-16" width="16" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21.4274 2.5783C20.9274 2.0673 20.1874 1.8783 19.4974 2.0783L3.40742 6.7273C2.67942 6.9293 2.16342 7.5063 2.02442 8.2383C1.88242 8.9843 2.37842 9.9323 3.02642 10.3283L8.05742 13.4003C8.57342 13.7163 9.23942 13.6373 9.66642 13.2093L15.4274 7.4483C15.7174 7.1473 16.1974 7.1473 16.4874 7.4483C16.7774 7.7373 16.7774 8.2083 16.4874 8.5083L10.7164 14.2693C10.2884 14.6973 10.2084 15.3613 10.5234 15.8783L13.5974 20.9283C13.9574 21.5273 14.5774 21.8683 15.2574 21.8683C15.3374 21.8683 15.4274 21.8683 15.5074 21.8573C16.2874 21.7583 16.9074 21.2273 17.1374 20.4773L21.9074 4.5083C22.1174 3.8283 21.9274 3.0883 21.4274 2.5783Z"
                                    fill="currentColor"></path>
                                <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.01049 16.8079C2.81849 16.8079 2.62649 16.7349 2.48049 16.5879C2.18749 16.2949 2.18749 15.8209 2.48049 15.5279L3.84549 14.1619C4.13849 13.8699 4.61349 13.8699 4.90649 14.1619C5.19849 14.4549 5.19849 14.9299 4.90649 15.2229L3.54049 16.5879C3.39449 16.7349 3.20249 16.8079 3.01049 16.8079ZM6.77169 18.0003C6.57969 18.0003 6.38769 17.9273 6.24169 17.7803C5.94869 17.4873 5.94869 17.0133 6.24169 16.7203L7.60669 15.3543C7.89969 15.0623 8.37469 15.0623 8.66769 15.3543C8.95969 15.6473 8.95969 16.1223 8.66769 16.4153L7.30169 17.7803C7.15569 17.9273 6.96369 18.0003 6.77169 18.0003ZM7.02539 21.5683C7.17139 21.7153 7.36339 21.7883 7.55539 21.7883C7.74739 21.7883 7.93939 21.7153 8.08539 21.5683L9.45139 20.2033C9.74339 19.9103 9.74339 19.4353 9.45139 19.1423C9.15839 18.8503 8.68339 18.8503 8.39039 19.1423L7.02539 20.5083C6.73239 20.8013 6.73239 21.2753 7.02539 21.5683Z"
                                    fill="currentColor"></path>
                            </svg>
                            Go Pro
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item dropdown">
                        <a href="#" class="search-toggle nav-link" id="dropdownMenuButton2"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="../assets2/images/Flag/flag001.png" class="img-fluid rounded-circle"
                                alt="user" style="height: 30px; min-width: 30px; width: 30px" />
                            <span class="bg-primary"></span>
                        </a>
                        <div class="p-0 sub-drop dropdown-menu dropdown-menu-end"
                            aria-labelledby="dropdownMenuButton2">
                            <div class="m-0 border-0 shadow-none card">
                                <div class="p-0">
                                    <ul class="p-0 list-group list-group-flush">
                                        <li class="iq-sub-card list-group-item">
                                            <a class="p-0" href="#"><img src="../assets2/images/Flag/flag-03.png"
                                                    alt="img-flaf" class="img-fluid me-2" style="
                          width: 15px;
                          height: 15px;
                          min-width: 15px;
                        " />Spanish</a>
                                        </li>
                                        <li class="iq-sub-card list-group-item">
                                            <a class="p-0" href="#"><img src="../assets2/images/Flag/flag-04.png"
                                                    alt="img-flaf" class="img-fluid me-2" style="
                          width: 15px;
                          height: 15px;
                          min-width: 15px;
                        " />Italian</a>
                                        </li>
                                        <li class="iq-sub-card list-group-item">
                                            <a class="p-0" href="#"><img src="../assets2/images/Flag/flag-02.png"
                                                    alt="img-flaf" class="img-fluid me-2" style="
                          width: 15px;
                          height: 15px;
                          min-width: 15px;
                        " />French</a>
                                        </li>
                                        <li class="iq-sub-card list-group-item">
                                            <a class="p-0" href="#"><img src="../assets2/images/Flag/flag-05.png"
                                                    alt="img-flaf" class="img-fluid me-2" style="
                          width: 15px;
                          height: 15px;
                          min-width: 15px;
                        " />German</a>
                                        </li>
                                        <li class="iq-sub-card list-group-item">
                                            <a class="p-0" href="#"><img src="../assets2/images/Flag/flag-06.png"
                                                    alt="img-flaf" class="img-fluid me-2" style="
                          width: 15px;
                          height: 15px;
                          min-width: 15px;
                        " />Japanese</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li> --}}



                    <li class="nav-item dropdown">
                        <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../assets2/images/avatars/01.png" alt="User-Profile"
                                class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded" />
                            <img src="../assets2/images/avatars/avtar_1.png" alt="User-Profile"
                                class="theme-color-purple-img img-fluid avatar avatar-50 avatar-rounded" />
                            <img src="../assets2/images/avatars/avtar_2.png" alt="User-Profile"
                                class="theme-color-blue-img img-fluid avatar avatar-50 avatar-rounded" />
                            <img src="../assets2/images/avatars/avtar_4.png" alt="User-Profile"
                                class="theme-color-green-img img-fluid avatar avatar-50 avatar-rounded" />
                            <img src="../assets2/images/avatars/avtar_5.png" alt="User-Profile"
                                class="theme-color-yellow-img img-fluid avatar avatar-50 avatar-rounded" />
                            <img src="../assets2/images/avatars/avtar_3.png" alt="User-Profile"
                                class="theme-color-pink-img img-fluid avatar avatar-50 avatar-rounded" />
                            <div class="caption ms-3 d-none d-md-block">
                                <h6 class="mb-0 caption-title">{{$user->name}}</h6>
                                <p class="mb-0 caption-sub-title">
                                    {{ $user->role_is == "1" ? "Manager" : "Kasir"; }}
                                </p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="">Ganti Password</a>
                            </li>
                            {{-- <li>
                                <a class="dropdown-item"
                                    href="../dashboard/app/user-privacy-setting.html">Privacy Setting</a>
                            </li> --}}
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Nav Header Component Start -->
    <div class="iq-navbar-header" style="height: 215px">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-wrap d-flex justify-content-between align-items-center">
                        <div>
                            <h1>{{$title['title']}}</h1>
                            <p>
                              {{$title['keterangan']}}
                            </p>
                        </div>
                        <div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="iq-header-img">
            <img src="../assets2/images/dashboard/top-header.png" alt="header"
                class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX" />
            <img src="../assets2/images/dashboard/top-header1.png" alt="header"
                class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX" />
            <img src="../assets2/images/dashboard/top-header2.png" alt="header"
                class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX" />
            <img src="../assets2/images/dashboard/top-header3.png" alt="header"
                class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX" />
            <img src="../assets2/images/dashboard/top-header4.png" alt="header"
                class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX" />
            <img src="../assets2/images/dashboard/top-header5.png" alt="header"
                class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX" />
        </div>
    </div>
    <!-- Nav Header Component End -->
    <!--Nav End-->
</div>
