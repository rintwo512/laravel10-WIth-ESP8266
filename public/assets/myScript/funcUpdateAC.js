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