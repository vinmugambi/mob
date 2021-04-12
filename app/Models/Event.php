<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["title","start_time", "end_time","address","city","description","image", "user_id"];

    public function owner() {
        return $this->belongsTo(User::class);
    }

    public function bookings() {
       return $this->hasMany(Booking::class);
    }
}
