@extends('layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Halaman Dashboard</h1>
        </div>
    </section>
    @if (session()->has('success'))
        <div class="alert alert-success mb-2" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Jadwal Keberangkatan</h5>
        </div>
        <div class="card-body">

            {{-- TODO: Update Jadwal Keberangkatan --}}


            <a href="/formKeberangkatan" class="btn btn-primary mb-2">Tambah Keberangkatan</a>
            <button class="btn btn-secondary dropdown-toggle btn btn-info mb-2" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pengaturan
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/mobil">Data Mobil</a>
                <a class="dropdown-item" href="/supir">Data Supir</a>
                <a class="dropdown-item" href="/estimasi">Kota Estimasi</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Keberangkatan</th>
                            <th class="text-center">Kuota Penumpang</th>
                            <th class="text-center">Waktu</th>
                            <th class="text-center">Mobil</th>
                            <th class="text-center">Supir</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keberangkatan as $index => $i)
                            <tr>
                                <td class="text-center text-black">{{ $loop->iteration }}</td>
                                <td class="text-center text-black">{{ $i->tanggal }}</td>
                                <td class="text-center text-black">{{ $i->asals->name }} - {{ $i->tujuans->name }}</td>
                                <td class="text-center text-black">{{ $i->kuota }}</td>
                                <td class="text-center text-black">{{ $i->pukul }}</td>
                                <td class="text-center text-black">{{ $i->mobils->nama }}</td>
                                <td class="text-center text-black">{{ $i->supirs->name }}</td>
                                @if ($i->keterangan == 'Tersedia')
                                    <td class="text-center ">
                                        <span class="badge badge-pill badge-success">{{ $i->keterangan }}</span>
                                    </td>
                                @else
                                    <td class="text-center ">
                                        <span class="badge badge-pill badge-danger">{{ $i->keterangan }}</span>
                                    </td>
                                @endif

                                <td class="text-center">
                                    <div class="row action-button">
                                        <a href="{{ route('viewOrder', $i->id) }}" class="btn btn-success ml-2">Pesan</a>
                                        <a href="{{ route('detailKeberangkatan', $i->id) }}" class="btn btn-info ml-2">Edit
                                            Data</a>

                                        <form action="{{ route('hapusKeberangkatan', $i->id) }}" method="POST"
                                            onclick="delete_button(this)">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger ml-2">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $keberangkatan->links() }}
        </div>
    </div>
@endsection
