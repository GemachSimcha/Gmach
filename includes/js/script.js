


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
$( "#NumberOfPayments,#selectedMethod,#monthlyDetails1,#monthlyDetails2,#specificiedInstallment,#specificiedDetails" ).hide();
$( "#installments" ).change(function() {
  $( "#NumberOfPayments,#selectedMethod" ).show();
    $('input[type="radio"]').click(function() {
     if($(this).val() == 'monthly') {
        $( "#monthlyDetails1,#monthlyDetails2" ).show();
  }
      if ($(this).val() == 'specificied') {
        $("#specificiedInstallment,#specificiedDetails").show();


/*        NEED TO CLONE #specificiedDetails2
*/       
        var i;
        var id = $("#NumberOfPayments").val();;
        var $sd = $( "#specificiedInstallment" );
        var NumberOFPayments = $("#NumberOfPayments").val();
        for (var i = 1; i < NumberOFPayments; i++) {
          $( "#specificiedInstallment" ).after($sd.clone().attr('id', 'specificiedInstallment' + id));/*("datepick3").prop('id', 'datepick3' + id); */
            id--;
        
        }
        $( "#specificiedInstallment" ).attr('id', 'specificiedInstallment1');
              }
});
});

$( "#newloaner_modal" ).click(function(){
  $( "#myModal" ).modal({backdrop: "static"});
});



} );
