


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

        /*   currency exchange   */
// hide and show
$("#currency-form").hide();
$("#show-currency-form").click(function(){
  $("#currency-form").show();
});

/* handling currency form validation */
$("#currency-form").validate({
  rules: {
    amount: {
      required: true,
    },
  },
  messages: {
    amount:{
      required: ""
     },     
  },
  submitHandler: submitForm 
});    
/* Handling login functionality */
function submitForm() {   
  var data = $("#currency-form").serialize();       
  $.ajax({        
    type : 'POST',
    url  : 'includes/convert.php',
    dataType:'json',
    data : data,
    beforeSend: function(){ 
      $("#convert").html('<h6>מחשבן</h6>');
    },
    success : function(response){
      if(response.error == 1){  
        $("#converted_rate").html('<span class="form-group has-error">Error: Please select different currency</span>'); 
        $("#converted_amount").html("");
        $("#convert").html('Convert');
        $("#converted_rate").show();   
      } else if(response.rate){                 
        $("#converted_rate").html("<strong>Exchange Rate ("+response.to_Currency+"</strong>) : "+response.rate);
        $("#converted_rate").show();
        $("#converted_amount").html("<strong>הסכום ב"+response.to_Currency+" שווה</strong>  : "+response.converted_amount);
        $("#converted_amount").show();
        $("#convert").html('Convert');
      } else {  
        $("#converted_rate").html("No Result"); 
        $("#converted_rate").show();  
        $("#converted_amount").html("");
      }
    }
  });
  return false;
}


});

  


