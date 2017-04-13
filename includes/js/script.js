


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
$( "#NumberOfPayments,#selectedMethod,#monthlyDetails1,#monthlyDetails2,#specificiedDetails1,#specificiedDetails2" ).hide();
$( "#installments" ).change(function() {
  $( "#NumberOfPayments,#selectedMethod" ).toggle();
    $('input[type="radio"]').click(function() {
     if($(this).val() == 'monthly') {
        $( "#monthlyDetails1,#monthlyDetails2" ).toggle();
  };
      if ($(this).val() == 'specificied') {
        $("#specificiedDetails1").toggle();
/*        NEED TO CLONE #specificiedDetails2
*/        // $("#specificiedDetails2").
      }
});
});
  


} );
