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
                <input type="date" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <label class="bmd-label-floating">Tanggal Akhir</label>
                <div class="form-group">
                <input type="date" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Simple Table</h4>
                <p class="card-category"> Here is a subtitle for this table</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                    <th>
                        No
                    </th>
                    <th>
                        Tanggal
                    </th>
                    <th>
                        Waktu
                    </th>
                    <th>
                        City
                    </th>
                    <th>
                        Salary
                    </th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                        1
                        </td>
                        <td>
                        Dakota Rice
                        </td>
                        <td>
                        Niger
                        </td>
                        <td>
                        Oud-Turnhout
                        </td>
                        <td class="text-primary">
                        $36,738
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
@endsection

@push('js')
    
@endpush
