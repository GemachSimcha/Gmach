


$( function() {
   $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
   $( "#datepick1, #repay_datepicker, #deposit_datepicker, #withdrawal_datepicker, #donation_datepicker" ).datepicker("setDate", new Date());

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
  $( "#NumberOfPayments,#selectedMethod,#monthlyDetails1,#monthlyDetails2,#repay1,#specificiedDetails" ).hide();
  $( "#installments" ).change(function() {
    $( "#NumberOfPayments,#selectedMethod" ).show();
    $('input[type="radio"]').click(function() {
      if($(this).val() == 'monthly') {
        $( "#monthlyDetails1,#monthlyDetails2" ).show();
      }
      if ($(this).val() == 'specificied') {
        $("#repay1,#specificiedDetails").show();
        // clone repayment fields, including datepicker
        var NumberOFPayments = $("#NumberOfPayments").val();
        for (var i = 1; i < NumberOFPayments; i++) {
          var $sd = $( 'tr[id^="repay"]:last' );
          var num = parseInt( $sd.prop("id").match(/\d+/g), 10 ) +1;
          var clone = $sd.clone();
          clone.attr('id', 'repay'+num );
          clone.find('input[name="installment_date"]').attr('id', 'datepickers'+num).removeClass('hasDatepicker');
          $sd.after(clone);
          $('input[id^="datepickers"]').each(function(){
            $(this).datepicker({ dateFormat: 'yy-mm-dd' });
          });
        }
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
          $("#convert").html('בוצע');
          $("#converted_rate").show();   
        } else if(response.rate){                 
          $("#converted_rate").html("<strong>Exchange Rate ("+response.to_Currency+"</strong>) : "+response.rate);
          $("#converted_rate").show();
          $("#converted_amount").html("<strong>הסכום ב"+response.to_Currency+" שווה</strong>  : "+response.converted_amount);
          $("#converted_amount").show();
          $("#convert").html('בוצע');
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

  


