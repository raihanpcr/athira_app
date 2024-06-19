@extends('layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>
    </section>

    <div class="section-body">
        <div class="card col-6">
            <div class="card-header">
                <h5 class="card-title">Form Data Diri</h5>
            </div>
            <div class="card-body">
                <div class="col-10">
                    <form action="{{ route('updateProfil', Str::ucfirst(auth()->user()->id)) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="exampleInputEmail1" value="{{ old('name', Str::ucfirst(auth()->user()->name)) }}"
                                required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="exampleInputPassword1" value="{{ old('email', Str::ucfirst(auth()->user()->email)) }}"
                                required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Alamat</label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                id="exampleInputPassword1" value="{{ old('alamat', Str::ucfirst(auth()->user()->alamat)) }}"
                                required>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">No Telepon</label>
                            <input type="text" name="nohp" class="form-control @error('nohp') is-invalid @enderror"
                                id="exampleInputPassword1" value="{{ old('nohp', Str::ucfirst(auth()->user()->nohp)) }}"
                                required>
                            @error('nohp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Edit Data</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
