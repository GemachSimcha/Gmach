


$( function() {
   // $( ".datepicker" ).datepicker($.datepicker.regional["he"]);
   $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
   $( "#datepick1" ).datepicker("setDate", new Date());

   //hide spinner
   $( "#spin" ).hide();

// Hover states on the static widgets
$( "#dialog-link, #icons li" ).hover(
    function() {
        $( this ).addClass( "ui-state-hover" );
    },
    function() {
        $( this ).removeClass( "ui-state-hover" );
    }
);

$(document).ready(function () {
      // initialize stickyTableHeaders _after_ tablesorter
      $(".tablesorter").tablesorter();
      $("table").stickyTableHeaders();
    });

$('table').stickyTableHeaders();




} );
