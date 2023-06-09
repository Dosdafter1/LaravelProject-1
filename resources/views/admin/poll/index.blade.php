<?php

use App\Models\Poll;

/** @var Poll[] $models */

?>

@extends('layouts.main')

@section('title', "Polls")

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1">Polls</h1>
            <a href="{{route('poll.create')}}" class="btn btn-outline-primary">Create</a>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                <tr>

                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Other</th>
                </tr>
                </thead>
                <tbody>
                @foreach($models as $model)
                    <tr>
                        <td>{{$model->id}}</td>
                        <td>{{$model->title}}</td>
                        <td>{{$model->description}}</td>
                        <td>
                            <a href="{{route('poll.show', [$model])}}"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{route('poll.edit', [$model])}}"
                               class="btn btn-sm btn-outline-info">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="{{route('poll.data', [$model])}}"
                               class="btn btn-sm btn-outline-success">
                                <i class="fa fa-bar-chart"></i>
                            </a>
                            <form style='display:inline;' class="delete-button" method="POST"
                                  action="{{route('poll.destroy', [$model])}}">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
