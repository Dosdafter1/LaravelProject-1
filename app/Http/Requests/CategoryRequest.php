<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

    class CategoryRequest extends FormRequest
    {
        public function rules(){
            return [
                'title'=>'required|max:500',
            ];
        }
        public function setImage(Category $category, $file): void
        {
            $filename = uniqid().'.'.$file->extension();
            $file->storeAs($filename,['disk'=>'categories']);
            if(!empty($category->image))
            {
                Storage::disk('categories')->delete($category->image);
            }
            $category->image=$filename;
        }
    }
?>