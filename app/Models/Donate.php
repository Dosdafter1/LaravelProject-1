<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

/**
 * @property int    $id
 * @property string $title
 * @property string $descriptions
 * @property float  $required_amount
 * @property float  $amount
 */
class Donate extends Model
{
    use HasFactory;
    protected $table = 'donates';
    protected $fillable = [
        'title',
        'descriptions',
        'required_amount'
    ];
    

    public function donate_payments(): HasMany
    {
        return $this->hasMany(DonatePayment::class, 'donate_id', 'id');
    }

    public function payments(){
        $res=[];
        $donate_payments = $this->donate_payments()->get();
        foreach($donate_payments as $donate_payment)
        {
            $res[]=$donate_payment->payment();
        }
        return $res;
    }

    public function successPayments()
    {
        $payments = $this->payments();
        return array_filter($payments, function($payment){
            return $payment->status==='success';
        });
    }

    public function donePercent(): float {
        if($this->amount>0){
            $res = ($this->amount/$this->required_amount)*100;
            return $res;
        }
        else
            return 0;
    }
}
