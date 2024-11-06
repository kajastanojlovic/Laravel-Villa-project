

<div class="sub-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <ul class="info">

                    <li><i class="fa fa-envelope"></i> info@company.com</li>
                    @if(auth()->check())
                    <li><i class="fa fa-user"></i>Welcome {{auth()->user()->first_name}}</li>
                    @endif
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                <ul class="social-links">
                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="https://x.com/minthu" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{route('home')}}" class="logo">
                        <h1>Villa</h1>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        @foreach($menu as $m)
                            <li><a href="{{route($m->route)}}" class="active color-meni" >{{$m->name}}</a></li>
                        @endforeach
                        @if(auth()->check() && auth()->user()->role_id == 2)
                                <li><a href="{{route('log.file')}}" class="active color-meni" >LogFile</a></li>
                            @endif


                        @if(!Auth::check())
                                <li id="login"><a href="{{route('login.create')}}"><i class=" fa fa-user"></i> Log in</a></li>
                        @else
                            <li id="login">
                            <form action="{{route('logout')}}" method="POST" id="logoutForm">
                                @csrf
                                <a href="#"  onclick="event.preventDefault();
                                    document.getElementById('logoutForm').submit();">
                                    <i class="fa fa-user"></i>
                                    {{Auth::user()->name}}Log out</a>
                            </form>
                            </li>

                        @endif
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->
