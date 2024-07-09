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
                            @if ($keberangkatan->kuota <= 0)
                                <p class="badge badge-pill badge-danger">Kuota Penuh</p>
                            @else
                                <p class="badge badge-pill badge-success">{{ $keberangkatan->keterangan }}</p>
                            @endif
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

    <div class="card col mt-3">
        <div class="card-header">
            <h5 class="card-title">Form Pemesanan</h5>
        </div>
        <div class="card-body">
            <form action="/pesanan/pesan" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <input type="hidden" name="user" value="{{ Str::ucfirst(auth()->user()->id) }}">
                        <input type="hidden" name="keberangkatan" value="{{ $keberangkatan->id }}">
                        <div class="form-group">
                            <label for="">Nama Pemesan<span class="text-danger">*</span></label>
                            <p>{{ Str::ucfirst(auth()->user()->name) }}</p>
                        </div>

                        <div class="form-group">
                            <label for="">Jumlah Bangku <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('bangku') is-invalid @enderror" name="bangku"
                                value="{{ old('bangku') }}" aria-describedby="emailHelp">
                            @error('bangku')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Link Google Maps Penjemputan</label>
                            <input type="text" class="form-control @error('maps') is-invalid @enderror" name="maps"
                                value="{{ old('maps') }}" aria-describedby="emailHelp">
                            @error('maps')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Alamat Jemput<span class="text-danger">*</span></label>
                            <textarea name="jemput" class="form-control @error('jemput') is-invalid @enderror" value="{{ old('jemput') }}"
                                style="height:100px"></textarea>
                            @error('jemput')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Alamat Turun<span class="text-danger">*</span></label>
                            <textarea name="turun" class="form-control @error('turun') is-invalid @enderror" id=""
                                value="{{ old('turun') }}" style="height:100px"></textarea>
                            @error('turun')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                @if ($keberangkatan->kuota <= 0)
                    <button class="btn btn-danger" type="submit" disabled>Tambah Pemesanan</button>
                @else
                    {{-- <p class="badge badge-pill badge-success">{{ $keberangkatan->keterangan }}</p> --}}
                    <button class="btn btn-primary" type="submit">Tambah Pemesanan</button>
                @endif
        </div>
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
