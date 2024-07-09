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

                <form action="{{ route('canclePesanan', $pesanan->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            @foreach ($pesanan->keberangkatan as $item)
                                <input type="hidden" name="bangku" value="{{ $item->id }}">
                                <input type="hidden" name="jml_bangku" value="{{ $pesanan->jml_bangku }}">
                            @endforeach

                            <div class="form-group">
                                <label for="">Alasan Pembatalan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('alasan') is-invalid @enderror"
                                    name="alasan" value="{{ old('alasan') }}" aria-describedby="emailHelp">
                                @error('alasan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Batalkan Pesanan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
