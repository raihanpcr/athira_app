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
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Rute</th>
                                <th class="text-center">Waktu</th>
                                <th class="text-center">Mobil</th>
                                <th class="text-center">Pemesan</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Tiket</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $psn)
                                <tr>
                                    @foreach ($psn->keberangkatan as $item)
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
                                            <form action="{{ route('konfirmasiPembayaran', $psn->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-info">Konfirmasi Pembayaran</button>
                                            </form>
                                        </td>
                                    @endif
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
