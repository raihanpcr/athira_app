@extends('layouts.main')
@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Halaman {{ $title }}</h1>
        </div>
    </section>
    @if (session()->has('success'))
        <div class="alert alert-success mb-2" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title }}</h5>
        </div>
        <div class="card-body">

            {{-- TODO: CRUD Mobil --}}

            <a href="/" class="btn btn-danger mb-2">Kembali</a>
            <a href="/mobil/add" class="btn btn-primary mb-2">Tambah Data Mobil</a>

            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Plat Mobil</th>
                            <th class="text-center">Nama Mobil</th>
                            <th class="text-center">Kapasitas</th>
                            <th class="text-center">Warna</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mobil as $index => $i)
                            <tr>
                                <td class="text-center text-black">{{ $loop->iteration }}</td>
                                <td class="text-center text-black">{{ $i->plat }}</td>
                                <td class="text-center text-black">{{ $i->nama }}</td>
                                <td class="text-center text-black">{{ $i->kapasitas }}</td>
                                <td class="text-center text-black">{{ $i->warna }}</td>
                                <td class="text-center text-black">
                                    <img src="{{ asset('storage/' . $i->foto) }}" alt="user" width="50"
                                        class="img-thumbnail" />
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('detailMobil', $i->id) }}" class="btn btn-info ml-2">Edit
                                        Data</a>

                                    <form action="{{ route('hapusMobil', $i->id) }}" method="POST"
                                        onclick="delete_button(this)">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger mt-2">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
