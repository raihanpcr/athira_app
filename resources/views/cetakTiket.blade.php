@extends('layouts.main')

@section('container')
    <div class="card">
        <div class="card-header">
            Halaman Dashboard
        </div>
        <div class="card-body">
            <h5 class="card-title">Jadwal Keberangkatan</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Tujuan</th>
                        <th>Keterangan</th>
                        <th>Cetak</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2017-01-09</td>
                        <td>Zaky</td>
                        <td>Padang</td>
                        <td><span class="badge badge-pill badge-success">Lunas</span></td>
                        <td><a href="#" class="badge badge-info">Cetak</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2017-01-09</td>
                        <td>Fulan</td>
                        <td>Rohul</td>
                        <td><span class="badge badge-pill badge-danger">Belum Lunas</span></td>
                        <td><a href="#" class="badge badge-info">Cetak</a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>2017-01-09</td>
                        <td>Fulan</td>
                        <td>Rohul</td>
                        <td><span class="badge badge-pill badge-success">Lunas</span></td>
                        <td><a href="#" class="badge badge-info">Cetak</a></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>2017-01-09</td>
                        <td>Fulan</td>
                        <td>Rohul</td>
                        <td><span class="badge badge-pill badge-danger">Belum Lunas</span></td>
                        <td><a href="#" class="badge badge-info">Cetak</a></td>

                    </tr>
                    <tr>
                        <td>5</td>
                        <td>2017-01-09</td>
                        <td>Fulan</td>
                        <td>Rohul</td>
                        <td><span class="badge badge-pill badge-success">Lunas</span></td>
                        <td><a href="#" class="badge badge-info">Cetak</a></td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
@endsection
