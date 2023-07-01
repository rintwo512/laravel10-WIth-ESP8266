@extends('layout.main')

@section('content')
    <div class="container-fluid">
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body">
                  <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                      <p class="mb-0">Masukkan jumlah fasa, arus dalam ampere, tegangan dalam volt dan tekan tombol Calculate</p>
                    </div>
                    <hr/>
                    <form name="calcform" autocomplete="off">
                        <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Select Phase</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="phase" autofocus>
                            <option>Single phase</option>
                            <option>Three phase</option>
                        </select>
                        </div>
                        <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Enter amps (A):</label>
                        <div class="col-sm-9">
                            <input type="number" min="1" step="any" name="x1" class="form-control intext">
                        </div>
                        </div>
                        <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Enter line to line volts (V):</label>
                        <div class="col-sm-9">
                            <input type="number" min="1" step="any" name="x2" class="form-control intext">
                        </div>
                        </div>
                        <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Result (VA):</label>
                        <div class="col-sm-9">
                            <input type="text" name="y" class="form-control outtext" readonly>
                        </div>
                        </div>
                        <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-4">
                            <button onclick="calc3()" type="button" class="btn btn-purple px-5">Calculate</button>
                        </div>
                        <div class="col-sm-4">
                            <button onclick="setfocus()" type="reset" class="btn btn-secondary px-5">Reset</button>
                        </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                    <h5>Rumus 1 Phase</h5>
                    <hr>
                    <p>Daya nyata S dalam volt-amp sama dengan arus I dalam ampere, dikalikan dengan tegangan V dalam volt :</p>
                    <p>S(VA) = I(A) × V(V)</p>
                    <br>
                    <h5>Rumus 3 Phase</h5>
                    <hr>
                    <p>Daya nyata S dalam kilovolt-amp sama dengan akar kuadrat jika 3 arus I dalam ampere, dikalikan tegangan line to line VL-L dalam volt:</p>
                    <p>S(VA) = √3 × I(A) × VL-L(V)  = 3 × I(A) × VL-N(V)</p>
                </div>
              </div>
        </div>
    </div>
<script>


    function calc3(){
        x1=document.calcform.x1.value;
        x2=document.calcform.x2.value;
        y=convert(x1,x2);
        y=roundresult(y);
        document.calcform.y.value=y;
    }



    function isFloat(n){

        return Number(n) === n && n % 1 !== 0 ;

    }
    function roundresult(x){

        y=parseFloat(x);
        y=roundnum(y,10);
        return y;

    }

    function roundnum(x,p){

        var i;
        var n = parseFloat(x);
        var m = n.toPrecision( p + 1 );
        var y = String(m);
        i = y.indexOf('e');

        if( i == -1 ) i = y.length;
        j = y.indexOf('.');
        if( i > j && j != -1 ){
            while(i>0)
                { if( y.charAt(--i) == '0')
                    y=removeAt(y,i);
                  else
                    break; }
                  if( y.charAt(i) == '.')
                    y=removeAt(y,i);}
                        return y;
                    }
    function removeAt(s,i){

        s=s.substring(0,i)+s.substring(i+1,s.length);
        return s;

        }
</script>

<script>
    function convert(x1,x2) {
        var iphase = document.calcform.phase.selectedIndex;
        var kva = x1 * x2;
        if( iphase == 1 )
             kva *= Math.sqrt(3);
         return kva;
    }
</script>
@endsection
