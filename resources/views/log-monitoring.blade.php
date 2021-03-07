@extends('layouts.app')

@push('title', 'Log Monitoring')

@push('css')
    
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <label class="bmd-label-floating">Tanggal Mulai</label>
                <div class="form-group">
                <input type="date" class="form-control" id="filter_tanggal_mulai" name="filter_tanggal_mulai">
                </div>
            </div>
            <div class="col-md-4">
                <label class="bmd-label-floating">Tanggal Akhir</label>
                <div class="form-group">
                <input type="date" class="form-control" id="filter_tanggal_akhir" name="filter_tanggal_akhir">
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Data Log Monitoring</h4>
                {{-- <p class="card-category"> Here is a subtitle for this table</p> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table" id="table-data">
                    <thead class=" text-primary">
                        {{-- <th>No</th> --}}
                        <th>Waktu</th>
                        <th>Nama Alat</th>
                        <th>Makanan</th>
                        <th>Air</th>
                        {{-- <th>Salary</th> --}}
                    </thead>
                </table>
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
    var filter_tanggal_mulai = ''
    var filter_tanggal_akhir = ''
    
    var table = $('#table-data').DataTable({
        bLengthChange: false,
        processing: true,
        serverSide: true,
        searching: false,
        ajax: {
            url: '{{ route("log-monitoring.get-data") }}',
            data: function (d) {
                d.filter_tanggal_mulai = filter_tanggal_mulai
                d.filter_tanggal_akhir = filter_tanggal_akhir
            }
        },
        columns: [
            // { data: 'rownum', name: 'rownum' },
            { data: 'waktu', name: 'waktu', },
            { data: 'nama_alat', name: 'nama_alat', },
            { data: 'makanan', name: 'makanan', },
            { data: 'air', name: 'air', },
            // { data: 'aksi', name: 'aksi', },
        ]
    })

    $('#filter_tanggal_mulai').on('change', function (e) {
        filter_tanggal_mulai = $('input[name=filter_tanggal_mulai]').val()
        table.draw();
        e.preventDefault();
    });

    $('#filter_tanggal_akhir').on('change', function (e) {
        filter_tanggal_akhir = $('input[name=filter_tanggal_akhir]').val()
        table.draw();
        e.preventDefault();
    });
</script>
@endpush
