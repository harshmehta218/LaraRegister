<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'email', 'booking_type', 'booking_date', 'booking_sloat', 'booking_time'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
