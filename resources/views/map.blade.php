@extends('layout')
@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map {
            height: 500px;
            /* adjust as needed */
            width: 100%;
        }
    </style>
@endsection

@section('content')

    <h1 class="text-3xl font-bold mb-2">Farmers in Gelderland that have already signed up!</h1>

    <div id="map"></div>

    <script>
        var map = L.map('map').setView([52.0, 5.9], 8);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const farmers = @json($farmers);

        farmers.forEach(farmer => {
            if (farmer.lat && farmer.lng) {
                L.marker([farmer.lat, farmer.lng])
                    .addTo(map)
                    .bindPopup(`<b>${farmer.name}</b><br>${farmer.farm_name ?? ''}`);
            }
        });
    </script>

@endsection