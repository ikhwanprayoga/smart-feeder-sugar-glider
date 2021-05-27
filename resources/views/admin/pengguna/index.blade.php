@extends('layouts.app')

@push('title', 'Pengguna')

@push('css')

@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Pengguna </h4>
                        <button class="btn btn-warning pull-right btn-sm" data-toggle="modal"
                            data-target="#modalTambah"><i class="material-icons">add_business</i>&nbsp; Tambah
                            Pengguna</button>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-primary">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>
                                        <button type="button" rel="tooltip" title="Edit" onclick="editData(this)"
                                            data-id="{{ $data->id }}" data-name="{{ $data->name }}" data-email="{{ $data->email }}"
                                            class="btn btn-success btn-link btn-sm"><i
                                                class="material-icons">edit</i></button>
                                        <button type="button" rel="tooltip" title="Hapus" onclick="hapusData(this)"
                                            data-id="{{ $data->id }}" data-name="{{ $data->name }}"
                                            class="btn btn-danger btn-link btn-sm"><i
                                                class="material-icons">delete</i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.pengguna.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="bmd-label-floating">Nama Pengguna</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label class="bmd-label-floating">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label class="bmd-label-floating">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-edit">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="bmd-label-floating">Nama Pengguna</label>
                        <input type="text" class="form-control" id="name-edit" name="name">
                    </div>
                    <div class="form-group">
                        <label class="bmd-label-floating">Email</label>
                        <input type="email" class="form-control" id="email-edit" name="email">
                    </div>
                    <div class="form-group">
                        <label class="bmd-label-floating">Password</label>
                        <input type="password" class="form-control" name="password">
                        <small>Kosongkan password jika tidak ingin mengubah password</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-hapus">
                @csrf
                <div class="modal-body">
                    <label class="bmd-label-floating">Nama Pengguna</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="name-hapus" name="name" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    const url = '{{ url("admin/pengguna") }}'

    function editData(e) {
        const id = $(e).data("id")
        const name = $(e).data("name")
        const email = $(e).data("email")

        $('#modalEdit').modal('show')
        $('#name-edit').val(name)
        $('#email-edit').val(email)

        const urlEdit = url + '/' + id

        $("#form-edit").attr('action', urlEdit);
    }

    function hapusData(e) {
        const id = $(e).data("id")
        const name = $(e).data("name")

        $('#modalHapus').modal('show')
        $('#name-hapus').val(name)

        const urlHapus = url + '/destroy/' + id

        $("#form-hapus").attr('action', urlHapus);
    }

</script>
@endpush
