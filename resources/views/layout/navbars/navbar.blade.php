@auth()
    @include('layout.navbars.navs.auth')
@endauth
    
@guest()
    @include('layout.navbars.navs.guest')
@endguest