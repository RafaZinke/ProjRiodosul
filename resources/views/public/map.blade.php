@extends('layouts.app')

@section('title', 'Mapa')

@section('content')
<h1>Mapa de Marcos</h1>
<div id="map" style="height:500px;"></div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_key') }}&callback=initMap"></script>
<script>
function initMap() {
    const map = new google.maps.Map(document.getElementById('map'), { zoom: 12, center: { lat: -27.2193, lng: -49.6459 } });
    fetch("{{ route('api.map') }}")
        .then(res => res.json())
        .then(data => {
            data.forEach(item => {
                new google.maps.Marker({ position: { lat: parseFloat(item.latitude), lng: parseFloat(item.longitude) }, map, title: item.name });
            });
        });
}
</script>