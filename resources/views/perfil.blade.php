<x-guest-layout :informacoes_user="$informacoes_user">
    @push('scripts')
        <script src="{{ asset('js/perfil_user.js') }}" defer></script>
    @endpush
    @push('style')
        <link rel="stylesheet" href="{{asset('css/perfil_user.css')}}">
    @endpush
    <div class="main--content--perfil">

    </div>
</x-guest-layout>
