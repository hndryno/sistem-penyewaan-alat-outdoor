@extends('layouts.backend.master')

@push('css')

@endpush

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Syarat & Ketentuan </h3>
    </div>
    <div class="row grid-margin">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title"></h4>
            <textarea id='tinyMce'>
            </textarea>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.15/tinymce.min.js' referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: '#tinyMce'
    });
    </script>

@endpush
