<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int     $id
 * @property int     $payment_id
 * @property int     $donate_id
 */
class DonatePayment extends Model
{
    use HasFactory;
    protected $table='donate_payment';
    protected $fillable = [
        'payment_id',
        'donate_id'
    ];
    public function payment():Payment{
        return Payment::find($this->payment_id);
    }
}
