<div class="container">
<div class="row">
  <section class="col-xs-12">

   <div class="row">
     <div class="jumbotron text-center col-xs-10 pull-right">
      <h1>גמ"ח חסדי השם</h1>
      <h3>יתרתך להיום הוא: <?php if ($balanc['balance']) { echo $balanc['balance'];} else { echo "0";}  ?> ש"ח</h3>
     </div>

     <div class="col-xs-2">
        <button class="btn-md" id="show-currency-form">חישוב מט"ח</button>
         <form method="post" id="currency-form" >     
          <div class="form-group">
           <h5>חישוב מט"ח</h5>
             &nbsp;<label>סכום</label> 
             <input type="text" placeholder="Currency" name="amount" id="amount" />
              <select name="from_currency">
                <option value="USD" selected="1">דולר ארה"ב ($)</option>
                <option value="ILS">שקל (₪)</option>
                <option value="EUR">אירו (€)</option>
                <option value="GBP">שטרלינג אנגלי (£)</option>
              </select> 
                   
              &nbsp;<label>To</label>
              <select name="to_currency">
                <option value="ILS" selected="1">שקל (₪)</option>
                <option value="USD">דולר ארה"ב ($)</option>
                <option value="EUR">אירו (€)</option>
                <option value="GBP">שטרלינג אנגלי (£)</option>
              </select>     
              &nbsp;&nbsp;<button type="submit" value="1" name="convert" id="convert" class="btn btn-default btn-sml">חשב</button> 
         </form>       
         <h5 id="converted_amount"></h5>        
     </div>
    </div>

<nav class="navbar clearfix">
    <div class="container-fluid">
      <div class="navbar-header navbar-right"><p class="navbar-brand">פעולות</p></div>
      <ul class="nav nav-tabs navbar navbar-right" role="tablist">
        <li role="presentation" class="active pull-right">
          <a role="tab" data-toggle="tab"
           href="#newloaner">הוסף לוה חדש</a>
        </li>
        <li role="presentation" class="pull-right">
          <a role="tab" data-toggle="tab"
           href="#oldLoaner">הלואה לרשום</a>
        </li>
        <li role="presentation" class="pull-right">
          <a role="tab" data-toggle="tab"
           href="#newDepositor">הוסף מפקיד חדש</a>
        </li>
        <li role="presentation" class="pull-right">
          <a role="tab" data-toggle="tab"
           href="#oldDepositor">פקדון לרשום</a>
        </li>
        <li role="presentation" class="pull-right">
          <a role="tab" data-toggle="tab"
           href="#donation">תרומה</a>
        </li>
      </ul>
      </div> <!-- container-fluid -->
