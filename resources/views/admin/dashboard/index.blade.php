@extends('layouts.app')

@push('title', 'Dashboard')

@push('css')
@endpush

@section('content')
<div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">account_circle</i>
                </div>
                <p class="card-category">Pengguna</p>
                <h3 class="card-title" id="sisa-air">{{ $user }}</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">account_circle</i>Jumlah Pengguna Terdaftar
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">precision_manufacturing</i>
                </div>
                <p class="card-category">Alat</p>
                <h3 class="card-title" id="sisa-makanan">{{ $alat }}</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">precision_manufacturing</i> Jumlah Alat Terdaftar
                </div>
              </div>
            </div>
          </div>
          {{-- <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">alarm</i>
                </div>
                <p class="card-category">Count Down</p>
                <h3 class="card-title" id="count-down">00:00</h3>
              </div>
              <div class="card-footer">
                <div class="stats" id="waktu-makan-berikutnya">
                  <i class="material-icons">alarm_on</i> Waktu Makan Berikutnya 00:00 WIB
                </div>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
@endsection

@push('js')

@endpush