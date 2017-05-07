<?php
include_once("includes/inserts.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="includes/styles/bootstrap.min.css">
    <link href="includes/styles/styles.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="includes/js/jquery-ui-calendar/jquery-ui.css">
	<title>גמ"ח חסדי השם</title>

</head>
<body>
<div class="container">
<div class="row">
  <section class="col-xs-12">

   <div class="row">
     <div class="jumbotron text-center col-xs-10 pull-right">
      <h1>גמ"ח חסדי השם</h1>
      <h3>יתרתך להיום הוא: <?php if ($balanc['balance']) { echo $balanc['balance'];} else { echo "0";}  ?> ש"ח</h3>
     </div>

     <div class="col-xs-2">
     	<button class="btn btn-success btn-lg" id="show-currency-form">חישוב מט"ח</button>
        <form method="post" id="currency-form" >     
          <div class="form-group">
          	</br></br>
            <input type="text" placeholder="Currency" name="amount" id="amount" placeholder="סכום" />
             </br>
              <label>מ</label>
              <select name="from_currency">
                <option value="USD" selected="1">דולר ארה"ב ($)</option>
                <option value="ILS">שקל (₪)</option>
                <option value="EUR">אירו (€)</option>
                <option value="GBP">שטרלינג אנגלי (£)</option>
              </select> 
              </br>     
              &nbsp;<label>ל</label>
              <select name="to_currency">
                <option value="ILS" selected="1">שקל (₪)</option>
                <option value="USD">דולר ארה"ב ($)</option>
                <option value="EUR">אירו (€)</option>
                <option value="GBP">שטרלינג אנגלי (£)</option>
              </select>     
              &nbsp;&nbsp;<button type="submit" value="1" name="convert" id="convert" class="btn btn-default btn-sml">חשב</button> 
         </form>
         </div>       
         <h5 id="converted_amount"></h5>        
     </div>
    </div>