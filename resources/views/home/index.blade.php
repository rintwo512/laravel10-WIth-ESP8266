@extends('layout.main')



@section('content')

<style>


* {
    -webkit-touch-callout: none; /* prevent callout to copy image, etc when tap to hold */
    -webkit-text-size-adjust: none; /* prevent webkit from resizing text to fit */
  /* make transparent link selection, adjust last value opacity 0 to 1.0 */
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    -webkit-user-select: none; /* prevent copy paste, to allow, change 'none' to 'text' */
   /* -webkit-tap-highlight-color: rgba(0,0,0,0); */
  }

    /* body {
      background: #fafafa;
      color: #000;
      margin: 5px;
      padding: 0px;
      margin-bottom: 45px;
      text-align: center;
      font-family: 'Roboto',Helvetica, Arial;
    } */

    /* a {
      color: #000;
    } */

    .box {
      display: inline-block;

      color: #FFF;
      background: #7B378E;
      padding: 10px;
      /* border-radius:10px; */
      cursor: pointer;
    }

    .box:hover {
      background: #444;
    }

    .big {
      font-size: 2em;
      display: inline-block;
      margin: 10px;
    }
    .containerD {
      position: relative;
      display: inline-block;

      width: 800px;
      height: 660px;
    }

    #robot {
      position: absolute;
      height:650px;
      /* width:100%; */
      top: 0px;
      left:50px;
      z-index: 1;
      -webkit-box-shadow: 0px 0px 20px 0px #707070;
      -moz-box-shadow: 0px 0px 20px 0px #707070;
      box-shadow: 0px 0px 20px 0px #707070;
    }

    #redux {
      position: absolute;
      height:650px;
      /* width:100%; */
      top: 0px;
      left: 50px;
      z-index: 2;
    }

    #progress {
      position: absolute;
      top: 4px;
      right: 4px;
      color: black;
      pointer-events: none;
      z-index: 3;
      text-shadow: 0px 0px 2px #FFFFFF;
    }
    small {
      font-size: 12px;
      color: #BBB;
      font-weight: normal;
    }

    .btnDraw{
      display:flex;
      justify-content:center;
      margin-left:-40px;
    }


</style>


<style>

 .lead { font-size: 1.5rem; font-weight: 300; }
 /* .containerS {  display:inline-block} */
 .btn {  }
 canvas {}
 </style>


@can('admin')
{{-- Chart --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="col-md-2 mb-3">
  <select class="form-select" name="tahun" id="tahun">
    <option value="">--Select--</option>
    @foreach ($list_tahun as $tahun)
        <option value="{{ $tahun->tahun }}">{{ $tahun->tahun }}</option>
    @endforeach
  </select>
</div>
<div class="card">
  <div class="card-body">
    <div class="chart-container1">
      <div id="chart66"></div>
    </div>
  </div>
</div>
{{-- End Chart --}}
@endcan



<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
  <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Data AC Tireg 7</p>
            <h6 class="mb-0">Total <i class="bi bi-arrow-right"></i> 200 Unit</h6>
          </div>
          <div class="ms-auto fs-2 text-primary">
            <i class="bi bi-table"></i>
          </div>
        </div>
        <div class="border-top my-2"></div>
        <a href="/ac" class="text-view"><small class="mb-0"><span class="text-primary"><i class="bi bi-eye"></i></span> View Data</small></a>
      </div>
    </div>
   </div>
   <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Data Trash AC</p>
            <h6 class="mb-0">3 unit</h6>
          </div>
          <div class="ms-auto fs-2 text-danger">
            <i class="bi bi-trash"></i>
          </div>
        </div>
        <div class="border-top my-2"></div>
        <a href="/ac/trash" class="text-danger"><small class="mb-0"><span class="text-danger"><i class="bi bi-trash"></i></span> Delete Trash</small></a>
      </div>
    </div>
   </div>
   <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Total Maintenance</p>
            <h6 class="mb-0">4 unit total AC yang di maintenance dalam 2023 tahun.</h6>
          </div>
          <div class="ms-auto fs-2 text-primary">
            <i class="bi bi-hammer"></i>
          </div>
        </div>
        <div class="border-top my-2"></div>
        <small class="mb-0 text-primary"><span class="text-primary"><i class="bi bi-gear"></i></span> Data Maint AC</small>
      </div>
    </div>
   </div>
   <div class="col">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Semua perangkat AC Normal</p>
            <h6 class="mb-0">Awesome!</h6>
          </div>
          <div class="ms-auto fs-2 text-danger">
            <i class="bi bi-gear"></i>
          </div>
        </div>
        <div class="border-top my-2"></div>
        <small class="mb-0 text-danger"><span class="text-danger"><i class="bi bi-gear"></i></span> Data AC tidak aktif</small>
      </div>
    </div>
   </div>

   {{-- CCTV --}}
   <div class="col-md-4">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Data CCTV Tireg 7</p>
            <h6 class="mb-0">Total CCTV <i class="bi bi-arrow-right"></i>66 Unit</h6>
          </div>
          <div class="ms-auto fs-2 text-info">
            <i class="bi bi-camera-video"></i>
          </div>
        </div>
        <div class="border-top my-2"></div>
        <a href="/dashboard/cctv"><small class="mb-0 text-info"><span class="text-info"><i class="bi bi-camera-video"></i></span> View Data</small></a>
      </div>
    </div>
   </div>
   <div class="col-md-4">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Data Trash CCTV</p>
            <h6 class="mb-0">22 Unit</h6>
          </div>
          <div class="ms-auto fs-2 text-info">
            <i class="bi bi-trash"></i>
          </div>
        </div>
        <div class="border-top my-2"></div>
        <small class="mb-0 text-info"><span class="text-info"><i class="bi bi-trash"></i></span> Delete Trash</small>
      </div>
    </div>
   </div>
   <div class="col-md-4">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Semua perangkat CCTV Normal</p>
            <h6 class="mb-0">Awesome!</h6>
          </div>
          <div class="ms-auto fs-2 text-info">
            <i class="bi bi-gear"></i>
          </div>
        </div>
        <div class="border-top my-2"></div>
        <small class="mb-0 text-info"><span class="text-info"><i class="bi bi-gear"></i></span> Data CCTV tidak aktif</small>
      </div>
    </div>
   </div>
   {{-- END CCTV --}}
   <div class="col-12">
    <div class="card radius-10">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Users Registration</p>
            <h4 class="mb-0">3</h4>
          </div>
          <div class="ms-auto fs-2 text-info">
            <i class="bi bi-people"></i>
          </div>
        </div>
        <div class="border-top my-2"></div>
        <small class="mb-0 text-success"><span class="text-success"> <i class="bi bi-eye"></i></span> List Users Registration</small>
      </div>
    </div>
   </div>
</div>

<div class="row">
<div class="col">
    <div class="card mt-3">
      <div class="card-body">
        <p data-period="1000"><span class="title_run" data-period="3000"
          data-type='["Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus asperiores vel est facere hic laboriosam possimus sint earum neque nostrum? Dolorum nam a consequatur illum quidem magnam eum ipsam asperiores. Saepe libero adipisci nihil laborum, pariatur repellat error omnis autem obcaecati illo suscipit corrupti atque recusandae iste, accusantium rerum corporis."]'></span></p>
      </div>
  </div>
</div>
<div class="col">
  {{-- <div class="containerS">
    <canvas id="sketchpad" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;  width: 500px; height: 300px;"></canvas>
    <p><button onclick="sketchpad.undo();" class="btn" style="padding: 1.25rem; border: 0; border-radius: 3px; background-color: #4F46E5; color: #fff; cursor: pointer;">Undo</button>
    <button onclick="sketchpad.redo();" class="btn" style="padding: 1.25rem; border: 0; border-radius: 3px; background-color: #4F46E5; color: #fff; cursor: pointer;">Redo</button>
    <button onclick="sketchpad.animate(10);" class="btn" style="padding: 1.25rem; border: 0; border-radius: 3px; background-color: #4F46E5; color: #fff; cursor: pointer;">Animate</button></p>

    <canvas id="sketchpad2" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;  width: 500px; height: 300px;"></canvas>
    <p><button onclick="recover();" class="btn" id="recover-button" style="padding: 1.25rem; border: 0; border-radius: 3px; background-color: #4F46E5; color: #fff; cursor: pointer;">Recover</button>
  </div> --}}
<!-- <div class="ratio ratio-16x9 mb-4">
  <iframe src="https://www.youtube.com/embed/r28RWd9lXbw" title="YouTube video" allowfullscreen></iframe>
</div> -->
</div>


<!-- <div class="card">
    <div class="card-body"> -->
  {{-- <div class="col">
    <span class="containerD">
      <img id="robot" src="{{ asset('assets/images/robot.jpg') }}" />
      <img id="redux" src="{{ asset('assets/images/robot_redux.png') }}" />
      <div id="progress">0%</div>
    </span>
    <div class="btnDraw">
    <div id="resetBtn" class="box"> RESET </div>
    <div id="clearBtn" class="box"> CLEAR </div>
    <div id="toggleBtn" class="box"> DISABLE </div>
  </div> --}}


</div>



</div>



<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>




<script>
    let chart = null;

    function chartAc(year, title) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        method: "POST",
        url: "{{ url('/chart') }}",
        data: {
          tahun: year
        },
        dataType: "JSON",
        success: result => {
          drawChart(result, title, year);
        }
      });
    }

    function drawChart(result, title, year) {


    if (chart) {
        chart.destroy();
            document.querySelector("#chart66").innerHTML = ""; // Menghapus elemen HTML chart sebelumnya
        }

        var total = result.map(item => parseInt(item.total));
        var kalkulasi = total.reduce((acc, curr) => acc + curr);
        var bulan = result.map(item => item.bulan);

      var options = {
      series: [{
        name: 'Column',
        type: 'column',
        data: total
      }, {
        name: 'Line',
        type: 'line',
        data: total
      }],

      chart: {
        foreColor: '#9ba7b2',
        height: 350,
        type: 'line',
        zoom: {
          enabled: false
        },
        toolbar: {
          show: true
        },
      },
      stroke: {
        width: [0, 4]
      },
      plotOptions: {
        bar: {
          //horizontal: true,
          columnWidth: '35%',
          endingShape: 'rounded'
        }
      },
      colors: ["#0d6efd", "#212529"],
      title: {
        text: `${title} - Total = ${kalkulasi} Unit`
      },
      dataLabels: {
        enabled: true,
        enabledOnSeries: [1]
      },
      labels: bulan,
      xaxis: {
        type: 'dd/MM'
      },
      yaxis: [{
        title: {
          text: 'Rata-rata',
        },
      }, {
        opposite: true,
        title: {
          text: 'Rata-rata'
        }
      }]
    };

      chart = new ApexCharts(document.querySelector("#chart66"), options);
      chart.render();
    }

    $(document).ready(function() {
      $('#tahun').change(function() {
        var year = $(this).val();

        if (year != '') {
          chartAc(year, `Statistic Bulanan Maintenance AC : Tahun ${year}`);
        }
      });

      const d = new Date();
      let tahun = d.getFullYear();
      chartAc(tahun, `Statistic Bulanan Maintenance AC : Tahun ${tahun}`);
    });
    </script>




<script>
  var textType = function(el, runText, periode) {
      this.runText = runText;
      this.el = el;
      this.loopNum = 0;
      this.periode = parseInt(periode, 10) || 1000;
      this.txt = ' ';
      this.tick();
      this.isDeleting = false;
  };
  textType.prototype.tick = function() {
      var i = this.loopNum % this.runText.length;
      var fullText = this.runText[i];
      if (this.isDeleting) {
          this.txt = fullText.substring(0, this.txt.length - 1);
      } else {
          this.txt = fullText.substring(0, this.txt.length + 1);
      }

      this.el.innerHTML = '<span class="rtx">' + this.txt + '</span>';
      var that = this;
      var dell = 10 - Math.random() + 50;
      if (this.isDeleting) {
          dell /= 1;
      }
      if (!this.isDeleting && this.txt === fullText) {
          dell = this.periode;
          this.isDeleting = true;
      } else if (this.isDeleting && this.txt === '') {
          this.isDeleting = false;
          this.loopNum++;
          dell = 500;
      }
      setTimeout(function() {
          that.tick();
      }, dell);
  };
  window.onload = function() {
      var elements = document.getElementsByClassName('title_run');
      for (var i = 0; i < elements.length; i++) {
          var runText = elements[i].getAttribute('data-type');
          var periode = elements[i].getAttribute('data-period');
          if (runText) {
              new textType(elements[i], JSON.parse(runText), periode);
          }
      }

      var css = document.createElement('style');
      css.type = "text/css";
      css.innerHTML =
          ".title_run > .rtx {border-right: 0.05em solid #fff;}";
      document.body.appendChild(css);
  };
  </script>









@endsection

