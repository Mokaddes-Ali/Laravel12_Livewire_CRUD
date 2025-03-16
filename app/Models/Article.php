<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;


    protected $primaryKey = 'id';
    protected $table = 'articles';
    protected $fillable = [
        'title',
        'author',
        'content',
        'slug',
        'image',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getFormattedDateAttribute()
{
    return $this->published_at ? $this->published_at->format('d/m/Y') : 'N/A';
}

}
