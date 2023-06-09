<?php
use App\Models\Donate;
/**
 * @var Donate $donate;
*/
?>
@extends('layouts.main')
@section('title','Add donate')
@section('content')
<div class='container-fluid' style='margin-left: 30vw;'>
    <form method="POST" action="{{route('donate-update',[$donate])}}">
        @csrf
        <div class='row mt-5'>
            <div class='col-md-4'>
                <div class='mb-3'>
                    <label class='form-label'>Title:
                        <input type="text" name='title' value='{{$donate->title}}' class='form-control' placeholder="Title..." required>
                    </label>
                </div>
                <div class='mb-3'>
                    <label class='form-label'>Description: </label>
                    <br>
                    <textarea name="descriptions" id="" placeholder="Desciption..." required>{{$donate->descriptions}}</textarea>
                   
                </div>
                <div class='mb-3'>
                    <label class='form-label'>Target amount:
                        <input type="number" name='required_amount' value='{{$donate->required_amount}}' class='form-control'min='0' step='0.01' required>
                    </label>
                </div>
                <button class='btn btn-outline-primary'>Edit</button>
            </div>
        </div>
    </form>
</div>
@endsection