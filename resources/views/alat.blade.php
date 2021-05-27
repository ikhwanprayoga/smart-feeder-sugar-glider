@extends('layouts.app')

@push('title', 'Jadwal')

@push('css')
    
@endpush

@section('content')
<div class="content">
      <div class="container-fluid">
            <div class="row">
                  <div class="col-md-12">
                        <div class="card">
                          <div class="card-header card-header-primary">
                            <h4 class="card-title">Jadwal </h4>
                            <button class="btn btn-warning pull-right btn-sm" data-toggle="modal" data-target="#modalTambah"><i class="material-icons">add_business</i>&nbsp; Tambah Alat</button>
                          </div>
                          <div class="card-body table-responsive">
                            <table class="table table-hover">
                              <thead class="text-primary">
                                <th>No</th>
                                <th width="60%">Alat</th>
                                <th>Aksi</th>
                              </thead>
                              <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $data->nama }}</td>
                                  <td>
                                    <a href={{ route('alat.show', ['id' => $data->id]) }}>
                                      <button type="button" rel="tooltip" title="Detail" class="btn btn-info btn-link btn-sm"><i class="material-icons">remove_red_eye</i></button>
                                    </a>
                                    <button type="button" rel="tooltip" title="Edit" onclick="editData(this)" data-id="{{ $data->id }}" data-nama="{{ $data->nama }}" class="btn btn-success btn-link btn-sm"><i class="material-icons">edit</i></button>
                                    <button type="button" rel="tooltip" title="Hapus" onclick="hapusData(this)" data-id="{{ $data->id }}" data-nama="{{ $data->nama }}" class="btn btn-danger btn-link btn-sm"><i class="material-icons">delete</i></button>
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
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Alat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('alat.store') }}" method="post">
        @csrf
        <div class="modal-body">
          <label class="bmd-label-floating">Nama Alat</label>
          <div class="form-group">
          <input type="text" class="form-control" name="nama">
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
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Alat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="form-edit">
        @csrf
        <div class="modal-body">
          <label class="bmd-label-floating">Nama Alat</label>
          <div class="form-group">
          <input type="text" class="form-control" id="nama-edit" name="nama">
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
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Alat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="form-hapus">
        @csrf
        <div class="modal-body">
          <label class="bmd-label-floating">Nama Alat</label>
          <div class="form-group">
          <input type="text" class="form-control" id="nama-hapus" name="nama" disabled>
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
  const url = '{{ url("alat") }}'

  function editData(e) {
    const id = $(e).data("id")
    const nama = $(e).data("nama")

    $('#modalEdit').modal('show')
    $('#nama-edit').val(nama)
    
    const urlEdit = url + '/' + id

    $("#form-edit").attr('action', urlEdit);
  }

  function hapusData(e) {
    const id = $(e).data("id")
    const nama = $(e).data("nama")

    $('#modalHapus').modal('show')
    $('#nama-hapus').val(nama)
    
    const urlHapus = url + '/hapus/' + id

    $("#form-hapus").attr('action', urlHapus);
  }
</script>
@endpush