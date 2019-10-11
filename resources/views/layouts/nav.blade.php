<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <img src="{{ URL::asset('images/Eiffage_2400_02_black_RGB.png') }}"/>
                </a>
                <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="index.html">Dashboard 1</a>
                        </li>
                        <li>
                            <a href="index2.html">Dashboard 2</a>
                        </li>
                        <li>
                            <a href="index3.html">Dashboard 3</a>
                        </li>
                        <li>
                            <a href="index4.html">Dashboard 4</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="chart.html">
                        <i class="fas fa-chart-bar"></i>Charts</a>
                </li>
                <li>
                    <a href="table.html">
                        <i class="fas fa-table"></i>Tables</a>
                </li>
                <li>
                    <a href="form.html">
                        <i class="far fa-check-square"></i>Forms</a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-calendar-alt"></i>Calendar</a>
                </li>
                <li>
                    <a href="map.html">
                        <i class="fas fa-map-marker-alt"></i>Maps</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Pages</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="login.html">Login</a>
                        </li>
                        <li>
                            <a href="register.html">Register</a>
                        </li>
                        <li>
                            <a href="forget-pass.html">Forget Password</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-desktop"></i>UI Elements</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="button.html">Button</a>
                        </li>
                        <li>
                            <a href="badge.html">Badges</a>
                        </li>
                        <li>
                            <a href="tab.html">Tabs</a>
                        </li>
                        <li>
                            <a href="card.html">Cards</a>
                        </li>
                        <li>
                            <a href="alert.html">Alerts</a>
                        </li>
                        <li>
                            <a href="progress-bar.html">Progress Bars</a>
                        </li>
                        <li>
                            <a href="modal.html">Modals</a>
                        </li>
                        <li>
                            <a href="switch.html">Switchs</a>
                        </li>
                        <li>
                            <a href="grid.html">Grids</a>
                        </li>
                        <li>
                            <a href="fontawesome.html">Fontawesome Icon</a>
                        </li>
                        <li>
                            <a href="typo.html">Typography</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->

<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ URL::asset('images/icon/Eiffage_2400_02_black_RGB.png') }}"/>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="@yield('tableau_de_bord') @yield('global') @yield('dirci') @yield('phb') has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>TABLEAU DE BORD</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list" @yield('tableau_de_bord_block')>
                        <li class="@yield('global')">
                            <a href="{{route("global")}}" >Groupement</a>
                        </li>
                        <li class="@yield('dirci')">
                            <a href="{{route("dirci")}}">Direction CI</a>
                        </li>
                        <li class="@yield('phb')">
                            <a href="{{route("phb")}}">Eiffage PHB</a>
                        </li>
                        <li class="@yield('spie_fondation')">
                            <a href="{{route("spie_fondation")}}">SPIE Fondations</a>
                        </li>
                    </ul>
                </li>
                @if(Auth::user() != null && Auth::user()->hasRole('Parametrage'))
                <li class=" @yield('fonction') has-sub">
                    <a class="js-arrow" href="#">
                        <i class="zmdi zmdi-settings"></i>PARAMETRES</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list" @yield('utilisateur_block')  @yield('fonction_block')>
                        <li class="@yield('fonction')">
                            <a href="{{route('fonctions')}}">Fonctions</a>
                        </li>
                            <li class="@yield('lister_effectif') @yield('lister_effectif') has-sub">
                                <a class="js-arrow " href="{{route('effectif')}}">
                                    </i>Effectifs</a>
                            </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user() != null && Auth::user()->hasRole('Gestion_utilisateur'))
                <li class="@yield('utilisateur')">
                   <a href="{{route('utilisateur')}}"> <i class="fas fa-user open" ></i> UTILISATEURS</a>
                </li>
                @endif
                @if(Auth::user() != null && Auth::user()->hasRole('Personnes'))
                <li class="@yield('Ajouter_personne') @yield('lister_personne') has-sub">
                    <a class="js-arrow " href="#">
                        <i class="fas fa-users open" ></i>PERSONNES</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list" @yield('Ajouter_personne_block') @yield('lister_personne_block')>
                        <li class="@yield('lister_personne1')">
                            <a href="{{route('lister_personne',1)}}">Eiffage PHB</a>
                        </li>
                        <li class="@yield('lister_personne2')">
                            <a href="{{route('lister_personne',2)}}">SPIE Fondations</a>
                        </li>
                        <li class="@yield('lister_personne3')">
                            <a href="{{route('lister_personne',3)}}">Direction CI</a>
                        </li>

                    </ul>
                </li>
                @endif
                @if(Auth::user() != null && Auth::user()->hasRole('Invites'))
                <li class="@yield('invite') has-sub">
                    <a class="js-arrow " href="{{route("invite")}}">
                        <i class="fa fa-user-secret" ></i>INVITES</a>

                </li>
                @endif
                @if(Auth::user() != null && Auth::user()->hasRole('Salaires'))
                <li class="@yield('salaires')  has-sub">
                    <a class="js-arrow " href="{{route('salaires')}}">
                        <i class="fas fa-money-bill-alt" ></i>SALAIRES</a>
                </li>
                @endif
                @if(Auth::user() != null && Auth::user()->hasRole('Conges'))
                <li class="@yield('conges') @yield('') has-sub">
                    <a class="js-arrow " href="{{route('conges')}}" target="_self">
                        <i class="fas fa-calendar-alt" ></i>CONGES</a>
                </li>
                @endif
                @if(Auth::user() != null && Auth::user()->hasRole('Parametrage'))
                    <li class="@yield('avantages') @yield('') has-sub">
                        <a class="js-arrow " href="{{route('avantages')}}" target="_self">
                            <i class="fas fa-box"></i>AVANTAGES</a>
                    </li>
                @endif
                @if(Auth::user() != null && Auth::user()->hasRole('Parametrage'))
                    <li class="@yield('epi') @yield('') has-sub">
                        <a class="js-arrow " href="{{route('gestion_epi')}}" target="_self">
                            <i class="fas fa-shield-alt"></i>GESTION DES EPI</a>
                    </li>
                @endif
                @if(Auth::user() != null && Auth::user()->hasRole('Sanctions'))
                <li class="@yield('') @yield('') has-sub">
                    <a class="js-arrow " href="">
                        <i class="fas fa-user-times" ></i>SANCTIONS</a>
                </li>
                @endif
                @if(Auth::user() != null && Auth::user()->hasRole('Etats'))
                <li class="@yield('repertoire') @yield('fin_contrat')  has-sub">
                    <a class="js-arrow " href="#">
                        <i class="fa fa-list" ></i>ETATS</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list" @yield('etats')>
                        <li class="@yield('repertoire')">
                             <a href="{{route('repertoire')}}"><i class="fa fa-phone-square" aria-hidden="true"></i> Repertoire</a>
                        </li>
                        <li class="@yield('fin_contrat')">
                            <a href="{{route('fin_contrat')}}"><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Fin de contrat</a>
                        </li>
                        <li class="@yield('expatrie')">
                            <a href="{{route('expatrie')}}"><i class="fas fa-clipboard-list" aria-hidden="true"></i> Expatriés et invités presents</a>
                        </li>
                        <li class="@yield('personne_contrat')">
                            <a href="{{route('personne_contrat')}}"><i class="fas fa-clipboard-list" aria-hidden="true"></i>Les personnes & leur contrat</a>
                        </li> <li class="@yield('informatique')">
                            <a href="{{route('informatique')}}"><i class="fas fa-clipboard-list" aria-hidden="true"></i>Tableau de gestion du parc informatique</a>
                        </li>

                    </ul>
                </li>
                    @endif

            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->