@extends('layouts.frontend.master')

@section('name')

@push('css')

@endpush

@section('content')
    <!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Profile {{Auth::user()->name}}</h1>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<!-- Start Sample Area -->
	<section class="sample-text-area">
		<div class="container">
                <h3 class="float-left">Ubah data diri</h3>
                <a href="{{route('ubahPasswordUser',$user->id)}}" class="float-right btn btn-success">Ubah Password</a>
                <br><br>
                <p style="color:red;">
                    Email yang sudah didaftarkan tidak dapat diubah.
                </p>
            <form action="{{route('ubahProfile',$user->id)}}" class="inline-form" method="POST">
                @csrf
                {{method_field('PUT')}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" value="{{$user->email}}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" value="{{$user->name}}" class="form-control">
                </div>

                <label class="d-inline-block" for="jenis_identitas">Jenis Identitas</label>
                <div class="form-group">
                    <select class="form-control" id="jenis_identitas" name="jenis_identitas">
                        <option value="KTP" {{($user->jenis_identitas ==='KTP') ? 'selected' : ''}}>KTP</option>
                        <option value="Kartu Mahasiswa" {{($user->jenis_identitas ==='Kartu Mahasiswa') ? 'selected' : ''}}>Kartu Mahasiswa</option>
                        <option value="Kartu Pelajar" {{($user->jenis_identitas ==='Kartu Pelajar') ? 'selected' : ''}}>Kartu Pelajar</option>
                    </select>
                </div>
                <br><br>
                <div class="form-group mt-1">
                    <label for="no_identitas">Nomor identitas</label>
                    <input type="text" id="no_identitas" name="no_identitas" value="{{$user->no_identitas}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea type="text" id="alamat" name="alamat" class="form-control">{{$user->alamat}}</textarea>
                </div>
                <div class="form-group float-right">
                    <button type="submit" class="btn btn-primary">Ubah data</button>
                </div>
            </form>
		</div>
    </section>
@endsection

@push('js')

@endpush

