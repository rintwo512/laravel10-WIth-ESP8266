@extends('layout.main')



@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <style>
        * {
            -webkit-touch-callout: none;
            /* prevent callout to copy image, etc when tap to hold */
            -webkit-text-size-adjust: none;
            /* prevent webkit from resizing text to fit */
            /* make transparent link selection, adjust last value opacity 0 to 1.0 */
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-user-select: none;
            /* prevent copy paste, to allow, change 'none' to 'text' */
            /* -webkit-tap-highlight-color: rgba(0,0,0,0); */
        }
       
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
            height: 650px;
            /* width:100%; */
            top: 0px;
            left: 50px;
            z-index: 1;
            -webkit-box-shadow: 0px 0px 20px 0px #707070;
            -moz-box-shadow: 0px 0px 20px 0px #707070;
            box-shadow: 0px 0px 20px 0px #707070;
        }

        #redux {
            position: absolute;
            height: 650px;
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

        .btnDraw {
            display: flex;
            justify-content: center;
            margin-left: -40px;
        }





        .checkmark {
            position: absolute;
            top: 3;
            left: 2;
            width: 18px;
            /* ukuran checkbox */
            height: 18px;
            background-color: #ccc;
            /* warna latar belakang checkbox */
        }

        .input-group-text input[type="checkbox"] {
            opacity: 0;
            /* sembunyikan checkbox asli */
        }

        .input-group-text input[type="checkbox"]:checked~.checkmark {
            background-color: #0ae94d;
            /* warna latar belakang ketika checkbox dipilih */
            border-radius: 100%;
        }

        .apexcharts-menu-item.exportSVG, .apexcharts-menu-item.exportCSV, .apexcharts-text.apexcharts-yaxis-title-text {
            display: none;
        }
    </style>


    <style>
        .lead {
            font-size: 1.5rem;
            font-weight: 300;
        }

        /* .containerS {  display:inline-block} */
        .btn {}

        canvas {}
    </style>


    {{-- Chart --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @can('admin')
    <div class="col-md-2 mb-3">
        <select class="single-select" name="tahun" id="tahun">
            <option value="" disabled>--Select--</option>
            @foreach ($list_tahun as $tahun)
            <option value="{{ $tahun->tahun }}">{{ $tahun->tahun }}</option>
            @endforeach
        </select>
    </div>
    <div class="card">
        <div class="card-body">
                <button id="exportExcelBtn" class="btn btn-success mb-2"><i class="bi bi-download"></i> Export Excel</button>
                <div class="chart-container1">
                    <div id="chart66"></div>
                </div>
            </div>
        </div>
    @endcan
    {{-- End Chart --}}


    {{-- TODO LIST --}}

    <div class="card">
        <div class="card-body">
            <h4 class="mb-0">Todo List : <span id="typing-effect"></span></h4>
            <hr>
            <div class="form-row mt-3" id="todo-list">
                @foreach ($todos as $todo)
                    <div class="col-12  {{ $todo->completed ? 'completed' : '' }}" data-id="{{ $todo->id }}">
                        <div class="pb-3 todo-item">
                            <span id="dataTanggal"
                                data-tanggal="{{ Carbon::parse($todo->created_at)->diffForHumans() }}">{{ Carbon::parse($todo->created_at)->diffForHumans() }}</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input type="checkbox" class="toggle-completed" {{ $todo->completed ? 'checked' : '' }}
                                        disabled>
                                    <span class="checkmark"></span>
                                </div>
                                <input type="text" readonly="" class="form-control false"
                                    aria-label="Text input with checkbox" value="{{ $todo->title }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- END TODO LIST --}}

    {{-- AC --}}
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">Total AC Tireg 7</p>
                            <h6 class="mb-0">{{ $countData }} Unit</h6>
                        </div>
                        <div class="ms-auto fs-2 text-primary">
                            <i class="bi bi-table"></i>
                        </div>
                    </div>
                    <div class="border-top my-2"></div>
                    <a href="#" class="text-view"><small class="mb-0"><span class="text-primary"><i
                                    class="bi bi-eye"></i></span> Lihat</small></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">Data AC Yang Belum di Mainten</p>
                            <h6 class="mb-0">{{ $jadwalCuci }} Unit</h6>
                        </div>
                        <div class="ms-auto fs-2 text-danger">
                            <i class="bi bi-gear"></i>
                        </div>
                    </div>
                    <div class="border-top my-2"></div>
                    <a href="#" class="text-danger"><small class="mb-0"><span class="text-danger"><i
                                    class="bi bi-eye"></i></span> Lihat</small></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">Total Maintenance</p>
                            <h6 class="mb-0">{{ $kal }} unit total AC yang di maintenance dalam
                                {{ $kalTahun }} tahun.</h6>
                        </div>
                        <div class="ms-auto fs-2 text-primary">
                            <i class="bi bi-hammer"></i>
                        </div>
                    </div>
                    <div class="border-top my-2"></div>
                    <small class="mb-0 text-primary"><span class="text-primary"><i class="bi bi-eye"></i></span>
                        Lihat</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">{{ $countAcRusak == 0 ? 'Semua perangkat AC Normal' : 'Perlu diperhatikan' }}
                            </p>
                            <h6 class="mb-0">
                                {{ $countAcRusak == 0 ? 'Awesome!' : $countAcRusak . ' ' . 'Unit AC yang masih tidak normal.' }}
                            </h6>
                        </div>
                        <div class="ms-auto fs-2 text-danger">
                            <i class="bi bi-gear"></i>
                        </div>
                    </div>
                    <div class="border-top my-2"></div>
                    <small class="mb-0 text-danger"><span class="text-danger"><i class="bi bi-eye"></i></span> Lihat</small>
                </div>
            </div>
        </div>
        {{-- END AC --}}

        {{-- USER --}}
        @can('admin')
            <div class="col-12">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Users Registration</p>
                                <h4 class="mb-0">{{ $countUsers }}</h4>
                            </div>
                            <div class="ms-auto fs-2 text-info">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                        <div class="border-top my-2"></div>
                        <small class="mb-0 text-success"><span class="text-success"> <i class="bi bi-eye"></i></span> List
                            Users Registration</small>
                    </div>
                </div>
            </div>
        @endcan
        {{-- END USER --}}
    </div>

    <div class="row">
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
    
    <script src="{{asset('')}}/assets/js/excel/xlsx.full.min.js"></script>

    <script src="{{ asset('assets/js/excel/FileSaver.js') }}"></script>



    {{-- CHART --}}
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
            var bulan = result.map(item => {
                var monthIndex = [
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December'
                ];
                return monthIndex.indexOf(item.bulan) + 1;
            });


            var options = {
                series: [{
                        name: 'Column',
                        type: 'column',
                        data: total
                    },
                    {
                        name: 'Line',
                        type: 'line',
                        data: total
                    }
                ],
                chart: {
                    foreColor: '#9ba7b2',
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: true
                    }
                },
                stroke: {
                    width: [0, 4]
                },
                plotOptions: {
                    bar: {
                        columnWidth: '35%',
                        endingShape: 'rounded'
                    }
                },
                colors: ['#0d6efd', '#212529'],
                title: {
                    text: `${title} - Total = ${kalkulasi} Unit`
                },
                dataLabels: {
                    enabled: true,
                    enabledOnSeries: [1]
                },
                labels: bulan,
                xaxis: {
                    type: 'category',
                    labels: {
                        formatter: function(value) {
                            var months = [
                                'Januari',
                                'Februari',
                                'Maret',
                                'April',
                                'Mei',
                                'Juni',
                                'Juli',
                                'Agustus',
                                'September',
                                'Oktober',
                                'November',
                                'Desember'
                            ];
                            return months[value - 1];
                        }
                    }
                },
                yaxis: [{
                        title: {
                            text: 'Rata-rata'
                        },
                        labels: {
                            formatter: function(value) {
                                return Math.round(value); // Mengubah angka menjadi bilangan bulat
                            }
                        }
                    },
                    {
                        opposite: true,
                        title: {
                            text: 'Rata-rata'
                        },
                        labels: {
                            formatter: function(value) {
                                return Math.round(value); // Mengubah angka menjadi bilangan bulat
                            }
                        }
                    }
                ],
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return Math.round(value); // Mengubah angka tooltip menjadi bilangan bulat
                        }
                    }
                }
            };

            chart = new ApexCharts(document.querySelector('#chart66'), options);
            chart.render();
        }

        function exportChartToExcel() {
            // Mendapatkan data dari chart
            var chartData = chart.w.globals.series.slice(); // Menggunakan data yang sama dengan chart

            // Membuat array untuk menyimpan data yang akan diekspor ke Excel
            var exportData = [
                ['Tahun', 'Bulan', 'Total']
            ];

            // Mengisi array exportData dengan data chart
            for (var i = 0; i < chartData[0].length; i++) {
                var tahun = $('#tahun').val(); // Mengambil tahun dari input select dengan id "tahun"
                var bulanIndex = chart.w.globals.labels[i] - 1;
                var bulan = new Date(0, bulanIndex).toLocaleString('default', {
                    month: 'long'
                });
                var total = chartData[0][i];

                exportData.push([tahun, bulan, total]);
            }

            // Membuat worksheet Excel menggunakan library "xlsx"
            var worksheet = XLSX.utils.aoa_to_sheet(exportData);

            // Membuat workbook Excel
            var workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Chart Data');

            // Mengkonversi workbook Excel menjadi file binary
            var excelFile = XLSX.write(workbook, {
                bookType: 'xlsx',
                type: 'binary'
            });

            // Mendownload file Excel
            saveAs(new Blob([s2ab(excelFile)], {
                type: 'application/octet-stream'
            }), 'chart_data.xlsx');
        }

        // Fungsi untuk mengkonversi string menjadi array buffer
        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xff;
            return buf;
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

            // Event listener untuk tombol "Export Excel"
            $('#exportExcelBtn').click(function() {
                exportChartToExcel();
            });
        });
    </script>
    {{-- END CHART --}}





    {{-- TYPING EFFECT --}}
    <script>
        function textTypingEffect(element, texts, delay) {
            var currentText = '';
            var currentIndex = 0;
            var isDeleting = false;

            function type() {
                var text = texts[currentIndex];

                if (isDeleting) {
                    currentText = text.substring(0, currentText.length - 1);
                } else {
                    currentText = text.substring(0, currentText.length + 1);
                }

                element.innerHTML = currentText;

                if (isDeleting) {
                    delay = delay / 1; // Penundaan saat penghapusan teks
                }

                if (!isDeleting && currentText === text) {
                    delay = 100; // Penundaan setelah selesai menulis teks
                    isDeleting = true;
                } else if (isDeleting && currentText === '') {
                    isDeleting = false;
                    currentIndex = (currentIndex + 1) % texts.length;
                    delay = 200; // Penundaan antara teks berikutnya
                }

                setTimeout(type, delay);
            }

            type();
        }

        // Penggunaan
        var element = document.getElementById('typing-effect');
        var texts = ['Task ME Tireg 7'];
        var delay = 100; // Penundaan antara setiap karakter

        textTypingEffect(element, texts, delay);
    </script>
    {{-- END TYPING EFFECT --}}
@endsection
