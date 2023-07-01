@extends('layout.main')



@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .btn-switch {
            font-size: 1em;
            position: relative;
            display: inline-block;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .btn-switch__radio {
            display: none;
        }

        .btn-switch__label {
            display: inline-block;
            padding: .75em .5em .75em .75em;
            vertical-align: top;
            font-size: 1em;
            font-weight: 700;
            line-height: 1.5;
            color: #666;
            cursor: pointer;
            transition: color .2s ease-in-out;
        }

        .btn-switch__label+.btn-switch__label {
            padding-right: .75em;
            padding-left: 0;
        }

        .btn-switch__txt {
            position: relative;
            z-index: 2;
            display: inline-block;
            min-width: 1.5em;
            opacity: 1;
            pointer-events: none;
            transition: opacity .2s ease-in-out;
        }

        .btn-switch__radio_no:checked~.btn-switch__label_yes .btn-switch__txt,
        .btn-switch__radio_yes:checked~.btn-switch__label_no .btn-switch__txt {
            opacity: 0;
        }

        .btn-switch__label:before {
            content: "";
            position: absolute;
            z-index: -1;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: #f0f0f0;
            border-radius: 1.5em;
            box-shadow: inset 0 .0715em .3572em rgba(43, 43, 43, .05);
            transition: background .2s ease-in-out;
        }

        .btn-switch__radio_yes:checked~.btn-switch__label:before {
            background: #7B378E;
        }

        .btn-switch__label_no:after {
            content: "";
            position: absolute;
            z-index: 2;
            top: .5em;
            bottom: .5em;
            left: .5em;
            width: 2em;
            background: #fff;
            border-radius: 1em;
            pointer-events: none;
            box-shadow: 0 .1429em .2143em rgba(43, 43, 43, .2), 0 .3572em .3572em rgba(43, 43, 43, .1);
            transition: left .2s ease-in-out, background .2s ease-in-out;
        }

        .btn-switch__radio_yes:checked~.btn-switch__label_no:after {
            left: calc(100% - 2.5em);
            background: #fff;
        }

        .btn-switch__radio_no:checked~.btn-switch__label_yes:before,
        .btn-switch__radio_yes:checked~.btn-switch__label_no:before {
            z-index: 1;
        }

        .btn-switch__radio_yes:checked~.btn-switch__label_yes {
            color: #fff;
        }



        .led-on {
            margin: 10px 30px;
            width: 24px;
            height: 24px;
            background-color: #ABFF00;
            border-radius: 50%;
            box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #304701 0 -1px 9px, #89FF00 0 2px 12px;
        }

        .led-off {
            margin: 10px 30px;
            width: 24px;
            height: 24px;
            background-color: red;
            border-radius: 50%;
            box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #582222 0 -1px 9px, rgba(119, 25, 25, 0.5) 0 2px 12px;
        }

        /* tombol remote */
        .containerPanah, .containerMode, .containerFan, .containerPower {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kiri,
        .kanan,
        .fan-auto,
        .fan-high {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            outline: none;
            border: none;
            background-color: #e5e5e5;
            box-shadow: 1px 1px 3px rgba(100, 100, 100, 0.7), inset -1px -1px 3px rgba(65, 64, 64, 0.5);
            border-radius: 50%;
            cursor: pointer;
        }

        .power{
            width: 60px;
            height: 60px;
            outline: none;
            border: none;
            background-color: #e5e5e5;
            box-shadow: 1px 1px 3px rgba(100, 100, 100, 0.7), inset -1px -1px 3px rgba(65, 64, 64, 0.5);
            border-radius: 50%;
            cursor: pointer;
        }
        .power i{
            font-size: 35px;
        }


        .fan,
        .cool,
        .dry{
            outline: none;
            border: none;
            background-color: #e5e5e5;
            box-shadow: 1px 1px 3px rgba(100, 100, 100, 0.7), inset -1px -1px 3px rgba(65, 64, 64, 0.5);
            border-radius: 50%;
            cursor: pointer;
        }

        .cool, .fan, .dry, .fan-auto, .fan-high{
            margin: 5px;
        }

        .kiri i,
        .kanan i,
        .cool i,
        .fan i,
        .dry i,
        .fan-auto i,
        .fan-high i
        {
            font-size: 24px;
            /* Ukuran ikon */
            margin: 2px;
            /* Jarak antara ikon dan tepi tombol */
        }


        .suhu {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 20px;
            /* Jarak antara tombol panah dan suhu */
            font-size: 24px;
            /* Ukuran teks suhu */
            font-weight: bold;
        }

        .suhu p {
            margin: 0;
        }

        .kiri:active,
        .kanan:active,
        .cool:active,
        .fan:active,
        .dry:active,
        .fan-auto:active,
        .fan-high:active,
        .power:active {
            box-shadow: -1px -1px 3px rgba(100, 100, 100, 0.7), inset 1px 1px 3px rgba(65, 64, 64, 0.5);
        }
        .power-off{
            color:red;
        }
        .power-on{
            color:rgb(9, 238, 9);
        }
    </style>

    <div class="row">
        <div class="col-md-2">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="label">
                        <strong>ID : A1.01</strong>
                    </div>
                    <div class="led-box">
                        <div class="led-off" id="led" data-led="{{ $relay['power'] }}"></div>
                    </div>

                    {{-- <div class="form-check form-switch" style="margin: 50px;margin-left:70px">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                            style="font-size: 30px" onchange="ubahstatus(this.checked)"
                            {{ $relay['power'] == 1 ? 'checked' : '' }}
                            onclick="playSound('{{ asset('assets/sounds/remote.wav') }}')">
                        <label class="form-check-label" for="flexSwitchCheckChecked"
                            style="font-size: 30px;margin-right:20px"><span
                                id="status">{{ $relay['power'] == 1 ? 'ON' : 'OFF' }}</span></label>
                    </div> --}}

                    <div class="containerPower mt-5 mb-5">
                        <button class="power" id="power" data-status="{{ $relay['power'] }}" onclick="ubahstatus('{{ $relay['power'] }}', this)">
                            <i class="bi bi-power" id="iconPower"></i>
                          </button>
                    </div>

                    <div class="containerPanah">
                        <button class="kiri" onclick="playSound('{{ asset('assets/sounds/remote.wav') }}')">
                            <i class="bi bi-arrow-down-short"></i>
                        </button>
                        <div class="suhu">
                            <p id="suhudownValue">{{ $suhu->suhu }}</p>
                        </div>
                        <button class="kanan" onclick="playSound('{{ asset('assets/sounds/remote.wav') }}')">
                            <i class="bi bi-arrow-up-short"></i>
                        </button>
                    </div>

                    <div class="containerMode mt-5">
                        <button class="cool" id="cool"><i class="bi bi-snow"></i></button>
                        <button class="fan" id="fan"><i class="bi bi-life-preserver"></i></button>
                        <button class="dry" id="dry"><i class="bi bi-droplet"></i></button>
                    </div>

                    <div class="containerFan mt-5">
                        <button class="fan-auto" id="fanAuto"><i class="bi bi-flower3"></i></button>
                        <button class="fan-high" id="fanHigh"><i class="bi bi-flower1"></i></button>
                    </div>

                    <audio id="buttonSound"></audio>

                    </div>
                </div>
            </div>





        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

        <script type="text/javascript">

            const kiri = document.querySelector(".kiri");

            kiri.addEventListener("click", function() {
                const  req = new XMLHttpRequest();

                req.onreadystatechange = function () {
                    if(req.readyState === 4){
                        if(req.status === 200){
                            console.log(req.responsesText);
                        }
                    }
                }

                req.open('get', "{{ url('/control/suhu') }}");
                req.send();

            });


        </script>

<script type="text/javascript">

    const kanan = document.querySelector(".kanan");

    kanan.addEventListener("click", function() {
        const  req = new XMLHttpRequest();

        req.onreadystatechange = function () {
            if(req.readyState === 4){
                if(req.status === 200){
                    console.log(req.responsesText);
                }
            }
        }

        req.open('get', "{{ url('/control/suhu') }}");
        req.send();

    });


</script>



        {{-- <script>

            function ubahstatus(val) {
                const LED = document.getElementById('led');
                console.log(val);

                if (val == 1) {
                    val = "ON";
                    LED.classList.remove('led-off');
                    LED.classList.add('led-on');
                } else {
                    val = "OFF";
                    LED.classList.remove('led-on');
                    LED.classList.add('led-off');
                }


                // document.querySelector("#status").innerHTML = val;

                fetch("{{ url('/enertrack/control') }}" + "/" + val)
                    .then(response => {
                        if (response.ok) {
                            return response.text();
                        } else {
                            throw new Error('Request failed');
                        }
                    })
                    .then(data => {
                        // document.querySelector("#status").innerHTML = data;
                        console.log(data);
                    })
                    .catch(error => {
                        alert(error.message);
                    });
            }
        </script> --}}


        <script>

            function ubahstatus(status, button) {
                const LED = document.getElementById('led');
                const POWER = document.querySelector('#iconPower');


                if (button.getAttribute('data-status') == 1) {
                button.setAttribute('data-status', '0');
                // Ubah tampilan tombol menjadi unchecked
                button.innerHTML = '<i class="bi bi-power power-on"></i>';
                LED.classList.remove('led-off');
                LED.classList.add('led-on');

                status = "ON";
            } else {
                button.setAttribute('data-status', '1');
                // Ubah tampilan tombol menjadi checked
                button.innerHTML = '<i class="bi bi-power power-off"></i>';
                LED.classList.remove('led-on');
                LED.classList.add('led-off');

                status = "OFF";
                }


                // if (status == 1) {
                // button.setAttribute('data-status', '0');
                // // Ubah tampilan tombol menjadi angka 0
                // button.innerHTML = '<i class="bi bi-power"></i>';
                // LED.classList.remove('led-off');
                //     LED.classList.add('led-on');
                //     status = "OFF";
                // } else {
                // button.setAttribute('data-status', '1');
                // // Ubah tampilan tombol menjadi angka 1
                // button.innerHTML = '<i class="bi bi-power"></i>';
                // LED.classList.remove('led-on');
                //     LED.classList.add('led-off');
                //     status = "ON";
                // }


                // document.querySelector("#status").innerHTML = val;

                fetch("{{ url('/enertrack/control') }}" + "/" + status)
                    .then(response => {
                        if (response.ok) {
                            return response.text();
                        } else {
                            throw new Error('Request failed');
                        }
                    })
                    .then(data => {
                        // document.querySelector("#status").innerHTML = data;
                        // console.log(data);
                    })
                    .catch(error => {
                        alert(error.message);
                    });
            }
        </script>



        <script>
            $(document).ready(function() {

                // Ambil CSRF token dari meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Atur header untuk setiap permintaan AJAX
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                $('.kiri').click(function() {
                    var suhudown = parseInt($('#suhudownValue').text());
                    if (suhudown > 16) {
                        suhudown--;
                        updateSuhudown(suhudown);
                    }
                });

                $('.kanan').click(function() {
                    var suhudown = parseInt($('#suhudownValue').text());
                    if (suhudown < 32) {
                        suhudown++;
                        updateSuhudown(suhudown);
                    }
                });

                function updateSuhudown(suhudown) {
                    $.ajax({
                        url: '{{ route('control.updateSuhudown') }}',
                        type: 'POST',
                        data: {
                            suhudown: suhudown
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#suhudownValue').text(suhudown);
                            }
                        }
                    });
                }
            });
        </script>



        <script>
            $(document).ready(function() {
                var ledStatus = $('#led').data('led'); // Mendapatkan nilai dari atribut data-led
                var powerStatus = $('#iconPower').data('power');
                console.log(powerStatus);

                if (ledStatus == 1) {
                    $('#led').removeClass('led-off').addClass('led-on');
                }
                if (ledStatus == 0) {
                    $("#iconPower").removeClass("power-on").addClass("power-off");
                }
            });
        </script>


<script>

    function playSound(soundUrl) {
        var buttonSound = document.getElementById("buttonSound");
        buttonSound.src = soundUrl;
        buttonSound.play();
    }


</script>

    @endsection
