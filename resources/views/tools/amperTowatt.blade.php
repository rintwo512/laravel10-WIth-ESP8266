@extends('layout.main')

@section('content')

        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                  <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                      <p class="mb-0">Arus listrik dalam ampere (A) menjadi daya listrik dalam watt (W)</p>
                    </div>
                    <hr/>
                    <ul class="nav nav-tabs mb-2">
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('/tools/watttoamper') }}">Watts to Amps</a>
                        </li>
                        <li class="nav-item show">
                        <a class="nav-link" href="#" active>Amps to Watts</a>
                        </li>
                    </ul>
                    <form  id="calcform" name="calcform" autocomplete="off">
                        <div class="form-group mt-2">
                            <label for="phase">Current type</label>
                            <select id="phase" name="phase" onchange="OnPhaseChange()" class="form-control" autofocus>
                            <option>DC</option>
                            <option selected>AC - Single phase</option>
                            <option>AC - Three phase</option>
                            </select>
                            </div>
                        <div class="form-group mt-2">
                            <label for="x1">Current (amps)</label>
                            <div class="input-group">
                            <input type="text" id="x1" name="x1" class="form-control" required>
                            <div class="input-group-append">
                            <select id="aunitsel" class="form-control">
                            <option>mA</option>
                            <option selected>A</option>
                            <option>kA</option>
                            </select>
                            </div>
                            </div>
                            </div>
                        <div class="form-group mt-2" id="pf0" style="display:none">
                            <label for="volt">Voltage type</label>
                            <select id="volt" name="volt" class="form-control">
                            <option>Line to line voltage</option>
                            <option>Line to neutral voltage</option>
                            </select>
                            </div>
                        <div class="form-group mt-2">
                            <label for="x2">Voltage (volts)</label>
                            <div class="input-group">
                                <input type="text" value="220" id="x2" name="x2" class="form-control" required>
                                <div class="input-group-append">
                                    <select id="vunitsel" class="form-control">
                                        <option>mV</option>
                                        <option selected>V</option>
                                        <option>kV</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2" id="pf1">
                            <label for="pf">Power factor (&le;1)</label>
                            <input type="text" id="pf" name="pf" value="1" class="form-control">
                            </div>
                        <div class="my-3">
                            <div class="row row-cols-auto g-3">
                                <div class="col">
                                    <div class="btn-group">
                                        <button type="button" title="Calculate" class="btn btn-purple" onclick="convert()"><span class="bi bi-calculator"></span> Calculate</button>
                                        </div>
                                        <button type="reset" title="Reset" class="btn btn-secondary" onclick="setfocus()"><span class="bi bi-x-circle"></span> Reset</button>
                                        <button type="button" title="Swap conversion" class="btn btn-success" onclick="location.href='/tools/watt-to-amper';"><span class="bi bi-arrow-clockwise"></span> Swap</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="y">Power (watts)</label>
                                <div class="input-group">
                                    <input type="text" id="y" name="y" class="form-control" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">W</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="y">Power (kilowatts)</label>
                                <div class="input-group">
                                <input type="text" id="y2" name="y2" class="form-control" readonly>
                                <div class="input-group-append">
                                <span class="input-group-text">kW</span>
                                </div>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="y">Power (milliwatts)</label>
                                <div class="input-group">
                                <input type="text" id="y3" name="y3" class="form-control" readonly>
                                <div class="input-group-append">
                                <span class="input-group-text">mW</span>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4>Rumus 1 Phase</h4>
                        <hr>
                        <p>Daya P dalam watt (W) sama dengan faktor daya PF dikalikan arus fasa I dalam ampere (A), dikalikan tegangan dalam volt (V):</p>
                        <p>P(W) = PF × I(A) × V(V)</p>
                        <br>
                        <br>
                        <h4>Rumus 3 Phase</h4>
                        <h5>Perhitungan dengan tegangan line to line</h5>
                        <hr>
                        <p>Daya P dalam watt (W) sama dengan akar kuadrat dari 3 kali faktor daya PF kali arus fasa I dalam amp (A), dikalikan tegangan line to line VL-L dalam volt (V):</p>
                        <p>P(W) = √3 × PF × I(A) × VL-L(V)</p>
                        <hr>
                        <h5>Perhitungan dengan tegangan line to netral voltage</h5>
                        <p>Daya P dalam watt (W) sama dengan 3 kali faktor daya PF dikalikan arus fasa I dalam ampere (A), dikalikan line to tegangan netral VL-N dalam volt (V):</p>
                        <p>P(W) = 3 × PF × I(A) × VL-N(V)</p>
                    </div>
                  </div>
              </div>

        </div>
<script>

function setfocus(){
    document.calcform.x.focus();
}

function str2num(s){
    s=s.toString().trim().replace(/(\d)(\s+)(?=\d)/gm,"$1+").replace(/[^-()\d/*+.]/g,'');
    if(s=='')return 0;return Function('"use strict";return ('+s+')')();
}
function isInt(n){
    return Number(n)===n&&n%1===0;
}
function isFloat(n){
    return Number(n)===n&&n%1!==0;
}
function roundresult(x){
    y=parseFloat(x);y=roundnum(y,10);return y;
}
function roundnum(x,p){
    var i;var n=parseFloat(x);var m=n.toPrecision(p+1);var y=String(m);i=y.indexOf('e');
    if(i==-1)i=y.length;j=y.indexOf('.');if(i>j&&j!=-1)
        {while(i>0)
            {if(y.charAt(--i)=='0')
                y=removeAt(y,i);else
                    break;
            }
            if(y.charAt(i)=='.')
                y=removeAt(y,i);
        }
        return y;
}
function removeAt(s,i){
    s=s.substring(0,i)+s.substring(i+1,s.length);
    return s;
}

</script>

<script>
    window.addEventListener("DOMContentLoaded",function() {
      document.getElementById("calcform").onkeypress = function(e) { if( e.keyCode==13 ) convert(); };
   });
   function OnPhaseChange() {
      var iphase = document.calcform.phase.selectedIndex;
      var row0 = document.getElementById("pf0");
      var row1 = document.getElementById("pf1");
      if( iphase==0 )
      {
         document.calcform.pf.disabled = true;
         document.calcform.pf.style.backgroundColor = "#f0f0f0";
         row0.style.display = 'none';
         row1.style.display = 'none';
      }
      else if( iphase==1 )
      {
         document.calcform.pf.disabled = false;
         document.calcform.pf.style.backgroundColor = "#ffffff";
         row0.style.display = 'none';
         row1.style.display = '';
      }
      else
      {
         document.calcform.pf.disabled = false;
         document.calcform.pf.style.backgroundColor = "#ffffff";
         row0.style.display = '';
         row1.style.display = '';
      }
   }
   function convert() {
      var x1 = document.calcform.x1.value;
      var x2 = document.calcform.x2.value;
      var iaunit = document.getElementById("aunitsel").selectedIndex;
      var ivunit = document.getElementById("vunitsel").selectedIndex;
      var iphase = document.calcform.phase.selectedIndex;
      var ivolt = document.calcform.volt.selectedIndex;
      var pf = document.calcform.pf.value;
      if( iaunit==0 ) x1/=1000;
      if( iaunit==2 ) x1*=1000;
      if( ivunit==0 ) x2/=1000;
      if( ivunit==2 ) x2*=1000;
      var w = x1*x2;
      if( pf<0 || pf>1 )
      {
         alert('Please enter power factor from 0 to 1');
         document.calcform.pf.focus();
         return;
      }
      if( iphase==1 )
         w*=pf;
      else if( iphase==2 )
      {
         if( ivolt==0 )
            w*=(pf*Math.sqrt(3));
         else
            w*=(pf*3);
      }
      document.calcform.y.value = roundresult(w);
      document.calcform.y2.value = roundresult(w/1000.0);
      document.calcform.y3.value = roundresult(1000*w);
   }
</script>

@endsection
