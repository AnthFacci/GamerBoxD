<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="form-cadastro-custom">
            @csrf

            <div class="mb-3">
                <x-label for="name" value="{{ __('nome') }}" />
                <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="nome de usuário"/>
            </div>

            <div class="mb-3">
                <x-label for="email" value="{{ __('email') }}" />
                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="email" />
            </div>

            <div class="mb-3">
                <x-label for="password" value="{{ __('senha') }}" />
                <x-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="senha" />
            </div>

            <div class="mb-3">
                <x-label for="password_confirmation" value="{{ __('confirme a senha') }}" />
                <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="confirmar senha"/>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mb-3">
                    <x-label for="terms">
                        <div class="form-check">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="form-check-label ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-decoration-underline text-secondary">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-decoration-underline text-secondary">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="d-flex justify-content-between mt-3">
                <a class="text-decoration-none text-secondary" style="color: white !important;" href="{{ route('login') }}">
                    {{ __('já possui conta?') }}
                </a>

                <x-button class="btn btn-register-custom">
                    {{ __('criar conta') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
