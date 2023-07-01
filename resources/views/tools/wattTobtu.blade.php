@extends('layout.main')

@section('content')

        {{-- BTU/h --}}
    <h6 class="mb-0 text-uppercase">Kalkulator konversi Watt ke BTU/h</h6>
    <hr/>
  <div class="col-xl-6 mx-auto">
    <div class="card">
      <div class="card-body">
        <div class="border p-3 rounded">
        <h6 class="mb-0 text-uppercase">Masukkan daya dalam watt dan tekan tombol Convert:</h6>
        <hr/>
        <form class="row g-3" name="calcform">
          <div class="col-12">
            <label class="form-label">Masukkan daya dalam watt :</label>
            <input type="number" name="x" id="x" class="intext form-control" placeholder="Watt">
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
            <input type="number" name="y" class="outtext form-control" placeholder="Btu/h" readonly>
          </div>
        </form>
      </div>
      </div>
    </div>
    <h6 class="mb-0 text-uppercase">Tabel konversi Watt ke BTU/hr</h6>
            <hr/>
            <div class="card">
              <div class="card-body">
                <table class="table mb-0 table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Power (watt)</th>
                      <th scope="col">Power (BTU/hr)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1 W</td>
                      <td>3.412142 BTU/hr</td>
                    </tr>
                    <tr>
                        <td>10 W</td>
                        <td>34.121416 BTU/hr</td>
                      </tr>
                    <tr>
                        <td>100 W</td>
                        <td>341.214163 BTU/hr</td>
                      </tr>
                    <tr>
                        <td>1000 W</td>
                        <td>3412.141633 BTU/hr</td>
                      </tr>
                    <tr>
                        <td>10000 W</td>
                        <td>34121.416330 BTU/hr</td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <h6>Cara konversi watt ke btu/hr</h6>
                <hr>
                <p>Daya P dalam BTU per jam (BTU/jam) sama dengan 3.412141633 kali daya P dalam watt (W):</p>
                <p>P(BTU/hr) = 3.412141633 × P(W)</p>
                <p>Jadi</p>
                <p>1 Watt = 3.412141633 BTU/hr</p>
                <br>
                <br>
                <p>Contoh:</p>
                <p>P(BTU/hr) = 3.412141633 x 5000W = 17060.71 BTU/hr</p>
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
         return x*3.412141633;
    }
</script>

@endsection
