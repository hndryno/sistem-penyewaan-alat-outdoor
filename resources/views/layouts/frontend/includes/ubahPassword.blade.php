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
                <h3 class="float-left">Ubah Password</h3>
                <br><br>
                <p style="color:red;">
                    Email yang sudah didaftarkan tidak dapat diubah.
                </p>
            <form action="{{route('updatePassword',$user->id)}}" method="POST">
                @csrf
                {{method_field('PUT')}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" value="{{$user->email}}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" value="{{$user->name}}" class="form-control" disabled>
                </div>

                <div class="form-group mt-1 {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">password Baru</label>
                    <input type="text" id="password" name="password" class="form-control" autocomplete="new-password">
                    @if ($errors->has('password'))
                        <span class="help-block pull-right">
                            <p style="color: red">{{ $errors->first('password') }}</p>
                        </span>
                    @endif
                </div>
                <div class="form-group mt-1">
                    <label for="password-confirm">Konfirmasi Password</label>
                    <input id="password-confirm" type="text" name="password_confirmation" required autocomplete="new-password" class="form-control">
                </div>
                <br>
                <div class="form-group float-right">
                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                </div>
            </form>
		</div>
    </section>
@endsection

@push('js')

@endpush

