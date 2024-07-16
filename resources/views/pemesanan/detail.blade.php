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
                <h3 class="text-dark text-center">Tiket Keberangkatan</h3>
                <div class="row">
                    <div class="col">
                        @foreach ($pesanan->keberangkatan as $keberangkatan)
                            <table>
                                <tr>
                                    <td class="font-weight-bold">Tanggal</td>
                                    <td> : {{ $keberangkatan->tanggal }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Waktu</td>
                                    <td> : {{ $keberangkatan->pukul }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Rute Perjalanan</td>
                                    <td> : {{ $keberangkatan->asals->name }} - {{ $keberangkatan->tujuans->name }}</td>

                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Mobil </td>
                                    <td> : {{ $keberangkatan->mobils->nama }} - {{ $keberangkatan->mobils->plat }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Supir</td>
                                    <td> : {{ $keberangkatan->supirs->name }}</td>
                                </tr>
                            </table>
                            <br>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <thead>
                                <th>Rute Perjalanan</th>
                                <th>Pemesan</th>
                                <th>Jumlah Pesanan</th>
                                <th>Biaya</th>
                            </thead>
                            <tbody>
                                @foreach ($pesanan->keberangkatan as $keberangkatan)
                                    <td>{{ $keberangkatan->asals->name }} - {{ $keberangkatan->tujuans->name }}</td>
                                @endforeach
                                @foreach ($pesanan->pemesan as $pemesan)
                                    <td>{{ $pemesan->name }}</td>
                                @endforeach
                                <td>{{ $pesanan->jml_bangku }}</td>
                                <td>Rp. {{ number_format($pesanan->biaya, 0, ',', '.') }}</td>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-right mr-3">
                    <p class="">PT Athira Travel</p> <br><br><br><br><br>
                    ..................................
                </div>


            </div>
        </div>
    </div>
@endsection
