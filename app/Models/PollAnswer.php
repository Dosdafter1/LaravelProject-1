<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int            $id
 * @property int            $poll_variant_id
 * @property PollVariant    $variant
 * 
 */
class PollAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['poll_variant_id'];
    public function getVariant(): HasOne {
        return $this->hasOne(PollVariant::class);
    }
    
}
