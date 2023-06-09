<?php

use App\Models\Poll;

/** @var Poll[] $polls */

?>

@extends('layouts.main')

@section('title', "Polls")

@section('content')
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
                @foreach($polls as $poll)
                    <tr>
                        <td>{{$poll->id}}</td>
                        <td>{{$poll->title}}</td>
                        <td>{{$poll->description}}</td>
                        <td>
                            <a href="{{route('poll.show', [$poll])}}"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{route('poll.data', [$poll])}}"
                               class="btn btn-sm btn-outline-success">
                                <i class="fa fa-bar-chart"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
