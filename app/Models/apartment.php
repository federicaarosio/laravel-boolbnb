<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'room_number',
        'bed_number',
        'toilet_number',
        'square_meters',
        'img_url',
        'is_visible',
        'address',
        'longitude',
        'latitude'
    ];
}
