<?php

use App\Models\Donate;
/** 
 * @var Donate $donate
*/
?>

@extends('layouts.main')

@section('title', $donate->title)

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <p>Total: {{$donate->amount}}</p>
                    <p>Target: {{$donate->required_amount}}</p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$donate->title}}</h5>
                    <p class="card-text">
                        {{$donate->descriptions}}
                    </p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" 
                        style="width: {{$donate->donePercent()}}%;" aria-valuenow="{{$donate->donePercent()}}" 
                            aria-valuemin="0" aria-valuemax="100">{{$donate->donePercent()}}%</div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-outline-primary" href="{{route('donate')}}">
                        <i class='fa fa-reply'></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Payments</h5>
                </div>
                <div class="card-body">

                    <table class="table table-hover">
                        <tbody>
                        @foreach($donate->successPayments() as $payment )
                              <tr>
                                  <td>{{$payment->id}}</td>
                                  <td>{{$payment->status}}</td>
                                  <td>{{$payment->amount}}</td>
                              </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection