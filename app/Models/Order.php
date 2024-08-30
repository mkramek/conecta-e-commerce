<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'discount_code_id',
        'status',
        'total_amount',
        'payment_method_id',
        'courier_id',
        'payment_url',
        'payment_id',
        'tracking_url',
        'tracking_id',
        'shipment_label_raw',
        'address_id',
        'invoice_address_id',
        'delivery_address_id',
        'invoice_delivery_address_id',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(ClientECommerce::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function discountCode()
    {
        return $this->belongsTo(DiscountCode::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 'pending':
                return 'Oczekujące';
            case 'processing':
                return 'Przetwarzane';
            case 'shipped':
                return 'Wysłane';
            case 'delivered':
                return 'Dostarczone';
        }
    }
}
