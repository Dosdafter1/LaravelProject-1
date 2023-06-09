<?php

use App\Models\Poll;

/** @var Poll $poll */

?>

@extends('layouts.main')

@section('title', "$poll->title")

@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <h1 class='h1'>{{$poll->title}}</h1>
            <p>{{$poll->description}}</p>
            <form action="{{route('poll.create-answer')}}" method='POST' class=''>
                @csrf
                @foreach ($poll->getVariants()->get() as $variant)
                <div class="form-check mb-3">
                    <label class="form-check-label">
                        <input type="radio" name='pull_variant_id'  
                            class="form-check-input" value="{{$variant->id}}">{{$variant->text}}
                    </label>
                </div>
                @endforeach
                <input type="submit" class='btn btn-outline-success' value="Send">
            </form>
        </div>
    </div>
    <a class='btn btn-lg btn-outline-primary' style='margin-top:5vh;' href="{{
        Auth::check()?route('poll.index'):route('poll.public-index')
      }}"><i class='fa fa-reply'></i></a>
@endsection
