<?php
    use Modules\Map\Entities\Marker;
 ?>
@extends('layouts.main')
@section('title','Add marker')
@section('content')
<div class='container-fluid' style='margin-left: 30vw;'>
    <form method="POST" action="{{route('admin.map.store')}}">
        @csrf
        <div class='row mt-5'>
            <div class='col-md-4'>
                <div class='mb-3'>
                    <label class='form-label'>Popup:
                        <input type="text" name='popup_text' class='form-control' placeholder="Title...">
                    </label>
                </div>
                <div class='mb-3'>
                    <label class='form-label'>Lat:
                        <input type="number" name='lat' id='lat' class='form-control' step="0.0000000000000001" required>
                    </label>
                </div>
                <div class='mb-3'>
                    <label class='form-label'>Long:
                        <input type="number" name='long' id='long' class='form-control' step="0.0000000000000001" required>
                    </label>
                    <button class='btn btn-outline-primary'>Create</button>
                </div>
                </div>
            </div>
        </div>
    </form>
</div>


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<div id="map" style='height:500px;'></div>
<script>
    var map = L.map('map').setView([{{config('app.map_defult_center_lat')}}, 
                                    {{config('app.map_defult_center_long')}}],
                                    {{config('app.map_defult_zoom')}});
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    let marker= null
    
    function changeMarker(lat, long){
        marker.setLatLng(new L.LatLng(lat,long))
    }

    function onMapClick(e) {
        console.log("You clicked the map at " + e.latlng)
        let lat = e.latlng.lat
        let long = e.latlng.lng
        document.querySelector('#lat').value=lat
        document.querySelector('#long').value=long
        changeMarker(lat, long);
    }

    map.on('click', onMapClick);

    $(document).ready(function(){
        marker= L.marker([{{config('app.map_defult_center_lat')}}, 
                            {{config('app.map_defult_center_long')}}]).addTo(map);  
    })
    
</script>
@endsection