@extends('layout.main')

@section('content')

        {{-- BTU/h --}}
    <h6 class="mb-0 text-uppercase">Kalkulator Cosine</h6>
    <hr/>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <p>Untuk menghitung cos (x) pada kalkulator:</p>
            <ol>
                <li>Masukkan sudut masukan.</li>
                <li>Pilih jenis sudut derajat (°) atau radian (rad) di kotak kombo.</li>
                <li>Tekan &nbsp;tombol Hitung untuk menghitung hasilnya.
                </li>
            </ol>
            <form name="calcform" autocomplete="off">
                <table class="calc">
                    <tbody>
                        <tr>
                            <td>
                                <input type="number" step="any" name="x" class="intext form-control" tabindex="1" placeholder="Cos">
                            </td>
                            <td>
                                <select id="degtype" class="form-select">
                                    <option selected>°</option>
                                    <option>rad </option>
                                </select>
                            </td>
                            {{-- <td>
                                <input type="button" value=" = " class="btn" onclick="calc()">
                            </td> --}}
                        </tr>
                        <tr>
                            <td colspan="4" class="pt-2">
                                <button type="button" title="Calculate" class="btn btn-purple" tabindex="2" onclick="calc()">Hitung</button>
                                <button type="reset" title="Reset" class="btn btn-secondary" tabindex="3" onclick="setfocus()">Reset</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">Hasil :</td>
                        </tr>
                        <tr>
                            <td colspan="4"><input type="text" name="y" class="outtext form-control" readonly tabindex="4"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
          </div>
          {{-- Kalkulator btu --}}
          <div class="col-md-6">
            <p>Masukkan nilai cosinus, pilih derajat (°) atau radian (rad) dan tekan tombol Hitung :</p>
            <form name="calcform2">
                <table class="calc">
                    <tbody>
                    <tr>
                        <td>
                            <label for=""><span>cos <sup style="font-size: 0.8em">-1</sup></span></label>
                            <input type="number" step="any" name="x" class="intext form-control" tabindex="5"></td>
                        <td>
                            {{-- <input onclick="calc_a()" type="button" value=" = " class="btn"></td> --}}
                    </tr>
                    <tr>
                        <td colspan="4" class="pt-2">
                            <button type="button" title="Calculate" class="btn btn-purple" tabindex="6" onclick="calc_a()">Hitung</button>
                            <button type="reset" title="Reset" class="btn btn-secondary" tabindex="7" onclick="setfocus()">Reset</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">Hasil :</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="y2" name="y" class="outtext form-control" tabindex="8">
                        </td>
                        <td colspan="4">

                            <select id="degtypea" class="mathsymbol form-select" onchange="OnSelChange()" name="D1">
                                <option selected>°</option>
                                <option>rad </option>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
          </div>
          {{-- end kalkulator btu --}}
        </div>
      </div>
    </div>
  {{-- End BTU/h --}}

  <script>

function setfocus(){
    document.calcform.x.focus();
}

function calc(){
    x = document.calcform.x.value;
    y = calcfunc(x);
    y = roundresult(y);
    document.calcform.y.value = y
}

function calc_a(){
    x = document.calcform2.x.value;
    y = calcfunc_a(x);
    y = roundresult(y);
    document.calcform2.y.value = y
}

function roundresult(x){
    y=parseFloat(x);
    y=roundnum(y,10);
    return y;
}

function roundnum(x,p){
    var i;
    var n=parseFloat(x);
    var m=n.toPrecision(p+1);
    var y=String(m);
    i=y.indexOf('e');
    if(i==-1)i=y.length;
        j=y.indexOf('.');
    if(i>j&&j!=-1){
        while( i > 0 ){
            if( y.charAt(--i)=='0')
              y = removeAt(y,i);
            else
        break;
        }
        if(y.charAt(i)=='.')
          y = removeAt(y,i);
    }
    return y;
}

function roundnum2(x,p){
    var i;
    var n=parseFloat(x);
    var m=n.toFixed(p);
    var y=String(m);
    i=y.length;
    j=y.indexOf('.');
    if(i>j&&j!=-1){
        while(i>0){
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

function removeAt(s,i){
    s=s.substring(0,i)+s.substring(i+1,s.length);
    return s;
}
var gcd = function(a,b){
    if(!b){
        return a;
    }
    return gcd(b,a%b);
};

  </script>

  <script>
    function calcfunc(x) {
        var degtype=document.getElementById("degtype");
        var i=degtype.selectedIndex;
        if( i==0 )
             x *= Math.PI/180;
         y = Math.cos(x);
         y = roundnum2(y,8);
         return y;
    }
    function calcfunc_a(x) {
        var degtype=document.getElementById("degtypea");
        var i=degtype.selectedIndex;
        var y=Math.acos(x);
        if( i==0 )
             y*=180/Math.PI;
         y = roundnum2(y,8);
         return y;
    }
    function OnSelChange()
    {
        calc_a();
    }
</script>
@endsection
