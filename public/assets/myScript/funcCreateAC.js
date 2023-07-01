addEventListener('change', function(){
    const st = document.querySelector('#status').value;

    if(st == 'Rusak'){
        document.querySelector('#kerusakan').required = true;
        $('#kerusakan').show(1000);  
        $('#labelKerusakan').show(1000);
        $('#colKeterangan').removeClass('col-12');
    }else if(st == 'Progres'){
        document.querySelector('#kerusakan').required = true;
        $('#kerusakan').show(1000);  
        $('#colKeterangan').removeClass('col-12');
        $('#labelKerusakan').show(1000);
        document.querySelector('#catatan').required = true;
    }else{
        document.querySelector('#kerusakan').required = false;        
        $('#kerusakan').hide(1000);
        $('#kerusakan').val("");
        $('#labelKerusakan').hide(1000);
        $('#colKeterangan').addClass('col-12');

        document.querySelector('#catatan').required = false;
    }
});


$('#wing').on('click', function() {
    const wing = $(this).val();
    let cardLantai = '';
    if(wing == 'WA' || wing == 'WB'){
        cardLantai += wingAB();
        $('.optLantai').html(cardLantai);
    }else if(wing == 'WC' || wing == 'WD'){
        cardLantai += wingCD();
        $('.optLantai').html(cardLantai);
    }else{
        cardLantai += wingLainnya();
        $('.optLantai').html(cardLantai);
    }
});

function wingAB() {
  return `<label for="lantai" class="form-label">Lantai <span               class="text-danger">*</span></label>
        <select class="form-select" id="lantai" required name="lantai">
            <option value="Lt1">Lt1</option>
            <option value="Lt2">Lt2</option>
            <option value="Lt3">Lt3</option>                
        </select>`;
}
function wingCD() {
    return `<label for="lantai" class="form-label">Lantai <span               class="text-danger">*</span></label>
          <select class="form-select" id="lantai" required name="lantai">
              <option value="Lt1">Lt1</option>
              <option value="Lt2">Lt2</option>                              
          </select>`;
}
function wingLainnya() {
    return `<label for="lantai" class="form-label">Lantai <span               class="text-danger">*</span></label>
          <select class="form-select" id="lantai" required name="lantai">
              <option value="Lt1">Lt1</option>                                          
          </select>`;
}


$('#jenis').on('click', function() {
    const jenis = $(this).val();
    let cardRefri = '';
    if(jenis == 'Inverter'){
        cardRefri += funcInverter();
        $('.optRefrigerant').html(cardRefri);
    }else{
        cardRefri += funcNonInverter();
        $('.optRefrigerant').html(cardRefri);
    }
});

function funcInverter(){
    return `<label for="refrigerant" class="form-label">Refrigerant <span class="text-danger">*</span></label>
    <select class="form-select" id="refrigerant" required name="refrigerant">        
        <option value="R32">R32</option>
        <option value="R410">R410</option>
    </select>`;
}

function funcNonInverter(){
    return `<label for="refrigerant" class="form-label">Refrigerant <span class="text-danger">*</span></label>
    <select class="form-select" id="refrigerant" required name="refrigerant">        
        <option value="R22">R22</option>
        <option value="R32">R32</option>
        <option value="R410">R410</option>
    </select>`;
}