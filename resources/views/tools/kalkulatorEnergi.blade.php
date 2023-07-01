@extends('layout.main')

@section('content')

    <div class="container-fluid">
        <h6 class="mb-0 text-uppercase">Biaya Listrik / Harga Listrik per kWh Listrik 2022 Subsidi dan Non-Subsidi</h6>
            <hr/>
            <div class="card">
              <div class="card-body">
                <table class="table mb-0 table-hover">
                  <thead>
                    <tr>
                     <th scope="col">Golongan</th>
                      <th scope="col">Daya Listrik</th>
                      <th scope="col">Tarif/Harga Listrik per kWH</th>
                    </tr>
                  </thead>
                  <tbody class="body-tarif">

                  </tbody>
                </table>
              </div>
            </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0">Kalkulator Konsumsi Energi</h5>
                        </div>
                        <hr/>
                        <form name="calcform" autocomplete="off">
                            <div class="row mb-1">
                            <label class="col-sm-6 col-form-label">Peralatan elektronik:</label>
                            <select class="form-select mb-3" name="Select4" onchange="OnSetPower()" autofocus>
                                <option>-- select --</option>
                                <option>Air conditioner</option>
                                <option>Pengering pakaian</option>
                                <option>Setrika pakaian</option>
                                <option>Kipas</option>
                                <option>Pemanas</option>
                                <option>Oven microwave</option>
                                <option>Komputer</option>
                                <option>Laptop</option>
                                <option>Lemari es</option>
                                <option>TV</option>
                                <option>Vacuum cleaner</option>
                                <option>Mesin cuci</option>
                                <option>Pemanas air</option>
                            </select>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <label class="col-form-label">Konsumsi daya:</label>
                                        <input type="number" min="0" step="any" name="Text1" class="form-control intext">
                                </div>
                                <div class="col-md-5 mb-0" style="margin-top: 14px">
                                    <label class="col-form-label"></label>
                                    <select class="form-select mb-3" name="Select2">
                                        <option selected="selected">watt (W)</option>
                                        <option>kilowatt (kW)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-form-label">Jam penggunaan per hari:</label>
                                <div class="col-sm-12">
                                    <input type="number" step="any" min="0" max="24" name="Text2" class="form-control intext">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-form-label">Energi yang dikonsumsi per hari (kWh/hari):</label>
                                <div class="col-sm-12">
                                    <input type="text" name="Text8" class="form-control outtext" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-form-label">Energi yang dikonsumsi per bulan (kWh/bulan):</label>
                                <div class="col-sm-12">
                                    <input type="text" name="Text9" class="form-control outtext" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-form-label">Energi yang dikonsumsi per tahun (kWh/tahun):</label>
                                <div class="col-sm-12">
                                    <input type="text" name="Text10" class="form-control outtext" readonly>
                                </div>
                            </div>
                                <div class="col-md-12">
                                    <button onclick="OnEnergyCalc()" type="button" class="btn btn-purple px-5">Hitung</button>
                                </div>
                        </form>
                        <br>
                        <h6>Perhitungan konsumsi energi</h6>
                        <hr>
                        <p>Energi E dalam kilowatt-jam (kWh) per hari sama dengan daya P dalam watt (W) dikali jumlah jam pemakaian per hari t dibagi dengan 1000 watt per kilowatt:</p>
                        <p>E (kWh / hari) = P (W) × t (h / hari) / 1000 (W / kW)</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0">Menghitung Biaya Listrik per kWh</h5>
                            </div>
                            <hr/>
                            <div class="col-12">
                                <div id="placeKWH">

                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <label class="form-label">Daya Listrik</label>
                                <select class="form-select mb-3" id="iDaya">
                                    <option value="415">450 VA (Subsidi) = Rp415/kWh - R1</option>
                                    <option value="605">900 VA (Subsidi) = Rp605/kWh - R1</option>
                                    <option value="1352">900 VA = Rp1352/kWh - R1</option>
                                    <option value="1444.7">1300 VA = Rp1444.7/kWh - R1</option>
                                    <option value="1444.7">2200 VA = Rp1444.7/kWh - R1</option>
                                    <option value="1444.7">33000 – 5500 VA = Rp1444.7/kWh - R2</option>
                                    <option value="1444.7">6600 VA ke atas = Rp1444.7/kWh - R3</option>
                                    <option value="254">450 VA = Rp254/kWh - B1</option>
                                    <option value="420">900 VA = Rp420/kWh - B1</option>
                                    <option value="966">1.300 VA = Rp966/kWh - B1</option>
                                    <option value="1114.7">2200 – 5500 VA = Rp1.114,74/kWh - B1</option>
                                </select>
                            </div>
                            <div class="col-12 mt-2">
                                <label class="form-label">Total Biaya</label>
                                <input type="text" class="form-control" id="iBiaya" readonly>
                            </div>
                            <div class="col-12 mt-5">
                                <div class="d-grid">
                                  <button type="button" id="hitungBiaya" class="btn btn-purple">Hitung</button>
                                </div>
                              </div>
                              <br>
                              <h6>Rumus : Total kWh x tarif</h6>
                              <hr>
                              <h6>Cara menghitung :</h6>
                              <p>(Jumlah watt x Lama Pemakaian jam)/1000</p>
                              <p>Di bagi 1000 karena untuk menghitung biaya listrik mmenggunkan kWh</p>
                              <br>
                              <h6>Contoh :</h6>
                              <p>Jumlah watt = (100 watt x 4 jam)/1000 = 0.4 kWh</p>
                              <p>Biaya listrik = 0.4 kWh x 1.444.70 = Rp578 / hari</p>
                              <p>1.444.70 adalah tarif listrik R1 non-subsidi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script>

            function roundresult(x) {
                y = parseFloat(x);
                y = roundnum(y,10);
                return y;
            }
            function roundnum(x,p) {
                var i;
                var n=parseFloat(x);
                var m=n.toPrecision(p+1);
                var y=String(m);
                i=y.indexOf('e');
                if( i==-1 )	i=y.length;
                j=y.indexOf('.');
                if( i>j && j!=-1 )
                {
                    while(i>0)
                    {
                        if(y.charAt(--i)=='0')
                            y = removeAt(y,i);
                        else
                            break;
                    }
                    if(y.charAt(i)=='.')
                        y = removeAt(y,i);
                }
                return y;
            }

            function removeAt(s,i) {
                s = s.substring(0,i)+s.substring(i+1,s.length);
                return s;
            }

        </script>

        <script>
            function OnSetPower()
                    {
                        look=[870,400,200,60,700,200,450,200,450,230,190,175,350];
                        i = document.calcform.Select4.selectedIndex;
                        if(i==0) return;
                        document.calcform.Text1.value = look[i-1];
                        document.calcform.Select2.selectedIndex=0;
                    }
                    function OnEnergyCalc()
                    {
                        i2 = document.calcform.Select2.selectedIndex;
                        p = document.calcform.Text1.value;
                        h = document.calcform.Text2.value;
                        if( p=='' || h=='' ) return;
                        if( i2==0 ) p/=1000;
                        kwh_day   = p*h;
                        kwh_month = kwh_day*30;
                        kwh_year  = kwh_day*365;
                        kwh_day   = roundnum(kwh_day,5);
                        kwh_month = roundnum(kwh_month,5);
                        kwh_year  = roundnum(kwh_year,5);
                        document.calcform.Text8.value  = kwh_day;
                        document.calcform.Text9.value  = kwh_month;
                        document.calcform.Text10.value = kwh_year;

                        const perH = document.calcform.Text8.value;
                        const perB = document.calcform.Text9.value;
                        const perT = document.calcform.Text10.value;

                        document.getElementById("placeKWH").innerHTML = `<label class="form-label">kWh</label>
                                <select class="form-control" id="iKWH">
                                    <option value="" selected>--Select--</option>
                                    <option value="${perH}">${perH} kWh/hari</option>
                                    <option value="${perB}">${perB} kWh/bulan</option>
                                    <option value="${perT}">${perT} kWh/tahun</option>
                                </select>`;

                    const btnKwh = document.querySelector("#iKWH");
                    btnKwh.addEventListener('change', function() {
                        const kwh = this.value;
                        const btnHitung = document.getElementById("hitungBiaya");
                        btnHitung.addEventListener("click", function() {
                            const iDaya = document.querySelector("#iDaya").value;
                            var biaya = Math.floor(kwh * iDaya);
                            var total = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(biaya);
                            document.querySelector("#iBiaya").value = total;
                        });
                    });



                }
        </script>

        <script>
            fetch('/assets/tarif-listrik.json')
                .then(succ => succ.json())
                .then(res => {
                    let cardTarif = '';

                    res.forEach((e,i) => {


                        cardTarif += `<tr>
                      <td>${e.golongan}</td>
                      <td>${e.daya}</td>
                      <td>Rp${e.tarif}/kWh</td>
                    </tr>`;
                    });

                document.querySelector('.body-tarif').innerHTML = cardTarif;
                });
        </script>
@endsection
