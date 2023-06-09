<?php

use Modules\Map\Entities\Marker;

/** @var Marker $marker */

?>

@extends('layouts.main')
@section('title','Show marker')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<div id="map" style='height:500px;'></div>
<script>
    var map = L.map('map').setView([{{$marker->lat}}, {{$marker->long}}], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    var marker1 = L.marker([{{$marker->lat}}, {{$marker->long}}]).addTo(map);    
</script>
@endsection