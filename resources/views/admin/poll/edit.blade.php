<?php
/**
 * @var \App\Models\Poll $model
 */
?>

@extends('layouts.main')

@section('title', "Update poll")

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('poll.update', [$model])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                Title
                            </label>
                            <input type="text" name="title" id="title" value="{{$model->title}}"
                                   class="form-control" placeholder="Poll title">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                Title
                            </label>
                            <textarea id="description" rows="5" name="description"
                                      class="form-control" placeholder="Description">{{$model->description}}</textarea>

                        </div>

                        <button type="submit" class="btn btn-outline-primary need-confirm">Save</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="table-responsive overflow-auto">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Variants</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($model->getVariants()->get() as $variant)
                        <tr>
                            <td>
                                <form class="delete-button" method="POST"
                                    action="{{route('poll.update-variant', [$model, $variant])}}">
                                    @csrf
                                    <input class="form-control" type="text" name='text' id="text"
                                        vlaue='{{$variant->text}}' placeholder="{{$variant->text}}">
                                    
                                    <button type="submit" class="btn btn-sm btn-outline-info need-confirm">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form class="delete-button" method="POST"
                                    action="{{route('poll.destroy-variant', [$model, $variant])}}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger need-confirm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <form method="POST" action="{{route('poll.store-variant', [$model])}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="text" class="form-label">
                        Text
                    </label>
                    <input type="text" name="text" id="text"
                           class="form-control" placeholder="Variant title">
                </div>
                <button type="submit" class="btn btn-outline-primary need-confirm">Add</button>
            </form>
        </div>
    </div>
    <a class='btn btn-lg btn-outline-primary' style='margin-top:5vh;' href="{{route('poll.index')}}"><i class='fa fa-reply'></i></a>
@endsection

@section('end-scripts')
    @vite(['resources/js/poll-edit.js'])
@endsection
