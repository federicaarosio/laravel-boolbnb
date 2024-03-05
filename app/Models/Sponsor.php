<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'duration',
        'price'
    ];

    public function apartments() {
        return $this->belongsToMany(Apartment::class)->withTimestamps();
    }
}
