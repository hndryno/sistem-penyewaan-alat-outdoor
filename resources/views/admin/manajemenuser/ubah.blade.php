@extends('layouts.backend.master')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Ubah Data User </h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <form class="forms-sample" action="{{route('manajemenuser.update',$user->id)}}" method="POST" id="ubah-form-{{$user->id}}">
            @csrf
            {{method_field('PUT')}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                        <label class="col-sm-3 col-form-label">E-mail</label>
                            <div class="col-sm-9 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" readonly/>
                                @if ($errors->has('email'))
                                    <span class="help-block pull-right">
                                        <p style="color: red">{{ $errors->first('email') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="name" value="{{$user->name}}" readonly/>
                                @if ($errors->has('name'))
                                    <span class="help-block pull-right">
                                        <p style="color: red">{{ $errors->first('name') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9 {{ $errors->has('alamat') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="alamat" value="{{$user->alamat}}" readonly/>
                                @if ($errors->has('email'))
                                    <span class="help-block pull-right">
                                        <p style="color: red">{{ $errors->first('email') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" placeholder="Masukkan password" autocomplete="new-password"/>
                                @if ($errors->has('password'))
                                    <span class="help-block pull-right">
                                        <p style="color: red">{{ $errors->first('password') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-sm-3 col-form-label" id="password-confirm">Konfirmasi Password</label>
                            <div class="col-sm-9">
                                <input type="password" id="password-confirm" class="form-control" placeholder="Konfirmasi password" name="password_confirmation" required autocomplete="new-password"/>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-sm btn-outline-danger btn-icon-text" onclick="ubahPassword({{$user->id}})">Ubah Password</button>
                <a href="{{route('manajemenuser.index')}}" class="btn btn-sm btn-light">Batal</a>
            </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

<!-- sweet alert -->
<script type="text/javascript">
    function ubahPassword(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                cancelButton: 'btn btn-danger',
                confirmButton: 'btn btn-success'
            },
            buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
            title: 'Apakah anda yakin?',
            text: "Mengubah data ini berarti mengubah akses masuk!",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('ubah-form-'+id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Dibatalkan',
                'Data anda batal dihapuskan',
                'error'
                )
            }
        })
    }
</script>
<!-- akhir sweet alert -->
