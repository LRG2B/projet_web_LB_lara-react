<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Save_blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'article_id'
    ];


    public function account_id() {
        return $this->belongsTo(Account::class);
    }

    public function article_id() {
        return $this->belongsTo(Article::class);
    }


}
