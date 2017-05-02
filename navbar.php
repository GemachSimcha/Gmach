<div class="container">
<div class="row">
  <section class="col-xs-12">

     <div class="jumbotron text-center">
     	<h1>גמ"ח חסדי השם</h1>
     	<h3>יתרתך להיום הוא: <?php if ($balanc['balance']) { echo $balanc['balance'];} else { echo "0";}  ?> ש"ח</h3>
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
