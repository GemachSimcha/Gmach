
$( function() {
   // $( ".datepicker" ).datepicker($.datepicker.regional["he"]);
   $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
   $( "#datepick1" ).datepicker("setDate", new Date());

   //hide spinner
   // $( "#editing-view-port" ).hide();

// Hover states on the static widgets
$( "#dialog-link, #icons li" ).hover(
    function() {
        $( this ).addClass( "ui-state-hover" );
    },
    function() {
        $( this ).removeClass( "ui-state-hover" );
    }
);
} );
