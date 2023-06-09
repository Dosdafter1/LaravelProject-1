<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *  @property int    $id
*   @property int    $order_id
*   @property string $description
*   @property string $card_mask
*   @property string $currency
*   @property float  $amount
*   @property string $result
*   @property string $liqpay_order_id
*   @property string $status
*   @property string $payment_id
*   @property string $paytype
 */
class Payment extends Model
{
    use HasFactory;
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table='payments';
    public $fillable = [
        'order_id',
        'description',
        'card_mask',
        'currency',
        'amount',
        'result',
        'liqpay_order_id',
        'status',
        'payment_id',
        'paytype'
    ];

    public function donate(): HasMany
    {
        return $this->hasMany(DonatePayment::class);
    }
    public function product(): HasMany
    {
        return $this->hasMany(ProductPayment::class);
    }
    protected static function booted()
    {
        static::deleting(function(Payment $payment){
            foreach($payment->donate()->get() as $don)
            {
                $don->delete();
            }
            foreach($payment->product()->get() as $prod)
            {
                $prod->delete();
            }
        });
    }
}
