<div class="d-flex min-vh-100 justify-content-center align-items-center pt-3 pt-sm-0 bg-custom custom-main">
    <div class="logo_form">
        <div class="logo_x">
            <a href="{{route('home')}}"> <img src="{{asset('svg/x.svg')}}" alt="voltar para home de jogos" class="logo_login_cad"></a>
        </div>
        <div class="mt-3 mt-sm-4 px-4 py-3 shadow overflow-hidden rounded login-box-custom">
            {{ $slot }}
        </div>
    </div>
</div>

