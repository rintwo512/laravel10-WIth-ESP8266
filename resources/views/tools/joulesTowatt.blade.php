@extends('layout.main')

@section('content')

        {{-- BTU/h --}}
    <h6 class="mb-0 text-uppercase">Joule ke watt kalkulator</h6>
    <hr/>
  <div class="col-xl-6 mx-auto">
    <div class="card">
      <div class="card-body">
        <div class="border p-3 rounded">
        <h6 class="mb-0 text-uppercase">Masukkan energi dalam joule, periode waktu dalam detik dan tekan tombol hitung :</h6>
        <hr/>
        <form class="row g-3" name="calcform">
          <div class="col-12">
            <label class="form-label">Masukkan energi dalam joule :</label>
            <input type="number" name="x1" class="intext form-control" placeholder="J">
          </div>
          <div class="col-12">
            <label class="form-label">Masukkan waktu dalam detik :</label>
            <input type="number" name="x2" class="intext form-control" placeholder="Detik">
          </div>
          <div class="col-6">
            <div class="d-grid">
              <button onclick="calc3()" type="button" class="btn btn-purple">Hitung</button>
            </div>
          </div>
          <div class="col-6">
            <div class="d-grid">
              <button onclick="setfocus()" type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </div>
          <div class="col-12">
            <label class="form-label">Hasil daya dalam watt:</label>
            <input type="number" name="y" class="outtext form-control" placeholder="Watt" readonly>
          </div>
        </form>
      </div>
      </div>
    </div>
    <h6 class="mb-0 text-uppercase">Rumus</h6>
            <hr/>
            <div class="card">
              <div class="card-body">
                <p>Daya P dalam watt (W) sama dengan energi E dalam joule (J), dibagi dengan periode waktu t dalam detik (s) :</p>
                <hr>
                <p>P(W) = E(J) / t(s)</p>
              </div>
            </div>
  </div>

  <script>
    function setfocus(){document.calcform.x.focus();}
function calc3(){x1=document.calcform.x1.value;x2=document.calcform.x2.value;y=convert(x1,x2);y=roundresult(y);document.calcform.y.value=y;}
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
    function convert(x1,x2) {
         return x1/x2;
    }
</script>



@endsection
