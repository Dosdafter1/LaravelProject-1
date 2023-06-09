<?php
    use App\Models\Category;
    /** @var Category[] $categories */
 ?>
@extends('layouts.main')
@section('title','Add category')
@section('content')
<div class='container-fluid' style='margin-left: 30vw;'>
    <form method="POST" action="{{route('category-store')}}" enctype="multipart/form-data">
        @csrf
        <div class='row mt-5'>
            <div class='col-md-4'>
                <div class='mb-3'>
                    <label class='form-label'>Title
                        <input type="text" name='title' class='form-control' placeholder="Title..." required>
                    </label>
                </div>
                <div class='mb-3'>
                    <label class='form-label'>Select image
                        <input type="file" name='image' class='form-control' accept="image/*">
                    </label>
                    <button class='btn btn-outline-primary'>Create</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection