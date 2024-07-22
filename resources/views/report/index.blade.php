@extends('layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Halaman {{ $title }}</h1>
        </div>
    </section>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ $title }}</h5>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <form class="form-inline" action="{{ route('laporan') }}" method="GET">

                            <div class="form-group">
                                <input id="first_name" type="month"
                                    class="form-control @error('bulan') is-invalid @enderror" name="bulan" autofocus
                                    value="{{ old('bulan') }}">
                            </div>

                            &nbsp;

                            <div class="form-group">
                                <select name="mobil" id="" class="form-control">
                                    @foreach ($mobil as $m)
                                        <option value="{{ $m->id }}">{{ $m->plat }} - {{ $m->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            &nbsp;&nbsp;&nbsp;
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Lihat</button>

                            </div>
                            &nbsp;&nbsp;&nbsp;
                            <div class="form-group">
                                <a href="/laporan" class="btn btn-danger">Reset Filter</a>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="form-group col-6">
                    <a href="{{ route('report.export', request(['bulan', 'mobil'])) }}" class="btn btn-primary">Export
                        to
                        Excel</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th class="text-center">ID Pesanan</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Rute</th>
                                <th class="text-center">Waktu</th>
                                <th class="text-center">Mobil</th>
                                <th class="text-center">Pemesan</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Tiket</th>
                                <th class="text-center">Perubahan Tanggal</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $psn)
                                <tr>
                                    @foreach ($psn->keberangkatan as $item)
                                        <td class="text-center text-black">
                                            <p class="font-italic text-uppercase">
                                                PSN/{{ $item->id }}/{{ $item->asals->name }}/{{ $item->tujuans->name }}/{{ $psn->id }}
                                            </p>
                                        </td>
                                        <td class="text-center text-black">{{ $item->tanggal }}</td>
                                        <td class="text-center text-black">{{ $item->asals->name }} -
                                            {{ $item->tujuans->name }}</td>
                                        <td class="text-center text-black">{{ $item->pukul }}</td>
                                        <td class="text-center text-black">{{ $item->mobils->nama }}</td>
                                    @endforeach

                                    @foreach ($psn->pemesan as $item)
                                        <td class="text-center text-black">{{ $item->name }}</td>
                                    @endforeach

                                    <td class="text-center text-black">Rp. {{ number_format($psn->biaya, 0, ',', '.') }}
                                    </td>

                                    @if ($psn->keterangan == 'Sudah Dibayar')
                                        <td class="text-center text-black">
                                            <p class="badge badge-success">{{ $psn->keterangan }}</p>
                                        </td>
                                    @elseif($psn->cancled != null)
                                        <td class="text-center text-black">
                                            <p class="badge badge-danger">{{ $psn->cancled }}</p>
                                        </td>
                                    @else
                                        <td class="text-center text-black">
                                            <p class="badge badge-warning">{{ $psn->keterangan }}</p>
                                            {{-- <form action="{{ route('konfirmasiPembayaran', $psn->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-info">Konfirmasi Pembayaran</button>
                                            </form> --}}
                                        </td>
                                    @endif
                                    <td class="text-center text-black">{{ $psn->update_tanggal }}</td>
                                    <td class="text-center text-black">{{ $psn->is_update_tanggal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pesanan->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
