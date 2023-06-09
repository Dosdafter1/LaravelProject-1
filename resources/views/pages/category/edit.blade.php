<?php
    use App\Models\Category;
    /** @var Category $category */
 ?>
@extends('layouts.main')
@section('title','Edit category')
@section('content')
<div class='container-fluid' style='margin-left: 30vw;'>
    @if(!empty($category->image))
        <img style="max-width: 300px;" src="{{$category->getImageUrl()}}" 
            title="{{$category->title}}"></td>
    @endif
    <form method="POST" action="{{route('category-update',[$category])}}" enctype="multipart/form-data">
        @csrf
        <div class='row mt-5'>
            <div class='col-md-4'>
                <div class='mb-3'>
                    <label class='form-label'>Title
                        <input type="text" name='title' class='form-control' value='{{$category->title}}' required>
                    </label>
                </div>
                <div class='mb-3'>
                    <label class='form-label'>Select image
                        <input type="file" name='image' class='form-control' accept="image/*">
                    </label>
                    <button class='btn btn-outline-primary'>Edit</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection