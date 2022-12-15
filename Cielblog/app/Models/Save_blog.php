<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Save_blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id'
    ];


    public function user_id() {
        return $this->belongsTo(User::class);
    }

    public function article_id() {
        return $this->belongsTo(Article::class);
    }


}
