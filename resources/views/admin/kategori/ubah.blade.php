@extends('layouts.backend.master')

@section('content')
<div class="content-wrapper">
<div class="page-header">
    <h3 class="page-title"> Ubah Data Kategori </h3>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <form class="forms-sample" action="{{route('kategori.update', $kategori->id)}}" method="POST">
            @csrf
            {{method_field('PUT')}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kategori</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kategori" value="{{$kategori->kategori}}" />
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-sm btn-primary mr-2">Simpan</button>
            <a href="{{route('kategori.index')}}" class="btn btn-sm btn-light">Batal</a>
        </form>
        </div>
    </div>
    </div>
</div>
</div>
@endsection
