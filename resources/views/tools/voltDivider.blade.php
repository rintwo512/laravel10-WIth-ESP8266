@extends('layout.main')

@section('content')

        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                  <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                      <p class="mb-0">Masukkan 3 nilai untuk mendapatkan nilai ke-4:</p>
                    </div>
                    <hr/>
                    <form id="calcform" name="calcform" autocomplete="off">
                        <div class="form-group row mt-3">
                        <label for="vin" class="col-sm-4 col-form-label">Input voltage (V<sub>in</sub>)</label>
                        <div class="input-group col-sm-8">
                        <input type="number" min="0" step="any" id="vin" class="form-control" autofocus>
                        <div class="input-group-append">
                        <select id="vinsel" class="form-control">
                        <option>millivolts (mV)</option>
                        <option selected>volts (V)</option>
                        <option>kilovolts (kV)</option>
                        </select>
                        </div>
                        </div>
                        </div>
                        <div class="form-group row mt-3">
                        <label for="r1" class="col-sm-4 col-form-label">Resistance (R<sub>1</sub>)</label>
                        <div class="input-group col-sm-8">
                        <input type="number" min="0" step="any" id="r1" class="form-control">
                        <div class="input-group-append">
                        <select id="r1sel" onchange="onselchange(this,0);" class="form-control">
                        <option selected>ohms (&Omega;)</option>
                        <option>kiloohms (k&Omega;)</option>
                        <option>megaohms (M&Omega;)</option>
                        </select>
                        </div>
                        </div>
                        </div>
                        <div class="form-group row mt-3">
                        <label for="r2" class="col-sm-4 col-form-label">Resistance (R<sub>2</sub>)</label>
                        <div class="input-group col-sm-8">
                        <input type="number" min="0" step="any" id="r2" class="form-control">
                        <div class="input-group-append">
                        <select id="r2sel" onchange="onselchange(this,0);" class="form-control">
                        <option selected>ohms (&Omega;)</option>
                        <option>kiloohms (k&Omega;)</option>
                        <option>megaohms (M&Omega;)</option>
                        </select>
                        </div>
                        </div>
                        </div>
                        <div class="form-group row mt-3">
                        <label for="vout" class="col-sm-4 col-form-label">Output voltage (V<sub>out</sub>)</label>
                        <div class="input-group col-sm-8">
                        <input type="number" min="0" step="any" id="vout" class="form-control">
                        <div class="input-group-append">
                        <select id="voutsel" class="form-control">
                        <option>millivolts (mV)</option>
                        <option selected>volts (V)</option>
                        <option>kilovolts (kV)</option>
                        </select>
                        </div>
                        </div>
                        </div>
                        <div class="form-group row mt-3">
                        <div class="input-group col-sm-8">
                            <button type="button" class="btn btn-primary mr-1" onclick="calcA()"><i class="bi bi-calculator"></i></button>
                            <button type="reset" class="btn btn-secondary" onclick="setfocus()"><i class="bi bi-x-circle"></i></button>
                        </div>
                        </div>
                        <div class="col mt-3">
                            <div id="caldiv" class="form-group row">
                            <label class="col-sm-4 col-form-label">Calculation</label>
                            <div id="calwrap" class="col-sm-8">
                            <div id="cal" class="form-control mt-2" readonly></div>
                            </div>
                            </div>
                        </div>
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
    var vinElem  = document.getElementById("vin");
   var voutElem = document.getElementById("vout");
   var r1Elem = document.getElementById("r1");
   var r2Elem = document.getElementById("r2");
   var vinselElem  = document.getElementById("vinsel");
   var voutselElem = document.getElementById("voutsel");
   var r1selElem = document.getElementById("r1sel");
   var r2selElem = document.getElementById("r2sel");
   var calElem = document.getElementById("cal");
   var caldivElem=document.getElementById("caldiv");

   function setfocus() {
      vinElem.focus();
      caldivElem.style.display="none";
   }
   function calcA() {
      var vinsel = Math.pow(10,(3*vinselElem.selectedIndex-3));
      var voutsel = Math.pow(10,(3*voutselElem.selectedIndex-3));
      var r1sel = Math.pow(10,(3*r1selElem.selectedIndex));
      var r2sel = Math.pow(10,(3*r2selElem.selectedIndex));
      var vin = parseFloat(vinElem.value*vinsel);
      var vout = parseFloat(voutElem.value*voutsel);
      var r1 = parseFloat(r1Elem.value*r1sel);
      var r2 = parseFloat(r2Elem.value*r2sel);
      var txt="";
      if( vin!=0 && r1!=0 && r2!=0 && vout==0 ) {
         vout = vin*r2/(r1+r2);
         voutElem.value = roundresult(vout);
         txt = "<i>V</i><sub>out</sub> = <i>V</i><sub>in</sub> &times; <i>R</i><sub>2</sub> / (<i>R</i><sub>1</sub> + <i>R</i><sub>2</sub>)";
         txt+= "<br>= "+vin+"V &times; "+r2+"&Omega; / ("+r1+"&Omega;+"+r2+"&Omega;) <br>= "+voutElem.value+"V";
      }
      else if( vin!=0 && r1!=0 && r2==0 && vout!=0 ) {
         r2 = r1*vout/(vin-vout);
         r2Elem.value = roundresult(r2);
         txt = "<i>R</i><sub>2</sub> = <i>R</i><sub>1</sub> &times; <i>V</i><sub>out</sub> / (<i>V</i><sub>in</sub> - <i>V</i><sub>out</sub>)";
         txt+= "<br>= "+r1+"&Omega; &times; "+vout+"V / ("+vin+"V - "+vout+"V) <br>= "+r2Elem.value+"&Omega;";
      }
      else if( vin!=0 && r1==0 && r2!=0 && vout!=0 ) {
         r1 = r2*(vin-vout)/vout;
         r1Elem.value = roundresult(r1);
         txt = "<i>R</i><sub>1</sub> = <i>R</i><sub>2</sub> &times; (<i>V</i><sub>in</sub> - <i>V</i><sub>out</sub>) / <i>V</i><sub>out</sub>";
         txt+= "<br>= "+r2+"&Omega; &times; ("+vin+"V - "+vout+"V) / "+vout+"V<br>= "+r1Elem.value+"&Omega;";
      }
      else if( vin==0 && r1!=0 && r2!=0 && vout!=0 ) {
         vin = vout*(r1+r2)/r2;
         vinElem.value = roundresult(vin);
         txt = "<i>V</i><sub>in</sub> = <i>V</i><sub>out</sub> &times; (<i>R</i><sub>1</sub> + <i>R</i><sub>2</sub>) / <i>R</i><sub>2</sub>";
         txt+= "<br>= "+vout+"V &times; ("+r1+"&Omega; + "+r2+"&Omega;) / "+r2+"&Omega;<br>= "+vinElem.value+"V";
      }
      else {
         alert("Please enter 3 values!");
         return;
      }
      calElem.innerHTML = txt;
      caldivElem.style.display="flex";
   }
</script>

@endsection
