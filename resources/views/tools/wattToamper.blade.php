@extends('layout.main')

@section('content')

        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                  <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                      <p class="mb-0">Daya listrik dalam watt (W) ke arus listrik dalam amp (A)</p>
                    </div>
                    <hr/>
                    <ul class="nav nav-tabs mb-2">
                        <li class="nav-item show">
                        <a class="nav-link" href="#" active>Watts to Amps</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('/tools/ampertowatt') }}">Amps to Watts</a>
                        </li>
                        </ul>
                        <form id="calcform" name="calcform" autocomplete="off">
                        <div class="form-group mt-2">
                        <label for="phase">Current type</label>
                        <select id="phase" name="phase" onchange="OnPhaseChange()" class="form-control" autofocus>
                        <option>DC</option>
                        <option selected>AC - Single phase</option>
                        <option>AC - Three phase</option>
                        </select>
                        </div>
                        <div class="form-group mt-2">
                        <label for="x1">Power (watts)</label>
                        <div class="input-group">

                        <input type="text" id="x1" name="x1" class="form-control" required>
                        <div class="input-group-append">
                        <select id="wunitsel" class="form-control">
                        <option>mW</option>
                        <option selected>W</option>
                        <option>kW</option>
                        </select>
                        </div>
                        </div>
                        </div>
                        <div class="form-group mt-2" id="pf0" style="display:none">
                        <label>Voltage type</label>
                        <select name="volt" class="form-control">
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

                        <input type="text" value="1" id="pf" name="pf" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                        <button type="button" title="Calculate" class="btn btn-purple" onclick="convert()"><span class="bi bi-calculator"></span> Calculate</button>
                        <button type="reset" title="Reset" class="btn btn-secondary" onclick="setfocus()"><span class="bi bi-x-circle"></span> Reset</button>
                        <button type="button" title="Swap conversion" class="btn btn-success" onclick="location.href='/tools/amper-to-watt';"><span class="bi bi-arrow-clockwise"></span> Swap</button>
                        </div>
                        <div class="form-group mt-2">
                        <label>Current (amps)</label>
                        <div class="input-group">
                        <input type="text" name="y" class="form-control" readonly>
                        <div class="input-group-append">
                        <span class="input-group-text">A</span>
                        </div>
                        </div>
                        </div>
                        <div class="form-group mt-2">
                        <label>Current (milliamps)</label>
                        <div class="input-group">
                        <input type="text" name="y2" class="form-control" readonly>
                        <div class="input-group-append">
                        <span class="input-group-text">mA</span>
                        </div>
                        </div>
                        </div>
                        </form>
                  </div>
                </div>
              </div>
              <div class="card">
               <div class="card-body">
                  <h4>Rumus 1 Phase</h4>
                  <hr>
                  <p>Arus fasa I dalam ampere (A) sama dengan daya P dalam watt (W), dibagi dengan faktor daya PF kali tegangan dalam volt (V):</p>
                  <p>I(A) = P(W) / (PF × V(V))</p>
                  <small>Faktor daya beban impedansi resistif sama dengan 1.</small>
                  <br>
                  <br>
                  <h4>Rumus 3 Phase</h4>
                  <hr>
                  <p>Arus fasa I dalam ampere (A) sama dengan daya P dalam watt (W), dibagi dengan akar kuadrat dari 3 kali faktor daya PF kali tegangan line to line VL-L dalam volt (V):</p>
                  <p>I(A) = P(W) / (√3 × PF × VL-L(V) )</p>
                  <small>Faktor daya beban impedansi resistif sama dengan 1.</small>
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
    var x1elem=document.getElementById("x1");
   var x2elem=document.getElementById("x2");
   var phaseelem=document.getElementById("phase");
   var voltelem=document.getElementById("volt");
   var pfelem=document.getElementById("pf");
   window.addEventListener("DOMContentLoaded",function() {
      //document.getElementById("calcform").onkeypress = function(e) { if( e.keyCode==13 ) OnCalc(); };
      var params=GetURLParams();
      if( Object.keys(params).length>0 ) {
         x1elem.value=decodeURIComponent(params.x1);
         x2elem.value=decodeURIComponent(params.x2);
         phaseelem.value=decodeURIComponent(params.phase);
         voltelem.value=decodeURIComponent(params.volt);
         pfelem.value=decodeURIComponent(params.pf);
         convert();
      }
   });
   function GetURLParams()
   {
      var url=window.location.href;
      var regex = /[?&]([^=#]+)=([^&#]*)/g,
            //url = "www.domain.com/?v=123&p=hello",
            params = {},
            match;
      while(match = regex.exec(url)) {
         params[match[1]] = match[2];
      }
      return params;
   }
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
      var iwunit = document.getElementById("wunitsel").selectedIndex;
      var ivunit = document.getElementById("vunitsel").selectedIndex;
      var iphase = document.calcform.phase.selectedIndex;
      var ivolt = document.calcform.volt.selectedIndex;
      var pf = document.calcform.pf.value;
      if( iwunit==0 ) x1/=1000;
      if( iwunit==2 ) x1*=1000;
      if( ivunit==0 ) x2/=1000;
      if( ivunit==2 ) x2*=1000;
      var w = x1/x2;
      if( pf<0 || pf>1 )
      {
         alert('Please enter power factor from 0 to 1');
         document.calcform.pf.focus();
         return;
      }
      if( iphase==1 )
         w/=pf;
      else if( iphase==2 )
      {
         if( ivolt==0 )
            w/=(pf*Math.sqrt(3));
         else
            w/=(pf*3);
      }
      var y  = roundresult(w);
      var y2  = roundresult(1000*w);
      document.calcform.y.value = y;
      document.calcform.y2.value = y2;
   }
</script>

@endsection
