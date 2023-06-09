<?php
    use App\Models\Category;
    /** @var Category $category */
 ?>
@extends('layouts.main')
@section('title','Edit category')
@section('content')
<div class='container-fluid' style='margin-left: 30vw;'>
    <h2>Image:</h2>
    @if(!empty($category->image))
        <img style="max-width: 300px;" src="{{$category->getImageUrl()}}" 
            title="{{$category->title}}"></td>
    @endif
    <h2>Id: {{$category->id}}</h2>
    <h3>Titile: {{$category->title}}</h3>
    <a class='btn btn-lg btn-outline-info' href="{{route('category-edit',[$category])}}"><i class='fa fa-pencil'></i></a>
    <form method="POST" style="display: inline;"  action="{{route('category-delete',[$category])}}">
        @csrf
        <button class='btn btn-lg btn-outline-danger'>
            <i class='fa fa-trash'></i>
        </button>
    </form>
    <a class='btn btn-lg btn-outline-primary' href="{{route('category')}}"><i class='fa fa-reply'></i></a>                      
</div>
@endsection