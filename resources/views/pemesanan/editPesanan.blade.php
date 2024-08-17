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

                <form action="{{ route('updatePesanan', $pesanan->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="row">
                        <div class="col">

                            @php
                                $jumlah = $pesanan->biaya / 150000;
                            @endphp

                            <div class="form-group">
                                <label for="">Tambah Pesanan<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('jumlah') is-invalid @enderror"
                                    name="jumlah" value="{{ $jumlah }}" aria-describedby="emailHelp">
                                @error('jumlah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Tambah Pesanan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
