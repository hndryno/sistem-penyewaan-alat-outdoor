@extends('layouts.backend.master')

@section('content')
<div class="content-wrapper">
<div class="page-header">
    <h3 class="page-title"> Syarat & Ketentuan </h3>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th>Teks</th>
                <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td>
                    <a href="{{route('syarat.create')}}"class="btn btn-sm btn-outline-info btn-icon-text">
                    <i class="icon-pencil btn-icon-prepend"></i> Ubah </a>
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
