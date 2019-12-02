@extends('layouts.backend.master')

@section('content')
<div class="content-wrapper">
<div class="page-header">
    <h3 class="page-title"> Tambah Data User </h3>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <form class="forms-sample">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="exampleTextarea1">Alamat</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="exampleTextarea1" placeholder="Masukkan alamat..." rows="4"></textarea>
                    </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="exampleTextarea1">Maps</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="exampleTextarea1" placeholder="Masukkan maps..." rows="4"></textarea>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label">No. Telp</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="telp" placeholder="Masukkan no. telp..." />
                    </div>
                    </div>
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label">E-mail</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" placeholder="Masukkan email" />
                    </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-sm btn-primary mr-2">Simpan</button>
            <a href="{{route('profile.index')}}" class="btn btn-sm btn-light">Batal</a>
        </form>
        </div>
    </div>
    </div>
</div>
</div>
@endsection
