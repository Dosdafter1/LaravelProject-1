<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $product_id
 * @property int $payment_id
 * @property int $quantity
 */
class ProductPayment extends Model
{
    use HasFactory;
    /**
     *  Table in database.
     * @var string 
     */
    protected $table = 'products_payment';
    protected $fillable = [
        'product_id',
        'payment_id',
        'quantity'
    ];
    public function payment():Payment{
        return Payment::find($this->payment_id);
    }
}
