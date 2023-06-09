<?php
    use App\Models\Donate;
    /** @var Donate[] $donates */
 ?>
@extends('layouts.main')
@section('title','Donate')
@section('content')
    <div class='container' style="padding-left: 29vw">
        <h1 class='h1'>Donates:</h1>
        @if(Auth::check())
        <a href="{{route('donate-create')}}" class="btn btn-outline-warning" style='width: fit-content; height: 5vh;'>Add donate</a>
        @endif
        <div class='row mt-5'>
            <div class='col-md-6'>
                <table class='table table-hover'>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Progress</th>
                            <th>Other</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donates as $donate)
                        <tr>
                            <td>{{$donate->id}}</td>
                            <td>{{$donate->title}}</td>
                            <td>{{$donate->descriptions}}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" 
                                    style="width: {{$donate->donePercent()}}%;" aria-valuenow="{{$donate->donePercent()}}" 
                                        aria-valuemin="0" aria-valuemax="100">{{$donate->donePercent()}}%</div>
                                </div>
                            </td>
                            <td>
                                <a class='btn btn-sm btn-outline-danger' href="{{route('donate-pay',[$donate])}}"><i class='fa fa-heart'></i></a>
                               @if(Auth::check())
                                <a class='btn btn-sm btn-outline-info' href="{{route('donate-edit',[$donate])}}"><i class='fa fa-pencil'></i></a>
                                <form method="POST" style="display: inline;"  action="{{route('donate-destroy',[$donate])}}">
                                    @csrf
                                    <button class='btn btn-sm btn-outline-danger'>
                                        <i class='fa fa-trash'></i>
                                    </button>
                                </form>
                                <a class='btn btn-sm btn-outline-secondary' href="{{route('donate-show',[$donate])}}"><i class='fa fa-eye'></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection