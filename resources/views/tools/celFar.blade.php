@extends('layout.main')

@section('content')

        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                  <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                      <p class="mb-0">Konversi Celcius ke Fahrenheit</p>
                    </div>
                    <hr/>
                    <form name="calcform" autocomplete="off">
                        <div class="form-group">
                        <label>Celsius:</label>
                        <div class="input-group">
                        <input type="text" id="x" name="x" class="form-control intext" required autofocus>
                        <div class="input-group-append">
                            <span class="input-group-text">&deg;C</span>
                        </div>
                        </div>
                        </div>
                        <div class="form-group mt-2">
                            <button type="button" title="Convert" class="btn btn-primary" onclick="OnCalc()"><span class="bi bi-calculator"></span> Konversi</button>
                            <button type="reset" title="Reset" class="btn btn-secondary" ><span class="bi bi-x-circle"></span> Reset</button>
                        </div>
                        <div class="form-group mt-3">
                        <label>Fahrenheit:</label>
                        <div class="input-group">
                        <input type="text" id="y" class="form-control" readonly>
                        <div class="input-group-append">
                        <span class="input-group-text">&deg;F</span>
                        </div>
                        </div>
                        </div>
                        <div class="form-group mt-2">
                        <label>Calculation:</label>
                        <div class="input-group">
                            <textarea id="TA" class="form-control" readonly rows="3"></textarea>
                        </div>
                        </div>
                        <small id="ket"></small>
                    </form>
                  </div>
                </div>
              </div>
        </div>
<script>
function str2num(s)
{
   s=s.toString().trim().replace(/(\d)(\s+)(?=\d)/gm,"$1+").replace(/,(?=[^,]*$)/, '.').replace(/[^-()e\d/*+.]/g, '');
   if( s=='' ) return 0;
   return Function('"use strict";return ('+s+')')();
}
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
function roundnum2(x,p) {
	var i;
 	var n=parseFloat(x);
	var m=n.toFixed(p);
	var y=String(m);
	i=y.length;
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
var gcd = function(a, b) {
    if ( ! b) {
        return a;
    }
    return gcd(b, a % b);
};

</script>

<script>
   var xelem=document.getElementById("x");
   window.addEventListener("DOMContentLoaded",function() {
      xelem.onkeypress = function(e) { if( e.keyCode==13 ) OnCalc(); };
      var params=GetURLParams();
      if( Object.keys(params).length>0 && params.x!="" ) {
         document.title = params.x+" celsius to fahrenheit";
         //SetLinks(params);
         xelem.value = decodeURIComponent(params.x);
         OnCalc();
      }
   });

   function OnCalc() {
      var x = str2num(xelem.value);
      var y = (x*9/5+32.0);
      var yy=roundresult(y);
      var txt="(" + x +"\u00B0C x 9/5)" + " + 32\n";
      txt+="= "+yy+"\u00B0F";
      document.getElementById("y").value = yy;
      document.getElementById("TA").value = txt;
      document.querySelector('#ket').innerHTML = 'Suhu derajat Celcius (°C) dikalikan 9/5 ditambah 32';
   }
</script>

@endsection
