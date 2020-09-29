<!-- HEADER DESKTOP-->
<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <form class="form-header" action="" method="get">

                </form>
                <div class="header-button">

                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="{{ Auth::user()->photo!=''? Storage::url('app/images/users/'.Auth::user()->photo):URL::asset('images/user.png')}}" alt="John Doe" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#">{{Auth::user()->prenoms." ".Auth::user()->nom}}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{ Auth::user()->photo!=''? Storage::url('app/images/users/'.Auth::user()->photo):URL::asset('images/user.png')}}" alt="{{Auth::user()->nom." ".Auth::user()->prenoms}}" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#">{{Auth::user()->prenoms." ".Auth::user()->nom}}</a>
                                        </h5>
                                        <span class="email">{{Auth::user()->email}}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="{{route('profil',['id'=>\Illuminate\Support\Facades\Auth::user()->id])}}">
                                            <i class="zmdi zmdi-account"></i>Mon compte</a>
                                    </div>
                                    
                                </div>
                                <div class="account-dropdown__footer">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="zmdi zmdi-power"></i>Se déconnecter </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER DESKTOP-->