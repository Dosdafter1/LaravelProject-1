<?php
use App\Models\Donate;
/** 
 *  @var Donate $donate
*/
?>
@extends('layouts.main')
@section('title','Buy')
@section('content')
    <div class="row mt-5">
        <div class='col-md-12'>
            <h2 class='h2'>{{$donate->title}}</h2>
            <h3 class='h3'>{{$donate->descriptions}}</h3>
            <h3 class='h3'>Donate</h3>
            <form action="{{route('pay-donate-request',[$donate])}}" method='GET'>
                <input type="number" name='amount' value="100" hidden>
                <input class='btn btn-outline-success' type="submit" value='100UAH'>
            </form>
            <form action="{{route('pay-donate-request',[$donate])}}" method='GET'>
                <input type="number" name='amount' value="200" hidden>
                <input class='btn btn-outline-success' type="submit" value='200UAH'>
            </form>
            <form action="{{route('pay-donate-request',[$donate])}}" method='GET'>
                <input type="number" name='amount' value="500" hidden>
                <input class='btn btn-outline-success' type="submit" value='500UAH'>
            </form>
            <form action="{{route('pay-donate-request',[$donate])}}" method='GET'>
                <input type="number" name='amount' value="1000" hidden>
                <input class='btn btn-outline-success' type="submit" value='1000UAH'>
            </form>
            <form action="{{route('pay-donate-request',[$donate])}}" method='GET'>
                <input type="number" name='amount' value="2000" hidden>
                <input class='btn btn-outline-success' type="submit" value='2000UAH'>
            </form>
            <form action="{{route('pay-donate-request',[$donate])}}" method='GET'>
                <input type="number" name='amount' value="5000" hidden>
                <input class='btn btn-outline-success' type="submit" value='5000UAH'>
            </form>
            <a class='btn btn-lg btn-outline-primary' style='margin-top:5vh;' href="{{
                route('donate')
              }}"><i class='fa fa-reply'></i></a>
        </div>
    </div>
@endsection