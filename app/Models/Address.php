<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'address2',
        'city',
        'state',
        'country',
        'zip_code',
        'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFullAddressAttribute()
    {
        $address = $this->address;
        if ($this->address2) {
            $address .= ', ' . $this->address2;
        }
        $address .= ', ' . $this->city . ', ' . $this->state . ' ' . $this->zip_code . ', ' . $this->country;
        
        return $address;
    }
}