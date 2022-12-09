<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'account_id'
    ];

    public function category_id() {
        return $this->belongsTo(Category::class);
    }

    public function account_id() {
        return $this->belongsTo(Account::class);
    }

    public function save_blog() {
        return $this->hasMany(Save_blog::class);
    }
}