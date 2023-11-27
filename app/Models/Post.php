<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'description',
        'author',
        'category_id',
        'image'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
