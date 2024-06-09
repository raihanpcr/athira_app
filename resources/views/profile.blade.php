@extends('layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>Halaman Profile</h1>
        </div>
    </section>

    <div class="section-body">
        <div class="card col-6">
            <div class="card-header">
                <h5 class="card-title">Form Data Diri</h5>
            </div>
            <div class="card-body">
                <div class="col-10">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama lengkap</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                    value="option1">
                                <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                    value="option2">
                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Alamat</label>
                            <input type="text" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">No Telepon</label>
                            <input type="text" class="form-control" id="exampleInputPassword1">
                        </div>
                        <a href="#" class="btn btn-primary">Simpan</a>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
