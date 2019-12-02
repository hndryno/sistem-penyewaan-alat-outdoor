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
					<h1>Pendaftaran</h1>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<!-- Start Sample Area -->
	<section class="sample-text-area">
		<div class="container">
			<h3 class="text-heading">Pendaftaran</h3>
			<p class="sample-text">
				Silahkan melakukan pendaftaran dengan memasukkan data diri dengan benar.
            </p>
                <form action="{{route('daftarBaru')}}" class="row contact_form" method="POST" id="contactForm">
                    @csrf
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('jenis_identitas') ? ' has-error' : '' }}">
                                <select class="form-control" name="jenis_identitas" >
                                    <option class="" value="">Jenis identitas</option>
                                    <option value="KTP">KTP</option>
                                    <option value="SIM">SIM</option>
                                    <option value="Kartu Mahasiswaw">Kartu Mahasiswa</option>
                                    <option value="Kartu Pelajar">Kartu Pelajar</option>  
                                </select>
                                @if($errors->has('jenis_identitas'))
                                    <span class="help-block pull-right">
                                        <p style="color: red">{{ $errors->first('jenis_identitas') }}</p>
                                    </span>
                                @endif
                            </div>
                            <br><br>
                            <div class="form-group  mb-3 {{ $errors->has('no_identitas') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" id="no_identitas" name="no_identitas" placeholder="Masukkan No. Identitas" >
                                @if ($errors->has('no_identitas'))
                                <span class="help-block pull-right">
                                    <p style="color: red">{{ $errors->first('no_identitas') }}</p>
                                </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Lengkap" >
                                @if ($errors->has('name'))
                                <span class="help-block pull-right">
                                    <p style="color: red">{{ $errors->first('name') }}</p>
                                </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('telepon') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukkan No. Telp" >
                                @if ($errors->has('telepon'))
                                <span class="help-block pull-right">
                                    <p style="color: red">{{ $errors->first('telepon') }}</p>
                                </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('alamat') ? ' has-error' : '' }}">
                                <textarea class="form-control" name="alamat" id="alamat" rows="1" placeholder="Masukkan Alamat" ></textarea>
                                @if ($errors->has('alamat'))
                                <span class="help-block pull-right">
                                    <p style="color: red">{{ $errors->first('alamat') }}</p>
                                </span>
                                @endif
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan E-mail" >
                                @if ($errors->has('email'))
                                <span class="help-block pull-right">
                                    <p style="color: red">{{ $errors->first('email') }}</p>
                                </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" class="form-control" id="name" name="password" placeholder="Masukkan Password" >
                                @if ($errors->has('password'))
                                <span class="help-block pull-right">
                                    <p style="color: red">{{ $errors->first('password') }}</p>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="password" id="password-confirm" class="form-control" placeholder="Konfirmasi password" name="password_confirmation"  autocomplete="new-password"/>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block pull-right">
                                    <p style="color: red">{{ $errors->first('password') }}</p>
                                </span>
                            @endif
                        </div>
                            
                    <div class="row">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" value="submit" class="primary-btn">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>



@endsection

@push('js')

@endpush
