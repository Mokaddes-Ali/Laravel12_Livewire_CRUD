<?php

// app/Models/Course.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'creator',
        'editor',
        'user_id',
        'price',
        'is_active',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            $course->slug = Str::slug($course->name) . '-' . Str::random(6); // Auto-generate 8-digit slug
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor');
    }
}
