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

                <form action="{{ route('updateTanggal', $pesanan->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            @foreach ($pesanan->keberangkatan as $item)
                                <input type="hidden" name="bangku" value="{{ $item->id }}">
                                <input type="hidden" name="jml_bangku" value="{{ $pesanan->jml_bangku }}">
                            @endforeach

                            <div class="form-group">
                                <label for="">Perubahan Tanggal <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                    name="date" value="{{ old('date') }}" aria-describedby="emailHelp">
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Ajukan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
