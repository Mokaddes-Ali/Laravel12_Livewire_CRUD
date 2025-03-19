<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'file_name',
        'file_original_name',
        'folder_path',
        'is_read',
        'created_at',
        'updated_at',

    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    // Accessors with timezone conversion
    protected function createdAt(): Attribute
    {
        return Attribute::get(fn ($value) => Carbon::parse($value)->setTimezone('Asia/Dhaka')->format('h:i A'));
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::get(fn ($value) => Carbon::parse($value)->setTimezone('Asia/Dhaka')->format('h:i A'));
    }


}
