<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int            $id
 * @property string         $text
 * @property int            $poll_id
 * @property Poll           $poll
 * @property PollAnsers[]   $answers
 */
class PollVariant extends Model
{
    use HasFactory;
    protected $fillable = [
        'text',
        'poll_id'
    ];
    public function getPoll(): HasOne {
        return $this->hasOne(Poll::class);
    }
    public function getAnswers(): HasMany{
        return $this->hasMany(PollAnswer::class);
    }
}
