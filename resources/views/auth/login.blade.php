<x-guest-layout>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="login_logo">
            <div class="logo_x">
                <a href="{{route('home')}}"> <img src="{{asset('svg/x.svg')}}" alt="voltar para home de jogos" class="logo_login_cad"></a>
            </div>
            <div class="p-4 card-login-custom">
                {{-- <div class="text-center mb-4">
                    <x-authentication-card-logo />
                </div> --}}
                <x-validation-errors class="mb-3 text-danger" />

                @if (session('status'))
                    <div class="alert alert-success text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <x-label for="email" value="{{ __('email') }}" />
                        <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nome de usuário"/>
                    </div>

                    <div class="form-group mt-3">
                        <x-label for="password" value="{{ __('senha') }}" />
                        <x-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="senha"/>
                    </div>

                    <div class="form-group mt-3">
                        <label for="remember_me" class="d-flex align-items-center" style="gap: 4px; cursor: pointer;">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-3 small" style="color: white;">{{ __('lembrar de mim') }}</span>
                        </label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        @if (Route::has('password.request'))
                            <a class="small text-decoration-none" style="color: white" href="{{ route('password.request') }}">
                                {{ __('esqueci minha senha?') }}
                            </a>
                        @endif

                        <x-button class="btn btn-primary" style="background-color: white; color: #DA85DD !important; font-weight: bold;">
                            {{ __('entrar') }}
                        </x-button>
                    </div>

                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <a href="{{ route('register') }}" class="small text-decoration-none" style="color: white">
                            <x-button class="btn btn-primary custom-button-login-criar">
                                {{ __('criar conta') }}
                            </x-button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
