


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
    });

// toggle monthly or specific installments
$( "installments" ).onchange = function() {
  $( "installments" ).append("<input type="number" name="NumberOfPayments" class="form-control" placeholder="מספר תשלומים" min="1" style="width: 31%">")};








} );
