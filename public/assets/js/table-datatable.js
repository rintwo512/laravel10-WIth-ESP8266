$(function() {
	"use strict";

    $(document).ready(function() {
        $('#example').DataTable();
      } );
    
    $(document).ready(function() {
        $('#exampleUserUpdate').DataTable();
    } );

    $(document).ready(function() {
        $('#exampleUserUpdateCctvMonitor2').DataTable();
    } );

    $(document).ready(function() {
      $('#exampleUserUpdateCctvMonitor3').DataTable();
    });

  $(document).ready(function() {
    $('#exampleUserUpdateCctvMonitor4').DataTable();
  });
    
    $(document).ready(function() {
      $('#monitor2').DataTable();
    } );

    $(document).ready(function() {
      $('#monitor3').DataTable();
    } );

    $(document).ready(function() {
      $('#monitor4').DataTable();
    } );


      $(document).ready(function() {
        var table = $('#example2').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print']
        } );
     
        table.buttons().container()
            .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
    } );


});