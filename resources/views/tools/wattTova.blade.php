@extends('layout.main')

@section('content')

    <div class="container-fluid">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                  <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                      <p class="mb-0">Masukkan daya nyata dalam watt dan faktor daya dan tekan tombol calculate untuk mendapatkan hasilnya</p>
                    </div>
                    <hr/>
                    <form name="calcform" autocomplete="off">
                        <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Enter watts:</label>
                        <div class="col-sm-9">
                            <input type="number" min="1" step="any" name="x1" class="form-control intext">
                        </div>
                        </div>
                        <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Enter power factor:</label>
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
                    <h6>Rumus :</h6>
                    <hr>
                    <p>Daya semu (S) dalam volt-amp (VA) sama dengan daya nyata P dalam watt (W), dibagi dengan faktor daya PF:</p>
                    <p>S(VA) =  P(W) / PF</p>
                </div>
              </div>
        </div>
    </div>
<script>

   function setfocus(){
       document.calcform.x.focus();
    }

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
            if( x2>1 || x2<0 )
            {
                alert('Enter power factor from 0 to 1');
                document.calcform.x2.value = '';
                return Number.NaN;
            }
            else
                 return x1/x2;
        }
</script>

@endsection
