<?php
use App\Models\Category;
use App\Models\Product;
/**
 *  @var Product $product
*/
 ?>
@extends('layouts.main')
@section('title','Edit product')
@section('content')
<div class='container-fluid' style='padding-left: 30vw;'>
    <h2>Image:</h2>
    @if(!empty($product->image))
        <img style="max-width: 300px;" src="{{$product->getImageUrl()}}" 
            title="{{$product->title}}"></td>
    @endif
    <h2>Id: {{$product->id}}</h2>
    <h3>Titile: {{$product->title}}</h3>
    <h3>Price: {{$product->price}}</h3>
    <h3>Quantity: {{$product->quantity}}</h3>
    <h3>Category: {{Category::find($product->category_id)->title}}</h3>
    @if(Auth::check())
    <a class='btn btn-lg btn-outline-info' href="{{route('products-edit',[$product])}}"><i class='fa fa-pencil'></i></a>
    <form method="GET" style="display: inline;"  action="{{route('delprod',[$product])}}">
        @csrf
        <button class='btn btn-lg btn-outline-danger'>
            <i class='fa fa-trash'></i>
        </button>
    </form>
    @endif
    <a class='btn btn-lg btn-outline-success' href="{{route('pay',[$product])}}"><i class='fa fa-shopping-cart '></i></a>                      
    <a class='btn btn-lg btn-outline-primary' href="{{route('products')}}"><i class='fa fa-reply'></i></a>     
    @if(Auth::check())
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Payments</h5>
            </div>
            <div class="card-body">

                <table class="table table-hover">
                    <thead>
                        <th>Id</th>
                        <th>Amount</th>
                        <th>Quantity</th>
                        <th>Date</th>
                    </thead>
                    <tbody>
                    @foreach($product->payments()->get() as $payment )
                          <tr>
                              <td>{{$payment->payment()->id}}</td>
                              <td>{{$payment->payment()->amount}}</td>
                              <td>{{$payment->quantity}}</td>
                              <td>{{$payment->payment()->created_at}}</td>
                          </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    @endif                 

</div>
@endsection