<?php

use Modules\Map\Entities\Marker;

/** @var Marker $markers */

?>

@extends('map::layouts.master')

@section('content')
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
    @for ($i=0;$i<count($markers);$i++)
    var marker{{$i}} = L.marker([{{$markers[$i]->lat}}, {{$markers[$i]->long}}]).addTo(map);  
    @endfor
      
</script>
@endsection