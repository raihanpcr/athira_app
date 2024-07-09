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
                <form action="{{ route('updateDataKeberangkatan', $keberangkatan->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Keberangkatan</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" value="{{ old('tanggal', $keberangkatan->tanggal) }}"
                                    aria-describedby="emailHelp">
                                @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Kuota Penumpang</label>
                                <input type="number" class="form-control @error('kuota') is-invalid @enderror"
                                    name="kuota" value="{{ old('kuota', $keberangkatan->kuota) }}">
                                @error('kuota')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Pukul</label>
                                <input type="time" class="form-control @error('pukul') is-invalid @enderror"
                                    name="pukul" value="{{ old('pukul', $keberangkatan->pukul) }}">
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
                                    <select name="asal" class="form-control @error('asal') is-invalid @enderror"
                                        value="{{ old('asal') }}">
                                        @foreach ($estimasi as $kota)
                                            <option value="{{ $kota->id }}"
                                                {{ $keberangkatan->asal == $kota->id ? 'selected' : '' }}>
                                                {{ $kota->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('asal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col form-group">
                                    <label for="exampleInputPassword1">Tujuan</label>
                                    <select name="tujuan" class="form-control @error('tujuan') is-invalid @enderror"
                                        value="{{ old('tujuan') }}">
                                        @foreach ($estimasi as $kota)
                                            <option value="{{ $kota->id }}"
                                                {{ $keberangkatan->tujuan == $kota->id ? 'selected' : '' }}>
                                                {{ $kota->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('tujuan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <label for="exampleInputPassword1">Mobil</label>
                                    <select name="mobil" class="form-control @error('mobil') is-invalid @enderror"
                                        value="{{ old('mobil') }}">
                                        @foreach ($mobil as $m)
                                            <option value="{{ $m->id }}"
                                                {{ $keberangkatan->mobil == $m->id ? 'selected' : '' }}>
                                                {{ $m->plat }} - {{ $m->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mobil')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col form-group">
                                    <label for="exampleInputPassword1">Supir</label>
                                    <select name="supir" class="form-control @error('supir') is-invalid @enderror"
                                        value="{{ old('supir') }}">
                                        @foreach ($supir as $s)
                                            <option value="{{ $s->id }}"
                                                {{ $keberangkatan->supir == $s->id ? 'selected' : '' }}>
                                                {{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Edit Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
