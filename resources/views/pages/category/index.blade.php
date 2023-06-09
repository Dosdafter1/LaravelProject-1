<?php
    use App\Models\Category;
    /** @var Category[] $categories */
 ?>
@extends('layouts.main')
@section('title','Categories')
@section('content')
    <div class='container' style="padding-left: 29vw">
        <form method="GET">
            {{{Form::open(['method'=>'get'])}}}
            <div class='row mt-5'>
                <div class='col-md-4'>
                    <div class='mb-3'>
                        <label for="search" class='form-label'>Search
                            <input type="text" name='search' value='{{$search}}' class='form-control' id="search" placeholder="Search...">
                            <button class='btn btn-primary'>Search</button>
                        </label>
                    </div>
                </div>
            </div>
            {{{Form::close()}}}
        </form>
        <a href="{{route('category-create')}}" class="btn btn-outline-warning" style='width: fit-content; height: 5vh;'>Add category</a>
        <div class='row mt-5'>
            <div class='col-md-6'>
                <table class='table table-hover'>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Other</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->title}}</td>
                            <td>
                                @if(!empty($category->getImageUrl()))
                                <img style="width: 100px" src="{{$category->getImageUrl()}}" 
                                        title="{{$category->title}}">
                                @endif
                            </td>
                            <td>
                                <a class='btn btn-sm btn-outline-info' href="{{route('category-edit',[$category])}}"><i class='fa fa-pencil'></i></a>
                                <form method="POST" style="display: inline;"  action="{{route('category-delete',[$category])}}">
                                    @csrf
                                    <button class='btn btn-sm btn-outline-danger'>
                                        <i class='fa fa-trash'></i>
                                    </button>
                                </form>
                                <a class='btn btn-sm btn-outline-secondary' href="{{route('category-show',[$category])}}"><i class='fa fa-eye'></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection