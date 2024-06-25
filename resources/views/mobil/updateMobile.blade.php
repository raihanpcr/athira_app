@extends('layouts.main')
@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Halaman {{ $title }}</h1>
        </div>
    </section>

    <div class="section-body">
        <div class="card col-8">
            <div class="card-header">
                <h5 class="card-title">Form {{ $title }}</h5>
            </div>
            <div class="card-body">

                <form action="{{ route('updateMobil', $mobil->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">No Polisi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('plat') is-invalid @enderror"
                                    name="plat" value="{{ old('plat', $mobil->plat) }}" aria-describedby="emailHelp">
                                @error('plat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Nama Mobil <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ old('nama', $mobil->nama) }}" aria-describedby="emailHelp">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Muatan Mobil <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('kapasitas') is-invalid @enderror"
                                    name="kapasitas" value="{{ old('kapasitas', $mobil->kapasitas) }}"
                                    aria-describedby="emailHelp">
                                @error('kapasitas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Warna Mobil <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('warna') is-invalid @enderror"
                                    name="warna" value="{{ old('warna', $mobil->warna) }}" aria-describedby="emailHelp">
                                @error('warna')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Foto <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    name="foto" value="{{ old('foto', $mobil->foto) }}" aria-describedby="emailHelp"
                                    id="image" onchange="previewImage()">
                                <img class="img-preview img-fluid img-thumbnail mt-3 col-sm-3"
                                    src="{{ asset('storage/' . $mobil->foto) }}">
                                @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Update Data</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block'
            const oFReader = new FileReader()
            oFReader.readAsDataURL(image.files[0])
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
