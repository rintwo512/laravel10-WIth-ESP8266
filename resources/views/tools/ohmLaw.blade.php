@extends('layout.main')

@section('content')

        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                  <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                      <p class="mb-0">Masukkan 2 nilai untuk mendapatkan nilai lainnya dan tekan tombol logo kalkulator :</p>
                    </div>
                    <hr/>
                    <form id="calcform" name="calcform" autocomplete="off">
                        <div class="form-group row mt-2">
                        <label for="v" class="col-sm-3 col-form-label">Voltage (<i>V</i>)</label>
                        <div class="input-group col-sm-9">
                        <input type="text" id="v" name="v" onclick="ondata(this)" onkeyup="ondata(this)" autofocus class="form-control">
                        <div class="input-group-append">
                        <select id="cv" name="cv" class="form-control">
                        <option>microvolts (&mu;V)</option>
                        <option>millivolts (mV)</option>
                        <option selected>volts (V)</option>
                        <option>kilovolts (kV)</option>
                        <option>megavolts (MV)</option>
                        </select>
                        </div>
                        </div>
                        </div>
                        <div class="form-group row mt-2">
                        <label for="i" class="col-sm-3 col-form-label">Current (<i>I</i>)</label>
                        <div class="input-group col-sm-9">
                        <input type="text" id="i" name="i" onclick="ondata(this)" onkeyup="ondata(this)" class="form-control">
                        <div class="input-group-append">
                        <select id="ci" name="ci" class="form-control">
                        <option>microamps (&mu;A)</option>
                        <option>milliamps (mA)</option>
                        <option selected>amps (A)</option>
                        <option>kiloamps (kA)</option>
                        <option>megaamps (MA)</option>
                        </select>
                        </div>
                        </div>
                        </div>
                        <div class="form-group row mt-2">
                        <label for="r" class="col-sm-3 col-form-label">Resistance (<i>R</i>)</label>
                        <div class="input-group col-sm-9">
                        <input type="text" id="r" name="r" onclick="ondata(this)" onkeyup="ondata(this)" class="form-control">
                        <div class="input-group-append">

                        <select id="cr" name="cr" class="form-control">
                        <option selected>ohms (&Omega;)</option>
                        <option>kiloohms (k&Omega;)</option>
                        <option>megaohms (M&Omega;)</option>
                        </select>
                        </div>
                        </div>
                        </div>
                        <div class="form-group row mt-2">
                        <label for="p" class="col-sm-3 col-form-label">Power (<i>P</i>)</label>
                        <div class="input-group col-sm-9">
                        <input type="text" id="p" name="p" onclick="ondata(this)" onkeyup="ondata(this)" class="form-control">
                        <div class="input-group-append">
                        <select id="cp" name="cp" class="form-control">
                        <option>microwatts (&mu;W)</option>
                        <option>milliwatts (mW)</option>
                        <option selected>watts (W)</option>
                        <option>kilowatts (kW)</option>
                        <option>megawatts (MW)</option>
                        </select>
                        </div>
                        </div>
                        </div>
                        <div class="col mt-2">
                            <div class="btn-group">
                              <button type="button" name="bcalc" title="Calculate" class="btn btn-purple" onclick="oncalc()" disabled="disabled"><i class="bi bi-calculator"></i></button>
                              <button type="reset" title="Reset" class="btn btn-secondary ml-1" onclick="onbtnreset()"><i class="bi bi-x-circle"></i></button>
                            </div>
                          </div>
                          <div class="col mt-2">
                        <div id="caldiv" class="form-group row">
                        <label class="col-sm-3 col-form-label">Calculation</label>
                        <div id="calwrap" class="col-sm-9">
                        <div id="cal" class="form-control mt-2"></div>
                        </div>
                        </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="card">
               <div class="card-body">
                  <h6>Rumus perhitungan hukum Ohm</h6>
                  <hr>
                  <p>Arus I dalam ampere (A) sama dengan tegangan V dalam volt (V) dibagi dengan resistansi R dalam ohm (Ω):</p>
                  <p>I = V / R</p>
                  <p>Contoh :</p>
                  <p>I = 20V / 10Ω = 2A</p>
                  <br>
                  <br>
                  <p>Daya P dalam watt (W) sama dengan tegangan V dalam volt (V) dikalikan arus I dalam ampere (A):</p>
                  <p>P = V × I</p>
                  <p>Contoh :</p>
                  <p>P = 20V × 2A = 40W</p>
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
   var prevIndex =["0","2","2","2"];
var prevIndex2=["0","2","0","0"];
var rctl=document.getElementById("r");
var ictl=document.getElementById("i");
var vctl=document.getElementById("v");
var pctl=document.getElementById("p");
var crctl=document.getElementById("cr");
var cictl=document.getElementById("ci");
var cvctl=document.getElementById("cv");
var cpctl=document.getElementById("cp");
window.onload = function() {
   document.getElementById("calcform").onkeypress = function(e) { if( e.keyCode==13 ) oncalc(); };
   document.getElementById("calcform2").onkeypress = function(e) { if( e.keyCode==13 ) oncalc2(); };
};

window.addEventListener("DOMContentLoaded",function() {

   var params=GetURLParams();
   if( Object.keys(params).length>0 ) {
      var r=str2num(decodeURIComponent(params.r));
      var i=str2num(decodeURIComponent(params.i));
      var v=str2num(decodeURIComponent(params.v));
      var p=str2num(decodeURIComponent(params.p));
      var cr=decodeURIComponent(params.cr);
      var ci=decodeURIComponent(params.ci);
      var cv=decodeURIComponent(params.cv);
      var cp=decodeURIComponent(params.cp);
      rctl.value = r;
      ictl.value = i;
      vctl.value = v;
      pctl.value = p;
      setSelectIndex(crctl,cr);
      setSelectIndex(cictl,ci);
      setSelectIndex(cvctl,cv);
      setSelectIndex(cpctl,cp);
      oncalc();
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
function setSelectIndex(elem,val) {
   val=val.replace("+"," ");
   for(var i=0; i<elem.options.length; i++) {
      if( elem.options[i].text==val ) {
         elem.selectedIndex=i;
         break;
      }
   }
}
function onbtnreset() {
   document.calcform.v.focus();
   document.calcform.bcalc.disabled=true;
   var caldivctl=document.getElementById("caldiv");
   caldivctl.style.display="none";
}
function onbtnreset2() {
   //document.calcform2.z.focus();
   document.calcform2.bcalc2.disabled=true;
}
function ondata(obj) {
   var r = document.calcform.r.value;
   var i = document.calcform.i.value;
   var v = document.calcform.v.value;
   var p = document.calcform.p.value;
   count = 0;
   if( r!="" ) count++;
   if( i!="" ) count++;
   if( v!="" ) count++;
   if( p!="" ) count++;
   if( count!=2 )
      document.calcform.bcalc.disabled=true;
   else
      document.calcform.bcalc.disabled=false;
}
function onselchange(sel, i) {
   if( i==0 ) txt=document.calcform.r;
   else if( i==1 ) txt=document.calcform.i;
   else if( i==2 ) txt=document.calcform.v;
   else if( i==3 ) txt=document.calcform.p;
   if( txt.value=='' ) return;
   di = sel.selectedIndex-prevIndex[i];
   txt.value = roundnum(txt.value/Math.pow(1000, di), 8);
   prevIndex[i] = sel.selectedIndex;
}
function oncalc() {
   var txt;
   var rctl=document.getElementById("r");
   var ictl=document.getElementById("i");
   var vctl=document.getElementById("v");
   var pctl=document.getElementById("p");
   var crctl=document.getElementById("cr");
   var cictl=document.getElementById("ci");
   var cvctl=document.getElementById("cv");
   var cpctl=document.getElementById("cp");
   var calctl=document.getElementById("cal");
   var caldivctl=document.getElementById("caldiv");
   var fr = Math.pow(10,3*crctl.selectedIndex);
   var fi = Math.pow(10,3*cictl.selectedIndex-6);
   var fv = Math.pow(10,3*cvctl.selectedIndex-6);
   var fp = Math.pow(10,3*cpctl.selectedIndex-6);
   var r0 = roundnum(str2num(rctl.value),6);
   var i0 = roundnum(str2num(ictl.value),6);
   var v0 = roundnum(str2num(vctl.value),6);
   var p0 = roundnum(str2num(pctl.value),6);
   var r = roundnum(r0*fr,6);
   var i = roundnum(i0*fi,6);
   var v = roundnum(v0*fv,6);
   var p = roundnum(p0*fp,6);
   if( r<0 ) { alert("Please enter positive resistance value!"); return; }
   if( p<0 ) { alert("Please enter positive power value!"); return; }
   var cr,ci,cv,cp;
   var cr=ci=cv=cp='';
   //if( r!="" && v!="" ) {
   if( r!=0 && v!=0 ) {
      i=roundnum(v/r,6); roundnum(p=v*i,6);
      if( crctl.selectedIndex!=0 ) cr="&times;10<sup>"+(3*crctl.selectedIndex)+"</sup>";
      if( cvctl.selectedIndex!=2 ) cv="&times;10<sup>"+(3*(cvctl.selectedIndex-2))+"</sup>";
      txt = "<i>I = V / R</i> = "+v0+cv+"V / "+r0+cr+"&Omega; = "+i+"A<br>";
      txt+= "<i>P = V&times;I</i> = "+v0+cv+"V&times;"+i+"A = "+p+"W<br>";
   }
   //else if( r!="" && i!="" ) {
   else if( r!=0 && i!=0 ) {
      v=roundnum(i*r,6); p=roundnum(v*i,6);
      if( crctl.selectedIndex!=0 ) cr="&times;10<sup>"+(3*crctl.selectedIndex)+"</sup>";
      if( cictl.selectedIndex!=2 ) ci="&times;10<sup>"+(3*(cictl.selectedIndex-2))+"</sup>";
     txt = "<i>V = I&times;R</i> = "+i0+ci+"A&times;"+r0+cr+"&Omega; = "+v+"V<br>";
      txt+= "<i>P = V&times;I</i> = "+v+"V&times;"+i0+ci+"A = "+p+"W<br>";
   }
   //else if( r!="" && p!="" ) {
   else if( r!=0 && p!=0 ) {
      v=roundnum(Math.sqrt(p*r),6); i=roundnum(p/v,6);
      if( crctl.selectedIndex!=0 ) cr="&times;10<sup>"+(3*crctl.selectedIndex)+"</sup>";
      if( cpctl.selectedIndex!=2 ) cp="&times;10<sup>"+(3*(cpctl.selectedIndex-2))+"</sup>";
      txt = "<i>V</i> = \u221A(<i>P&times;R</i>) = \u221A("+p0+cp+"W&times;"+r0+cr+"&Omega;) = "+v+"V<br>";
      txt+= "<i>I = P / V</i> = "+p0+cp+"W / "+v+"V = "+i+"A<br>";
   }
   //else if( i!="" && v!="" ) {
   else if( i!=0 && v!=0 ) {
      r=roundnum(v/i,6); p=roundnum(v*i,6);
      if( cictl.selectedIndex!=2 ) ci="&times;10<sup>"+(3*(cictl.selectedIndex-2))+"</sup>";
      if( cvctl.selectedIndex!=2 ) cv="&times;10<sup>"+(3*(cvctl.selectedIndex-2))+"</sup>";
      txt = "<i>R = V / I</i> = "+v0+cv+"V / "+i0+ci+"A = "+r+"&Omega;<br>";
      txt+= "<i>P = V&times;I</i> = "+v0+cv+"V&times;"+i0+ci+"A = "+p+"W<br>";
   }
   //else if( i!="" && p!="" ) {
   else if( i!=0 && p!=0 ) {
      v=roundnum(p/i,6); r=roundnum(v/i,6);
      if( cictl.selectedIndex!=2 ) ci="&times;10<sup>"+(3*(cictl.selectedIndex-2))+"</sup>";
      if( cpctl.selectedIndex!=2 ) cp="&times;10<sup>"+(3*(cpctl.selectedIndex-2))+"</sup>";
      txt = "<i>V = P / I</i> = "+p0+cp+"W / "+i0+ci+"A = "+v+"V<br>";
      txt+= "<i>R = V / I</i> = "+v+"V/"+i0+ci+"A = "+r+"&Omega;<br>";
   }
   //else if( v!="" && p!="" ) {
   else if( v!=0 && p!=0 ) {
      i=roundnum(p/v,6); r=roundnum(v/i,6);
      if( cvctl.selectedIndex!=2 ) cv="&times;10<sup>"+(3*(cvctl.selectedIndex-2))+"</sup>";
      if( cpctl.selectedIndex!=2 ) cp="&times;10<sup>"+(3*(cpctl.selectedIndex-2))+"</sup>";
      txt = "<i>I = P / V</i> = "+p0+cp+"W / "+v0+cv+"V = "+i+"A<br>";
      txt+= "<i>R = V / I</i> = "+v0+cv+"V / "+i+"A = "+r+"&Omega;<br>";
   }
   r /= fr;
   i /= fi;
   v /= fv;
   p /= fp;
   rctl.value = roundnum(r,6);
   ictl.value = roundnum(i,6);
   vctl.value = roundnum(v,6);
   pctl.value = roundnum(p,6);
   calctl.innerHTML = txt;
   caldivctl.style.display="flex";
}
function ondata2(obj) {
   z = document.calcform2.z.value;
   i = document.calcform2.i2.value;
   v = document.calcform2.v2.value;
   s = document.calcform2.s.value;
   zdeg = document.calcform2.zdeg.value;
   ideg = document.calcform2.ideg.value;
   vdeg = document.calcform2.vdeg.value;
   sdeg = document.calcform2.sdeg.value;
   zcar = document.calcform2.z_car.value;
   scar = document.calcform2.s_car.value;
   count = 0;
   if( (z!="" && zdeg!="" ) || zcar!="" ) count++;
   if( i!=""  && ideg!="" ) count++;
   if( v!=""  && vdeg!="" ) count++;
   if( (s!="" && sdeg!="" ) || sdeg!="" ) count++;
   if( count<2 )
      document.calcform2.bcalc2.disabled=true;
   else
      document.calcform2.bcalc2.disabled=false;
}
function onselchange2(sel, i) {
   if( i==0 ) txt=document.calcform2.z;
   else if( i==1 ) txt=document.calcform2.i2;
   else if( i==2 ) txt=document.calcform2.v2;
   else if( i==3 ) txt=document.calcform2.s;
   if( txt.value=='' ) return;
   di = sel.selectedIndex-prevIndex2[i];
   txt.value = roundnum(txt.value/Math.pow(1000, di), 8);
   prevIndex2[i] = sel.selectedIndex;
}
function oncalc2() {
   fz = Math.pow(10,3*document.calcform2.cz.selectedIndex);
   fi = Math.pow(10,3*document.calcform2.ci2.selectedIndex-6);
   fv = Math.pow(10,3*document.calcform2.cv2.selectedIndex);
   fs = Math.pow(10,3*document.calcform2.cs.selectedIndex);
   z = fz*document.calcform2.z.value;
   i = fi*document.calcform2.i2.value;
   v = fv*document.calcform2.v2.value;
   s = fs*document.calcform2.s.value;
   zdeg = document.calcform2.zdeg.value;
   ideg = document.calcform2.ideg.value;
   vdeg = document.calcform2.vdeg.value;
   sdeg = document.calcform2.sdeg.value;
   _zdeg = parseFloat(zdeg);
   _ideg = parseFloat(ideg);
   _vdeg = parseFloat(vdeg);
   _sdeg = parseFloat(sdeg);
   if( z!="" && v!="" && zdeg!="" && vdeg!="" ) {i=v/z; s=v*i; ideg=_vdeg-_zdeg; sdeg=_zdeg; }
   else if( z!="" && i!="" && zdeg!="" && ideg!="" ) {v=i*z; s=v*i; vdeg=_zdeg+_ideg; sdeg=_zdeg; }
   else if( z!="" && s!="" && zdeg!="" && sdeg!="" ) {v=Math.sqrt(s*z); i=s/v; vdeg=(_sdeg+_zdeg)/2; ideg=_sdeg-vdeg; }
   else if( i!="" && v!="" && ideg!="" && vdeg!="" ) {z=v/i; s=v*i; zdeg=_vdeg-_ideg; sdeg=zdeg;}
   else if( i!="" && s!="" && ideg!="" && sdeg!="" ) {v=s/i; z=v/i; zdeg=_sdeg; vdeg=zdeg+_ideg; }
   else if( v!="" && s!="" && vdeg!="" && sdeg!="" ) {i=s/v; z=v/i; zdeg=_sdeg; ideg=_vdeg-zdeg; }
   z /= fz;
   i /= fi;
   v /= fv;
   s /= fs;
   document.calcform2.z.value  = roundnum(z,8);
   document.calcform2.i2.value = roundnum(i,8);
   document.calcform2.v2.value = roundnum(v,8);
   document.calcform2.s.value  = roundnum(s,8);
   document.calcform2.zdeg.value = roundnum(zdeg,5);
   document.calcform2.ideg.value = roundnum(ideg,5);
   document.calcform2.vdeg.value = roundnum(vdeg,5);
   document.calcform2.sdeg.value = roundnum(sdeg,5);

   if( document.calcform2.z_car.value=='' ) oncalccart(0);
   if( document.calcform2.s_car.value=='' ) oncalccart(1);
}
function oncalccart(ix)
{
   if( ix==0 )
   {
      r = document.calcform2.z.value;
      ang = document.calcform2.zdeg.value;
   }
   else
   {
      r = document.calcform2.s.value
      ang = document.calcform2.sdeg.value;
   }

   if( r=='' || ang=='' ) return;

   ang = ang/180*Math.PI;
   x = r*Math.cos(ang);
   y = r*Math.sin(ang);
   if( y<0 ) { y=-y; sign='-'; } else sign='+';
   x = x.toFixed(2);
   y = y.toFixed(2);
   p = x+sign+'j'+y;

   if( ix==0 )
      document.calcform2.z_car.value = p;
   else
      document.calcform2.s_car.value = p;
}
function oncalcpolar(ix)
{
   if( ix==0 )
   {
      car = document.calcform2.z_car.value;
      c   = document.calcform2.cz.selectedIndex;
   }
   else
   {
      car = document.calcform2.s_car.value
      c   = document.calcform2.cs.selectedIndex;
   }

   if( car=='' ) return;
   i = car.indexOf('j');
   if( i==-1 ) car+='+j0';
   if( i==0  ) car='0+'+car;
   if( i==1  ) car='0'+car;

   len = car.length;
   i1 = car.indexOf('+');
   i2 = car.indexOf('-');
   i3 = car.indexOf(' ');
   if( i2==0 ) sign1=-1; else sign1=1;
   if( i1<1 ) i1=100;
   if( i2<1 ) i2=100;
   if( i3<1 ) i3=100;
   i = Math.min(i1,i2,i3);
   if( i==i2 ) sign2=-1; else sign2=1;
   x = car.substring(0,i);
   x = parseFloat(x);
   i = car.indexOf('j');
   y = car.substring(i+1,len);
   y = parseFloat(y);
   y*= sign2;
   mag = Math.sqrt(x*x+y*y);
   if( x!=0 )
      ang = Math.atan(y/x)*180/Math.PI;
   else
      ang = (y>0 ? 90 : (y<0 ? -90 : 0));
   if( sign1==-1 && ang!=0 )
   {
      if( ang>0 )
         ang-=180;
      else
         ang+=180;
   }

   mag /= Math.pow(10,(c*3));

   mag = mag.toFixed(2);
   ang = ang.toFixed(0);

   if( ix==0 )
   {
      document.calcform2.z.value = mag;
      document.calcform2.zdeg.value = ang;
   }
   else
   {
      document.calcform2.s.value = mag;
      document.calcform2.sdeg.value = ang;
   }
}
</script>

@endsection
