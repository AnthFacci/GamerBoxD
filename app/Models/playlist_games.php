<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\playlist;

class playlist_games extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'playlist_game';

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'playlist_id',
        'game_id',
    ];

    /**
     * Relacionamento com o modelo Playlist.
     */
    public function playlist()
    {
        return $this->belongsTo(playlist::class);
    }

    /**
     * Relacionamento com o modelo Game.
     */
}
