<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'year', 'description'];
    public function categories()
    {
        return $this->morphedByMany(Category::class, 'filmable');
    }
    public function actors()
    {
        return $this->morphedByMany(Actor::class, 'filmable');
    }
}
