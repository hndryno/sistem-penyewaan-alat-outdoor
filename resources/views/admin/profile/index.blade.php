@extends('layouts.backend.master')

@section('content')
<div class="content-wrapper">
<div class="page-header">
    <a href="{{route('profile.create')}}" type="button" class="btn btn-inverse-success btn-icon-text">
    <i class="icon-plus btn-icon-prepend"></i> Tambah Data </a>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Data Profile</h4>
        <table class="table">
            <thead>
            <tr>
                <th>No #</th>
                <th>Alamat</th>
                <th>Maps</th>
                <th>Email</th>
                <th>Telp</th>
                <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <button type="button" class="btn btn-sm btn-outline-info btn-icon-text">
                    <i class="icon-pencil btn-icon-prepend"></i> Ubah </button>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-icon-text">
                    <i class="icon-trash btn-icon-prepend"></i> Hapus </button>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>
</div>
@endsection
