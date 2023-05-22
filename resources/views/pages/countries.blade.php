@extends('layouts.main')
@section('title','Countries')
@section('content')
    <script>
        function getCountries()
        {
            let searhInpt = document.querySelector('#search').value
            let xhr = new XMLHttpRequest();
            let url = `{{(route("countries-search"))}}`+searhInpt
            xhr.open("GET",url,true)
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
            xhr.onload = function() {
                    let response = JSON.parse(xhr.responseText);
                    let countries =  document.querySelector('#cntrs')
                    $('#cntrs').empty();
                    for(let c of response)
                    {
                        let li = document.createElement('li')
                        li.innerHTML=c;
                        countries.appendChild(li)
                    }     
            }
            xhr.send();
        }
    </script>
    <label for="">Country:</label>
    <br>
    <input type="text" id='search' onkeyup="getCountries()">
    <ul id='cntrs'>
    </ul>
@endsection