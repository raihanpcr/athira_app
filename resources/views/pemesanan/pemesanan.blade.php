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
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ $title }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th class="text-center">ID Pesanan</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Rute</th>
                                <th class="text-center">Waktu</th>
                                <th class="text-center">Mobil</th>
                                <th class="text-center">Supir</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Tiket</th>
                                <th class="text-center">Aksi</th>
                                <th class="text-center">Perubahan</th>
                                <th class="text-center">Status Ubah Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $psn)
                                <tr>
                                    @foreach ($psn->keberangkatan as $item)
                                        <td class="text-center text-black ">
                                            <p class="font-weight-bold text-uppercase">
                                                PSN/{{ $item->id }}/{{ $item->asals->name }}/{{ $item->tujuans->name }}/{{ $psn->id }}
                                            </p>
                                        </td>

                                        <td class="text-center text-black">{{ $item->tanggal }}</td>
                                        <td class="text-center text-black">{{ $item->asals->name }} -
                                            {{ $item->tujuans->name }}</td>
                                        <td class="text-center text-black">{{ $item->pukul }}</td>
                                        <td class="text-center text-black">{{ $item->mobils->nama }}</td>
                                        <td class="text-center text-black">{{ $item->supirs->name }}</td>
                                    @endforeach

                                    <td class="text-center text-black">Rp. {{ number_format($psn->biaya, 0, ',', '.') }}
                                    </td>

                                    {{-- TODO : Revisi pembatalan --}}
                                    @php
                                        $diff = \Carbon\Carbon::parse($item->tanggal)->diffInDays(
                                            \Carbon\Carbon::now(),
                                        );
                                    @endphp

                                    @if ($psn->cancled != null)
                                        <td class="text-center text-black">
                                            <p class="badge badge-danger">Pesanan Telah dibatalkan</p>
                                        </td>
                                        <td class="text-center text-black">
                                            <button class="btn btn-danger" disabled>Batal</button>
                                        </td>
                                    @else
                                        <td class="text-center text-black"> <a href="{{ route('viewPDF', $psn->id) }}"
                                                class="badge badge-info">Cetak</a>
                                        </td>

                                        @foreach ($psn->keberangkatan as $item)
                                            @if ($item->tanggal <= date('Y-m-d') || $diff <= 1)
                                                <td class="text-center text-black">
                                                    <button class="btn btn-danger" disabled>Batal</button>
                                                </td>
                                            @else
                                                <td class="text-center text-black">
                                                    <a href="{{ route('cancleForm', $psn->id) }}"
                                                        class="btn btn-danger">Batal</a>
                                                </td>
                                            @endif
                                        @endforeach
                                    @endif

                                    <td class="text-center text-black">
                                        @if ($psn->update_tanggal == null)
                                            <a href="{{ route('ubahTanggal', $psn->id) }}" class="btn btn-warning"><i
                                                    class="fas fa-calendar-alt"></i></a>
                                            <a href="{{ route('detailPesanan', $psn->id) }}" class="btn btn-info">
                                                <i class="fas fa-chair"></i>
                                            </a>
                                        @else
                                            {{ $psn->update_tanggal }}
                                        @endif
                                    </td>
                                    <td class="text-center text-black">
                                        @if ($psn->update_tanggal == null)
                                            Belum Ada Pengajuan
                                        @elseif($psn->update_tanggal != null && $psn->is_update_tanggal == null)
                                            <div class="badge badge-warning">Menunggu Konfirmasi</div>
                                        @elseif($psn->is_update_tanggal == 'Konfirmasi')
                                            <div class="badge badge-success">Telah Dikonfirmasi</div>
                                        @elseif($psn->is_update_tanggal == 'Tidak Disetujui')
                                            <div class="badge badge-danger">Tidak Disetujui</div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span class="text-danger">* <i>Pesanan Tidak Bisa Dibatalkan Sehari Sebelum Keberangkatan</i></span>
                    {{ $pesanan->links() }}
                </div>


            </div>
        </div>
    </div>
@endsection
