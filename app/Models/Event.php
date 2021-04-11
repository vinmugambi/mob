<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function owner() {
        $this->belongsTo(User::class);
    }

    public function bookings() {
        $this->hasMany(Booking::class);
    }
}
