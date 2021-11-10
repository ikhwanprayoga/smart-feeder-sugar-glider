@extends('layouts.app')

@push('title', 'Dashboard')

@push('css')
@endpush

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <form action="">
          <div class="form-group">
            <label for="pilih-alat">Pilih alat yang dipantau</label>
            <select class="form-control selectpicker" data-style="btn btn-link" id="pilih-alat">
              @foreach ($alats as $key => $alat)
              <option value="{{ $alat->id }}" {{ $key == 0 ? 'selected' : '' }}>{{ $alat->nama }}</option>
              @endforeach
            </select>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">water</i>
            </div>
            <p class="card-category">Sisa Air</p>
            <h3 class="card-title" id="sisa-air">0<small>%</small></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">water</i>
              <a href="javascript:;">Sisa air pada penampungan</a>
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
            <h3 class="card-title" id="sisa-makanan">0 <small>%</small></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">food_bank</i> Sisa makanan pada penampungan
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
            <h3 class="card-title" id="count-down">00:00</h3>
          </div>
          <div class="card-footer">
            <div class="stats" id="waktu-makan-berikutnya">
              <i class="material-icons">alarm_on</i> Waktu Makan Berikutnya 00:00 WIB
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
            <p class="card-category">Waktu pembelian makanan masing-masing alat</p>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-hover">
              <thead class="text-primary">
                <th>No</th>
                <th>Alat</th>
                <th>Waktu</th>
                <th>Status</th>
              </thead>
              <tbody>
                @foreach ($jadwals as $jadwal)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $jadwal->alat->nama }}</td>
                  <td>{{ $jadwal->waktu }}</td>
                  <td>{{ cek_status_pengolahan_pakan($jadwal->id) }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">5 Data Terakhir</h4>
            <p class="card-category">5 data terakhir hasil pemantauan</p>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-hover">
              <thead class="text-primary">
                <th>No</th>
                <th>Alat</th>
                <th>Waktu</th>
                <th>Makanan</th>
                <th>Air</th>
              </thead>
              <tbody>
                @foreach ($logMonitorings as $logMonitoring)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $logMonitoring->alat->nama }}</td>
                  <td>{{ date('d-m-Y H:i', strtotime($logMonitoring->created_at)) }}</td>
                  <td>{{ $logMonitoring->makanan }} %</td>
                  <td>{{ $logMonitoring->air }} %</td>
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
@endsection

@push('js')
<script>
  var id = 0
  var urlMonitoring = '{{ url("api/get-data-monitoring") }}'
  var urlDataCountDown = '{{ url("api/get-last-time") }}'
  var secondLast = 0;

  $('#pilih-alat').on('change', function (e) {
      id = $('#pilih-alat').val()
      getDataCountDown()
      getDataMonitoring()
  });

  function getDataMonitoring() {
    console.log('id alat', id)
    $.get(urlMonitoring+'/'+id, function (data) {
      console.log('data', data)
      $('#sisa-makanan').html(data.makanan+'<small> %</small>')
      $('#sisa-air').html(data.air+'<small> %</small>')
    })
  }

  function getDataCountDown() {
    $.get(urlDataCountDown+'/'+id, function (data) {
      console.log('data last', data)
      secondLast = data.diff
    })
  }

  setInterval(() => {
    getDataMonitoring()
  }, 2000);

  window.onload = function () {
    id = $('#pilih-alat').val()
    $.get(urlDataCountDown+'/'+id, function (data) {
      console.log('data last', data)
      var second = data.diff,
      display = document.querySelector('#count-down');
      startTimer(second, display);
      $('#waktu-makan-berikutnya').html('<i class="material-icons">alarm_on</i> Waktu Makan Berikutnya '+data.waktu)
    })
  };

  function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
  }
</script>
@endpush