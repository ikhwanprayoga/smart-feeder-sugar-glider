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
                            <h4 class="card-title">Jadwal Alat {{ $data->nama }}</h4>
                            <button class="btn btn-warning pull-right btn-sm" data-toggle="modal" data-target="#modalTambah"><i class="material-icons">alarm_add</i>&nbsp; Tambah Waktu</button>
                          </div>
                          <div class="card-body table-responsive">
                            <table class="table table-hover">
                              <thead class="text-primary">
                                <th>No</th>
                                <th>Waktu</th>
                                <th>Aksi</th>
                              </thead>
                              <tbody>
                                @foreach ($data->jadwal as $jadwal)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $jadwal->waktu }}</td>
                                  <td>
                                    <button type="button" rel="tooltip" title="Hapus" onclick="hapusData(this)" data-id="{{ $jadwal->id }}" data-waktu="{{ $jadwal->waktu }}" class="btn btn-danger btn-link btn-sm"><i class="material-icons">delete</i></button>
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
<!-- Modal -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Waktu Jadwal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('alat.jadwal.store', ['id'=>$data->id]) }}" method="post">
        @csrf
        <div class="modal-body">
          <label class="bmd-label-floating">Waktu Beri Pakan</label>
          <div class="form-group">
          <input type="time" class="form-control" name="waktu">
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
<!-- Modal Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Waktu Jadwal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="form-hapus">
        @csrf
        <div class="modal-body">
          <label class="bmd-label-floating">Waktu</label>
          <div class="form-group">
          <input type="text" class="form-control" id="waktu-hapus" name="waktu" disabled>
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
  const url = '{{ url("alat/jadwal") }}'

  function hapusData(e) {
    const id = $(e).data("id")
    const waktu = $(e).data("waktu")

    $('#modalHapus').modal('show')
    $('#waktu-hapus').val(waktu)
    
    const urlHapus = url + '/hapus/' + id

    $("#form-hapus").attr('action', urlHapus);
  }
</script>
@endpush