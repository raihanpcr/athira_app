@extends('layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Halaman Tambah Keberangkatan</h1>
        </div>
    </section>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Form Keberangkatan</h5>
            </div>
            <div class="card-body">

                <form action="/tambahKeberangkatan" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Keberangkatan</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" value="{{ old('tanggal') }}" aria-describedby="emailHelp">
                                @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Kuota Penumpang</label>
                                <input type="number" class="form-control @error('kuota') is-invalid @enderror"
                                    name="kuota" value="{{ old('kuota') }}">
                                @error('kuota')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Pukul</label>
                                <input type="time" class="form-control @error('pukul') is-invalid @enderror"
                                    name="pukul" value="{{ old('pukul') }}">
                                @error('pukul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col form-group">
                                    <label for="exampleInputPassword1">Asal</label>
                                    <input type="text" class="form-control @error('asal') is-invalid @enderror"
                                        name="asal" value="{{ old('asal') }}">
                                    @error('asal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col form-group">
                                    <label for="exampleInputPassword1">Tujuan</label>
                                    <input type="text" class="form-control @error('tujuan') is-invalid @enderror"
                                        name="tujuan" value="{{ old('tujuan') }}">
                                    @error('tujuan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Tambah</button>

                </form>
            </div>
        </div>
    </div>
@endsection
