<?php

use Modules\Map\Entities\Marker;

/** @var Marker[] $models */

?>

@extends('map::layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="h1">Markers</h1>
        <a href="{{route('admin.map.create')}}" class="btn btn-outline-primary">Create</a>
    </div>
</div>
<div class="row mt-5">
    <div class="col-md-12">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Text</th>
                <th>Lat</th>
                <th>Long</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($models as $model)
                <tr>
                    <td>{{$model->id}}</td>
                    <td>{{$model->popup_text}}</td>
                    <td>{{$model->lat}}</td>
                    <td>{{$model->long}}</td>
                    <td>
                        <a href="{{route('admin.map.show', [$model])}}"
                           class="btn btn-sm btn-outline-secondary">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{route('admin.map.edit', [$model])}}"
                           class="btn btn-sm btn-outline-info">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <form style='display:inline;' class="delete-button" method="POST"
                              action="{{route('admin.map.destroy', [$model])}}">
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
