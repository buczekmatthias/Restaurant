<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'code',
        'name',
        'email',
        'password',
        'position',
        'phone',
        'address',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function workplace()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function getAddressAttribute()
    {
        return json_decode($this->attributes['address']);
    }

    public function getPositionAttribute()
    {
        return ucfirst($this->attributes['position']);
    }
}
