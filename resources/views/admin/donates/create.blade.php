
@extends('layouts.main')
@section('title','Add donate')
@section('content')
<div class='container-fluid' style='margin-left: 30vw;'>
    <form method="POST" action="{{route('donate-store')}}">
        @csrf
        <div class='row mt-5'>
            <div class='col-md-4'>
                <div class='mb-3'>
                    <label class='form-label'>Title:
                        <input type="text" name='title' class='form-control' placeholder="Title..." required>
                    </label>
                </div>
                <div class='mb-3'>
                    <label class='form-label'>Description: </label>
                    <br>
                    <textarea name="descriptions" id="" placeholder="Desciption..." required></textarea>
                   
                </div>
                <div class='mb-3'>
                    <label class='form-label'>Target amount:
                        <input type="number" name='required_amount' class='form-control'min='0' step='0.01' required>
                    </label>
                </div>
                <button class='btn btn-outline-primary'>Create</button>
            </div>
        </div>
    </form>
</div>
@endsection