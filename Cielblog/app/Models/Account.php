<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'mail',
        'password',
        'admin'
    ];

    public function articles() {
        return $this->hasMany(Article::class);
    }
    
    public function save_blog() {
        return $this->hasMany(Save_blog::class);
    }
}
