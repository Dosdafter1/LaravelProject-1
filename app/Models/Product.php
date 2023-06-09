<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

/**
 * @property int         $id
 * @property string      $title
 * @property float       $price
 * @property integer     $quantity
 * @property int         $category_id
 * @property string|null $image
 * @property Category    $Category
 */
class Product extends Model
{
    use HasFactory;
    /**
     * Table in database.
     *
     * @var string
     */
    protected $fillable = [
        'title',
        'price',
        'quantity',
        'category_id'
      ];
    protected $table = 'products';
    public function payments(): HasMany
    {
        return $this->hasMany(ProductPayment::class);
    }
    protected static function booted()
    {
        static::deleting(function(Product $product){
            foreach($product->payments()->get() as $pay)
            {
                $pay->delete();
            }
        });
    }
    
    public function getCategory(): HasOne {
        return $this->hasOne(Category::class);
    }
    public function getImageUrl(): ?string {
        if(empty($this->image)){
            return null;
        }
        return Storage::url('\products\\'.$this->image);
    }
}
