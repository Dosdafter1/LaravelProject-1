<?php
use App\Models\Products;
/** 
 *  @var Product $product
*/
?>
@extends('layouts.main')
@section('title','Buy')
@section('content')
    <div class="row mt-5">
        <div class='col-md-12'>
            <img style="max-width: 300px;" rc="{{$product->getImageUrl()}}">
            <h2 class='h2'>{{$product->title}}</h2>
            @if($product->quantity>0)
            <form action="{{route('pay-request',[$product])}}" method='GET'>
                <label class='form-label'>Quantity:
                    <input type="number" min='0' step='1' name='quantity' class='form-control' max='{{$product->quantity}}' require>
                </label>
                <input class='btn btn-outline-success' type="submit" value='Buy'>
            </form>
            @endif
            <a class='btn btn-lg btn-outline-primary' style='margin-top:5vh;' href="{{
                route('products-edit',[$product])
              }}"><i class='fa fa-reply'></i></a>
        </div>
    </div>
@endsection