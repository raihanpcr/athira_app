@extends('layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Halaman Tambah Keberangkatan</h1>
        </div>
    </section>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Form Keberangkatan</h5>
            </div>
            <div class="card-body">

                <form action="/tambahKeberangkatan" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Keberangkatan</label>
                                <input type="date" class="form-control" name="tanggal" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Kuota Penumpang</label>
                                <input type="number" class="form-control" name="kuota" id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Pukul</label>
                                <input type="time" class="form-control" name="pukul" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col form-group">
                                    <label for="exampleInputPassword1">Asal</label>
                                    <input type="text" class="form-control" name="asal" id="exampleInputPassword1">
                                </div>
                                <div class="col form-group">
                                    <label for="exampleInputPassword1">Tujuan</label>
                                    <input type="text" class="form-control" name="tujuan" id="exampleInputPassword1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Tambah</button>

                </form>


            </div>
        </div>
    </div>
@endsection
