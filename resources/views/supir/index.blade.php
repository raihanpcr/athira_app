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
            <a href="/supir/tambahSupir" class="btn btn-primary mb-2">Tambah Data Supir</a>

            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Nohp</th>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supir as $index => $i)
                            <tr>
                                <td class="text-center text-black">{{ $loop->iteration }}</td>
                                <td class="text-center text-black">{{ $i->name }}</td>
                                <td class="text-center text-black">{{ $i->nohp }}</td>

                                <td class="text-center text-black">
                                    <img src="{{ asset('storage/' . $i->foto) }}" alt="user" width="80"
                                        class="img-thumbnail" />
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('detailSupir', $i->id) }}" class="btn btn-info ml-2">Edit
                                        Data</a>

                                    <form action="{{ route('hapusSupir', $i->id) }}" method="POST"
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
