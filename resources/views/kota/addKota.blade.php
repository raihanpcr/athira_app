@extends('layouts.main')
@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Halaman </h1>
        </div>
    </section>

    <div class="section-body">
        <div class="card col-12">
            <div class="card-header">
                <h5 class="card-title">Form </h5>
            </div>
            <div class="card-body">

                <form action="/estimasi/tambahKota" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Nama Kota <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('plat') is-invalid @enderror"
                                    name="kota" value="{{ old('plat') }}" aria-describedby="emailHelp">
                                @error('plat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Longitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="longitude" id="longitude" value="{{ old('nama') }}"
                                    aria-describedby="emailHelp">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Latitude <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kapasitas') is-invalid @enderror"
                                    name="latitude" id="latitude" value="{{ old('kapasitas') }}"
                                    aria-describedby="emailHelp">
                                @error('kapasitas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <div class="col">
                            <div class="form-group">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        var map = L.map('map').setView([0.5070030714083767, 101.44781050484143], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        //   var marker = L.marker([0.5070030714083767, 101.44781050484143]).addTo(map)
        //       .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
        //       .openPopup();

        var latInput = document.querySelector("[name=latitude]");
        var lngInput = document.querySelector("[name=longitude]");

        var curLocation = [-0.45674492770160435, 101.34848239308646];

        map.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocation, {
            draggable: 'true',
        });

        //mengambil koordinat marker pindah
        marker.on('dragend', function(e) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
                curLocation
            }).bindPopup(position).update();
            $("#latitude").val(position.lat);
            $("#longitude").val(position.lng);
        });

        //mengambil coordinat saat map diklik
        map.on("click", function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            if (!marker) {
                marker = L.marker(e.latlng).addTo(map);
            } else {
                marker.setLatLng(e.latlng);
            }
            latInput.value = lat;
            lngInput.value = lng;
        });

        map.addLayer(marker);
    </script>
@endsection
