@extends('layout.main')

@section('content')

        {{-- BTU/h --}}
    <h6 class="mb-0 text-uppercase">Kalkulator konversi BTU/h ke watt</h6>
    <hr/>
  <div class="col-xl-6 mx-auto">
    <div class="card">
      <div class="card-body">
        <div class="border p-3 rounded">
        <h6 class="mb-0 text-uppercase">Masukkan daya dalam BTU/h dan tekan tombol convert:</h6>
        <hr/>
        <form class="row g-3" name="calcform">
          <div class="col-12">
            <label class="form-label">Masukkan daya dalam Btu/h :</label>
            <input type="number" name="x" id="x" class="intext form-control" placeholder="Btu/h">
          </div>
          <div class="col-6">
            <div class="d-grid">
              <button onclick="calc()" type="button" class="btn btn-purple">Convert</button>
            </div>
          </div>
          <div class="col-6">
            <div class="d-grid">
              <button onclick="setfocus()" type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </div>
          <div class="col-12">
            <label class="form-label">Hasil:</label>
            <input type="number" name="y" class="outtext form-control" placeholder="Watt" readonly>
          </div>
        </form>
      </div>
      </div>
    </div>
    <h6 class="mb-0 text-uppercase">Tabel konversi Btu/h ke Watt</h6>
            <hr/>
            <div class="card">
              <div class="card-body">
                <table class="table mb-0 table-striped">
                  <thead>
                    <tr>
                        <th scope="col">Power (BTU/hr)</th>
                      <th scope="col">Power (watt)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1 BTU/h</td>
                      <td>0.293071 Watt</td>
                    </tr>
                    <tr>
                      <td>10 BTU/h</td>
                      <td>2.930710 Watt</td>
                    </tr>
                    <tr>
                      <td>100 BTU/h</td>
                      <td>29.307107 Watt</td>
                    </tr>
                    <tr>
                      <td>1000 BTU/h</td>
                      <td>293.071070 Watt</td>
                    </tr>
                    <tr>
                      <td>10000 BTU/h</td>
                      <td>2930.710700 Watt</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <h4 class="mb-0 text-uppercase">Cara mengubah Btu/hr ke watt</h4>
                <hr>
                <h6>Rumus</h6>
                <p>Daya P dalam watt (W) sama dengan daya P dalam BTU per jam (BTU/jam) dikali 0,29307107 dan sama dengan daya P dalam BTU per jam (BTU/jam) dibagi 3.412141633:</p>
                <p>P(W) = P(BTU/hr) × 0.29307107 = P(BTU/hr) / 3.412141633</p>
                <br>
                <h6>Contoh</h6>
                <p>20000 BTU/hr ke watt:</p>
                <p>P(W) = 20000 BTU/hr / 3.412141633 = 5861.42W</p>
              </div>
            </div>
  </div>


  <script>

function setfocus(){document.calcform.x.focus();}
function calc(){x=document.calcform.x.value;y=convert(x);y=roundresult(y);document.calcform.y.value=y;}

function str2num(s)
{s=s.toString().trim().replace(/(\d)(\s+)(?=\d)/gm,"$1+").replace(/[^-()\d/*+.]/g,'');if(s=='')return 0;return Function('"use strict";return ('+s+')')();}
function isInt(n)
{return Number(n)===n&&n%1===0;}
function isFloat(n)
{return Number(n)===n&&n%1!==0;}
function roundresult(x){y=parseFloat(x);y=roundnum(y,10);return y;}
function roundnum(x,p){var i;var n=parseFloat(x);var m=n.toPrecision(p+1);var y=String(m);i=y.indexOf('e');if(i==-1)i=y.length;j=y.indexOf('.');if(i>j&&j!=-1)
{while(i>0)
{if(y.charAt(--i)=='0')
y=removeAt(y,i);else
break;}
if(y.charAt(i)=='.')
y=removeAt(y,i);}
return y;}
function removeAt(s,i){s=s.substring(0,i)+s.substring(i+1,s.length);return s;}

  </script>

<script>
    function convert(x) {
		 	return x*0.29307107;
		}
</script>

@endsection
