<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

    class ProductRequest extends FormRequest
    {
        public function rules(){
            return [
                'title'=>'required|max:500',
                'price'=>'required',
                'quantity'=>'required',
                'category_id'=>'required'
            ];
        }
        public function setImage(Product $product, $file): void
        {
            $filename = uniqid().'.'.$file->extension();
            $file->storeAs($filename,['disk'=>'products']);
            if(!empty($product->image))
            {
                Storage::disk('products')->delete($product->image);
            }
            $product->image=$filename;
        }
    }
?>