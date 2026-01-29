<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'payment_method',
        'shipping_address',
        'phone',
        'notes',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';

    // Payment method constants
    const PAYMENT_CASH_ON_DELIVERY = 'cash_on_delivery';
    const PAYMENT_PAY_ON_PICKUP = 'pay_on_pickup';

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order items for the order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get formatted status for display.
     */
    public function getStatusLabelAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }

    /**
     * Get formatted payment method for display.
     */
    public function getPaymentMethodLabelAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->payment_method));
    }

    /**
     * Get all available statuses.
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_PROCESSING => 'Processing',
            self::STATUS_SHIPPED => 'Shipped',
            self::STATUS_DELIVERED => 'Delivered',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }

    /**
     * Get all available payment methods.
     */
    public static function getPaymentMethods()
    {
        return [
            self::PAYMENT_CASH_ON_DELIVERY => 'Cash on Delivery',
            self::PAYMENT_PAY_ON_PICKUP => 'Pay on Pickup',
        ];
    }
}
