<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function owner() {
        $this->belongsTo(User::class);
    }

    public function bookings() {
        $this->hasMany(Booking::class);
    }
}
