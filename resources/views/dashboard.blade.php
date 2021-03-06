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
                  <i class="material-icons">water</i>
                </div>
                <p class="card-category">Sisa Air</p>
                <h3 class="card-title">9
                  <small>Cm</small>
                </h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons text-danger">warning</i>
                  <a href="javascript:;">Sisa Air...</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">food_bank</i>
                </div>
                <p class="card-category">Sisa Pakan</p>
                <h3 class="card-title">9 Cm</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">food_bank</i> Last 24 Hours
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">alarm</i>
                </div>
                <p class="card-category">Count Down</p>
                <h3 class="card-title">15:31</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons">alarm_on</i> Waktu Makan 02:30 WIB
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">List Waktu Makan</h4>
                <p class="card-category">New employees on 15th September, 2016</p>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-hover">
                  <thead class="text-primary">
                    <th>No</th>
                    <th>Waktu</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Dakota Rice</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">5 Data Terakhir</h4>
                <p class="card-category">New employees on 15th September, 2016</p>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-hover">
                  <thead class="text-primary">
                    <th>No</th>
                    <th>Waktu</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Dakota Rice</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('js')
    
@endpush