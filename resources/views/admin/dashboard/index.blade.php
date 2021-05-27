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
                <h3 class="card-title" id="sisa-air">0<small>Cm</small></h3>
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
                <h3 class="card-title" id="sisa-makanan">0 <small>Cm</small></h3>
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
      $('#sisa-makanan').html(data.makanan+'<small> Cm</small>')
      $('#sisa-air').html(data.air+'<small> Cm</small>')
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