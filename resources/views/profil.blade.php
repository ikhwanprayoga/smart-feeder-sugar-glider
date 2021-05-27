@extends('layouts.app')

@push('title', 'Profil')

@push('css')

@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Data Profil Pengguna </h4>
                    </div>
                    <form method="post" action="{{ route('profil.update') }}" class="form-horizontal">
                        @csrf
                        <div class="card-body table-responsive">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password" name="password" disabled>
                                        <small>Kosongkan password jika tidak ingin mengubah password</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                              <button type="button" class="btn btn-fill btn-rose" id="tombol-ubah">Ubah</button>
                              <button type="submit" class="btn btn-fill btn-rose" id="tombol-simpan" hidden>Simpan</button>
                            </div>
                        </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection

@push('js')
<script>
    const url = '{{ url("admin/pengguna") }}'

    $('#tombol-ubah').on('click', function (){
          $('#tombol-ubah').attr('hidden', true)
          $('#tombol-simpan').attr('hidden', false)

          $('#name').attr('disabled', false)
          $('#email').attr('disabled', false)
          $('#password').attr('disabled', false)
    })

</script>
@endpush
