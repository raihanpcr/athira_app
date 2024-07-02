@extends('layouts.main')
@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Halaman {{ $title }}</h1>
        </div>
    </section>

    <div class="section-body">

        {{-- Info Keberangkatan --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Info Keberangkatan</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <h5 class="font-weight-bold">Tanggal</h5>
                            <p class="card-text">{{ $keberangkatan->tanggal }}</p>
                        </div>

                        <div class="form-group">
                            <h5 class="font-weight-bold">Keberangkatan</h5>
                            <p class="card-text">{{ $keberangkatan->asals->name }} - {{ $keberangkatan->tujuans->name }}</p>
                        </div>

                        <div class="form-group">
                            <h5 class="font-weight-bold">Kuota Penumpang</h5>
                            <p class="card-text">{{ $keberangkatan->kuota }}</p>
                        </div>

                        <div class="form-group">
                            <h5 class="font-weight-bold">Waktu Keberangkatan</h5>
                            <p class="card-text">{{ $keberangkatan->pukul }}</p>
                        </div>

                        <div class="form-group">
                            <h5 class="font-weight-bold">Keterangan</h5>
                            <p class="badge badge-pill badge-success">{{ $keberangkatan->keterangan }}</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-shadow" id="maproute"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Info Mobil --}}

        <div class="card-group">
            <div class="card">
                <div class="row">
                    <div class="col">
                        <img class="img-preview img-thumbnail ml-3 mt-3" style="width: 400px; height: 300px;"
                            src="{{ asset('storage/' . $keberangkatan->mobils->foto) }}">
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <h5 class="card-title">{{ $keberangkatan->mobils->plat }}</h5>
                            <p class="card-text"> Nama Mobil - {{ $keberangkatan->mobils->nama }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>

            <div class="card ml-3">
                <div class="row">
                    <div class="col">
                        <img class="img-preview img-thumbnail ml-3 mt-3" style="width: 400px; height: 300px;"
                            src="{{ asset('storage/' . $keberangkatan->supirs->foto) }}">
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <h5 class="card-title">Nama Supir : {{ $keberangkatan->supirs->name }}</h5>
                            <p class="card-text"> No Handphone - {{ $keberangkatan->supirs->nohp }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>

        </div>


    </div>

    <div class="card col-8 mt-3">
        <div class="card-header">
            <h5 class="card-title">Form Pemesanan</h5>
        </div>
        <div class="card-body">
            <form action="/mobil/add" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">No Polisi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('plat') is-invalid @enderror" name="plat"
                                value="{{ old('plat') }}" aria-describedby="emailHelp">
                            @error('plat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Nama Mobil <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                value="{{ old('nama') }}" aria-describedby="emailHelp">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Muatan Mobil <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('kapasitas') is-invalid @enderror"
                                name="kapasitas" value="{{ old('kapasitas') }}" aria-describedby="emailHelp">
                            @error('kapasitas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Warna Mobil <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('warna') is-invalid @enderror" name="warna"
                                value="{{ old('warna') }}" aria-describedby="emailHelp">
                            @error('warna')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Foto <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto"
                                value="{{ old('foto') }}" aria-describedby="emailHelp" id="image"
                                onchange="previewImage()">
                            <img class="img-preview img-fluid img-thumbnail mt-3 col-sm-3">
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Tambah Pemesanan</button>
            </form>
        </div>
    </div>
    </div>
    <script>
        var map = L.map('maproute').setView([{{ $keberangkatan->tujuans->latitude }},
            {{ $keberangkatan->tujuans->longitude }}
        ], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.Routing.control({
            waypoints: [
                L.latLng({{ $keberangkatan->asals->latitude }}, {{ $keberangkatan->asals->longitude }}),
                L.latLng({{ $keberangkatan->tujuans->latitude }}, {{ $keberangkatan->tujuans->longitude }})
            ]
        }).addTo(map);

        map.addLayer(marker);
    </script>
@endsection
