<x-guest-layout :informacoes_user="$informacoes_user">
   @push('scripts')
        <script src="{{ asset('js/search.js') }}" defer></script>
   @endpush
   @push('style')
        <link rel="stylesheet" href="{{asset('css/search.css')}}">
   @endpush

   <div class="main--content--search">
        <div class="main--content--search--middle">
            <div class="main--content--search--input">
                <input type="text" name="search_user_page" id="search_user_page" placeholder="Digite o nome do usuário">
            </div>
            <div class="main--content--search--results" id="main--content--search--results">

            </div>
            <div class="main--content--search--paginator">
                <div class="main--content--search--paginator--mainDiv" id="main--content--search--paginator--mainDiv">

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
