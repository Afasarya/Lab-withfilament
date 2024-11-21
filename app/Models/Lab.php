<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Lab extends Model
{
    protected $fillable = ['name', 'description', 'status', 'image'];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
