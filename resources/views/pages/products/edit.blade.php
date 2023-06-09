<?php
use App\Models\Category;
use App\Models\Product;
/** @var Category[] $categories 
 *  @var Product $product
*/
 ?>
@extends('layouts.main')
@section('title','Edit product')
@section('content')
@if(!empty($product->image))
        <img style="max-width: 300px;" src="{{$product->getImageUrl()}}" 
            title="{{$product->title}}"></td>
    @endif
<form action="{{route('products-update',[$product])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class='row mt-5'>
        <div class='col-md-4'>
            <div class='mb-3'>
                <label class='form-label'>Title:
                    <input type="text" name='title' class='form-control' value={{$product->title}} require>
                </label>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Price:
                    <input type="number" min='0' step='0.1' name='price' value={{$product->price}} class='form-control' require>
                </label>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Quantity:
                    <input type="number" min='0' step='1' name='quantity' class='form-control' value={{$product->quantity}} require>
                </label>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Category:
                    <select name="category_id" id="categoryid" class='form-control'>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{$category->id==$product->category_id?'selected':''}}>{{$category->title}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Select image
                    <input type="file" name='image' id='image' class='form-control' accept="image/*">
                </label>
            </div>
            <input class='btn btn-outline-success' type="submit" value='Edit'>
        </div>
    </div>
</form>
@endsection