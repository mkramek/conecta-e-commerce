<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class ClientECommerce extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasUuids;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;

    /**
     * \App\Models\ClientECommerce::factory(10)->create();
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'login',
        'email',
        'telephone_prefix',
        'telephone_number',
        'password',
        'is_account_blocked',
        'allow_newsletter',
        'rodo_acceptance',
        'marketing_agreement',
        'symfonia_code',
        'is_b2b',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_account_blocked' => 'boolean',
        'allow_newsletter' => 'boolean',
        'rodo_acceptance' => 'boolean',
        'marketing_agreement' => 'boolean',
        'is_b2b' => 'boolean',
    ];

    public function address(): HasOne
    {
        return $this->hasOne(Address::class, 'client_e_commerce_id');
    }

    public function deliveryAddresses(): HasMany
    {
        return $this->hasMany(DeliveryAddress::class, 'client_e_commerce_id');
    }

    public function invoiceRegisterAddress(): HasOne
    {
        return $this->hasOne(InvoiceRegisterAddress::class, 'client_e_commerce_id');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }
}
