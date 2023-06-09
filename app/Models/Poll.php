<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property int            $id
 * @property string         $title
 * @property string         $description
 * @property PollVariant[] $variants
 * @property PollAnswer[] $answers
 */
class Poll extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description'
    ];
    protected static function booted()
    {
        static::deleting(function(Poll $poll){
            foreach($poll->getAnswers()->get() as $answer)
            {
                $answer->delete();
            }
            foreach($poll->getVariants()->get() as $variant)
            {
                $variant->delete();
            }
        });
    }
    public function getVariants(): HasMany
    {
        return $this->hasMany(PollVariant::class);
    }
    public function getAnswers(): HasManyThrough {
        return $this->hasManyThrough(PollAnswer::class, PollVariant::class);
    }
}
