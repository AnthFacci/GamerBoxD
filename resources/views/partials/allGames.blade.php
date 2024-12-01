@if(isset($games['results']) && count($games['results']) > 0)
                        @foreach ($games['results'] as $jogo)
                                @if (intval($jogo['rating'] == 0))
                                    <div class="card" style="background-color: #BCBCBC;">
                                            <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                            <div class="nome_nota">
                                                <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                                @if ($jogo['rating'] == 0)
                                                    <p class="nt_lancamento">-</p>
                                                @else
                                                    <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                                @endif
                                            </div>
                                    </div>
                                @elseif (intval($jogo['rating']) >= 1 && intval($jogo['rating'] <= 2 ))
                                    <div class="card" style="background-color: #CC697B;">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @elseif (intval($jogo['rating']) >= 3 && intval($jogo['rating'] <= 4 ))
                                    <div class="card" style="background-color: #6ECC8E;">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="card" style="background-color: #53e584;">
                                        <img src="{{$jogo['background_image']}}" alt="imagem do {{$jogo['name']}}" class="img_lancamento">
                                        <div class="nome_nota">
                                            <p class="nm_lancamento">{{ $jogo['name'] }}</p>
                                            @if ($jogo['rating'] == 0)
                                                <p class="nt_lancamento">-</p>
                                            @else
                                                <p class="nt_lancamento">{{ number_format(floatval($jogo['rating']), 1) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                        @endforeach
                    @else
                        <p>no games found.</p>
                    @endif
                    <div class="pagination">
                        <div class="previous"><span>anterior</span></div>
                        <div class="paginas">
                            <div class="pag_anterior" id="pag_anterior"><span>1</span></div>
                            <div class="pag_atual" id="pag_atual"><span>2</span></div>
                            <div class="pag_prox" id="pag_prox"><span>3</span></div>
                        </div>
                        <div class="next"><span>próximo</span></div>
                    </div>
