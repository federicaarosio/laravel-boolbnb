<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }

    public function visitors() {
        return $this->hasMany(Visitor::class);
    }

    public function sponsors() {
        return $this->belongsToMany(Sponsor::class)->withTimestamps();
    }

    public function services() {
        return $this->belongsToMany(Service::class)->withTimestamps();
    }
}
