<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'primary_address',
        'secondary_address',
    ];

        // Relationship with orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relationship with addresses
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    // Relationship with default billing address
    public function defaultBillingAddress()
    {
        return $this->hasOne(Address::class)->where('type', 'billing')->where('is_default', true);
    }

    // Relationship with default shipping address
    public function defaultShippingAddress()
    {
        return $this->hasOne(Address::class)->where('type', 'shipping')->where('is_default', true);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
