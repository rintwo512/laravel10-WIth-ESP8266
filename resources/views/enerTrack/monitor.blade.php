@extends('layout.main')



@section('content')





{{-- WIDGET GAUGE --}}
<h6 class="mb-0 text-uppercase">Temprature & Humidity Monitor</h6>
<hr>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xxl-4" id="dataContainer">
    <div class="col">
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="">
              <h4 class="mb-0 text-secondary">Temprature</h4>
            </div>
            <div class="ms-auto">
                @foreach ($data as $suhu)

                <div class="w_chart" id="chart17" data-value="{{ $suhu->suhu }}">
                    <span class="w_percent temp">0</span>
                    <canvas height="110" width="110"></canvas>
                </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="">
              <h4 class="mb-0 text-secondary">Humidity</h4>
            </div>
            <div class="ms-auto">
                <div class="w_chart" id="chart18">
                    <span class="w_percent humdy">0</span>
                    <canvas height="110" width="110"></canvas>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
{{-- END WIDGET GAUGE --}}



<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
<script>
    $(document).ready(function() {
  function longPolling() {
    $.ajax({
      url: "{{ url('/enertrack/test') }}", // Ganti dengan URL endpoint server Anda
      type: 'GET',
      dataType: 'json',
      success: function(response) {

        $("#chart17").data('easyPieChart').update(response.data.suhu);
        $(".temp").text(response.data.suhu);

        $("#chart18").data('easyPieChart').update(response.data.kelembapan);
        $(".humdy").text(response.data.kelembapan);





        longPolling();
      },
      error: function(xhr, status, error) {
        // Tangani kesalahan yang terjadi
        console.log('Error:', error);

        // Melakukan long polling kembali setelah terjadi kesalahan
        longPolling();
      }
    });
  }

  // Memulai long polling
  longPolling();
});
</script>

<script>
  $(document).ready(function() {
    var chartElement = $('#chart17');
  var percentValue = chartElement.data('value');
  console.log(percentValue);
    if(percentValue >= 30){
        chartElement.easyPieChart({
            easing: 'easeOutBounce',
            barColor: '#f10303',
            lineWidth: 8,
            trackColor: 'rgb(231 46 122 / 15%)',
            scaleColor: false,
            onStep: function(from, to, percent) {
                $(this.el).find('.w_percent').text(Math.round(percent));
            }
        });
    }else{

        chartElement.easyPieChart({
            easing: 'easeOutBounce',
            barColor: '#126af6',
            lineWidth: 8,
            trackColor: 'rgb(231 46 122 / 15%)',
            scaleColor: false,
            onStep: function(from, to, percent) {
                $(this.el).find('.w_percent').text(Math.round(percent));
            }
        });

    }
  });
</script>



@endsection
