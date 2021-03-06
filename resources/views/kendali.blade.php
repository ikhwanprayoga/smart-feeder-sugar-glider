@extends('layouts.app')

@push('title', 'Kendali')

@push('css')
    
@endpush

@section('content')
<div class="content">
      <div class="container-fluid">
            <div class="row">
                  <div class="col-md-12">
                        <div class="card">
                          <div class="card-header card-header-primary">
                            <h4 class="card-title">Kendali </h4>
                            <button class="btn btn-warning pull-right btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="material-icons">add_business</i>&nbsp; Tambah Alat</button>
                          </div>
                          <div class="card-body table-responsive">
                            <table class="table table-hover">
                              <thead class="text-primary">
                                <th>No</th>
                                <th>Alat</th>
                                <th>Aksi</th>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>Kode_1</td>
                                  <td>
                                    <a href={{url('alat')}}><button type="button" rel="tooltip" title="Detail" class="btn btn-info btn-link btn-sm"><i class="material-icons">remove_red_eye</i></button></a>
                                    <button type="button" rel="tooltip" title="Edit" class="btn btn-success btn-link btn-sm"><i class="material-icons">edit</i></button>
                                    <button type="button" rel="tooltip" title="Hapus" class="btn btn-danger btn-link btn-sm"><i class="material-icons">delete</i></button>
                                  </td>
                                </tr>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Alat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label class="bmd-label-floating">Nama Alat</label>
            <div class="form-group">
            <input type="text" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary">Tambah</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('js')
    
@endpush