<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="{{ asset('storage/images/favicon.ico') }}">
<title>Mocha Blog - Chia sẻ chia từng khoảnh khắc bên ly cà phê Việt.</title>

<!-- Fonts -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">

<!-- Bootstrap core CSS -->
@vite(['resources/js/app.js'])

</head>
<body>
<!-- Begin Nav navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar
================================================== -->
<nav class="navbar navbar-expand navbar-toggleable-md navbar-light bg-white fixed-top mediumnavigation">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container">
        <!-- Begin Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('storage/images/logo.png') }}" alt="logo">
        </a>
        <!-- End Logo -->
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <!-- Begin Menu -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="newsDrop" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tin tức <span class="sr-only">(current)</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDrop">
                        <a class="dropdown-item" href="{{ url('/categories/farm') }}">
                            Chuyện nông trại
                        </a>

                        <a class="dropdown-item" href="{{ url('/categories/processing') }}">
                            Xưởng rang
                        </a>

                        <a class="dropdown-item" href="{{ url('/categories/drink') }}">
                            Cửa hàng
                        </a>
                        @auth
                        @if (Auth::user()->getRoles->whereIn('id', [1, 2])->count() == 1)
                                <a class="dropdown-item" href="{{ url('/news/create') }}">Tạo bài viết</a>
                        @endif 
                        @endauth
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/blogs') }}">Blog</a>
                </li>
                @auth
                    @if (Auth::user()->getRoles->where('id', 1)->count() == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/reports') }}">Khiếu nại</a>
                        </li>
                    @endif 
                @endauth
            </ul>
            <!-- End Menu -->
            <!-- Begin Auth -->
            <ul class="navbar-nav ">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Đăng kí') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDrop" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="author-thumb" src="{{ asset('storage/avatars/'.Auth::user()->avatar) }}" alt="Sal">
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDrop">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                {{ Auth::user()->name }}
                            </a>

                            <a class="dropdown-item" href="{{ route('setting') }}">
                                {{ __('Cài đặt') }}
                            </a>
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Đăng xuất') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            <!-- End Auth -->
            <!-- Begin Search -->
            <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('search') }}">
                @csrf
                <input class="form-control mr-sm-2" type="text" name="search" placeholder="search">
                <button type="submit">
                    <span class="search-icon"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25"><path d="M20.067 18.933l-4.157-4.157a6 6 0 1 0-.884.884l4.157 4.157a.624.624 0 1 0 .884-.884zM6.5 11c0-2.62 2.13-4.75 4.75-4.75S16 8.38 16 11s-2.13 4.75-4.75 4.75S6.5 13.62 6.5 11z"></path></svg></span>
                </button>
            </form>
            <!-- End Search -->
        </div>
    </div>
</nav>
<!-- End Nav
================================================== -->

<!-- Begin Article
================================================== -->
@yield('content')
<!-- End Related Posts
================================================== -->

<!-- Begin Footer
================================================== -->
<div class="container">
	<div class="footer">
		<p class="pull-left">
			 Copyright &copy; 2022 Moka.com
		</p>
		<p class="pull-right">
			 {{-- Mediumish Theme by <a target="_blank" href="https://www.wowthemes.net">WowThemes.net</a> --}}
		</p>
		<div class="clearfix">
		</div>
	</div>
</div>
<!-- End Footer
================================================== -->

<!-- Bootstrap core JavaScript
    ================================================== -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<!-- Dropzone CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" type="text/css">

{{-- <script src="{{ asset('etc/js/') }}"></script> --}}
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Dropzone JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
{{-- CKEditor CDN --}}
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@include('sweetalert::alert')
</body>
</html>
