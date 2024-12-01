<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;


class commentsreaction extends Model
{
    use HasFactory;
    protected $table = 'comments_reactions';

    protected $fillable = [
        'comment_id',
        'user_id',
        'reaction_type',
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    // Relacionamento: Uma reação pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
