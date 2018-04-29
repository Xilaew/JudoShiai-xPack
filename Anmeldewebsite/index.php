<?php
require_once 'config.php';
require 'locale.php';
require 'lib.php';
$db=new SQLite3($judoShiaiTemplateFile);
$info=sqlite_getInfo($db);
$categories=sqlite_getCategories($db);
$db->close();
$fp=fopen($clubsTxt, "r");
$clubs=csv_getClubs($fp);
fclose($fp);
if (file_exists($dataCsv)){
  $fp=fopen($dataCsv, "r");
} else {
  $fp=fopen($dataCsv, "a");
}
$competitors=csv_getCompetitors($fp, getCoachId(true));
fclose($fp);
?><!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo($info->Competition);?></title>
  <link rel="stylesheet" type="text/css" href="http://www.hamburg-judo.de/typo3conf/ext/mc_foundation_template/Resources/Public/foundation-5.4.6/css/normalize.css?1412891670" media="all">
  <link rel="stylesheet" type="text/css" href="http://www.hamburg-judo.de/typo3conf/ext/mc_foundation_template/Resources/Public/foundation-5.4.6/css/foundation.css?1412891670" media="all">
  <link rel="stylesheet" type="text/css" href="http://www.hamburg-judo.de/fileadmin/template/Resources/Public/Css/app.css?1497456989" media="all">
  <link href="jquery-ui.min.css" rel="stylesheet">
  <script src="http://www.hamburg-judo.de/typo3conf/ext/mc_foundation_template/Resources/Public/foundation-5.4.6/js/vendor/modernizr.js?1412891670" type="text/javascript"></script>
  <style>
#competitor_table {
    border-collapse: collapse;
    width: 100%;
}

#competitor_table td, #competitor_table th {
    border: 0px;
    padding: .5em;
}

#competitor_table tr:nth-child(even){background-color: #f6f6f6;}

#competitor_table th {
    padding-top: .7em;
    padding-bottom: .7em;
    text-align: left;
    background-color: #c5c5c5;
    font-weight: bold;
}
#loading {
    display: inline-block;
}
  </style>
</head>
<body>
<div class="off-canvas-wrap" data-offcanvas="">
<div class="inner-wrap">
<aside class="left-off-canvas-menu">
		
			<!-- whatever you want goes here -->
			<ul><li><a href="http://www.hamburg-judo.de/aktuelles/">Aktuelles</a></li><li><a href="http://www.hamburg-judo.de/termine-ausschreibungen/">Termine &amp; Ausschreibungen</a></li><li><a href="http://www.hamburg-judo.de/der-hjv/gesch-vorstand/">Der HJV</a></li><li><a href="http://www.hamburg-judo.de/ressort/wettkampf-leistungssport/stuetzpunkttraining/">Ressort</a></li><li class="active"><a href="http://www.hamburg-judo.de/downloads/">Downloads</a></li><li><a href="http://www.hamburg-judo.de/kontakt/">Kontakt</a></li><li><a href="http://www.hamburg-judo.de/impressum/">Impressum</a></li></ul>
			
		</aside>
<nav class="tab-bar show-for-small-only">
			<section class="left-small">
				<a class="left-off-canvas-toggle menu-icon" href="#off-canvas-navigation"><span></span></a>
			</section>
			<section class="right tab-bar-section">
				<a href="http://www.hamburg-judo.de/">
					Hamburger Judo Verband e.V.
				</a>
			</section>
		</nav>
<header class="hide-for-small">
<img class="hide-for-small" src="http://www.hamburg-judo.de/typo3conf/ext/mc_foundation_template/Resources/Public/Images/header.jpg" width="100%">
</header>
<section class="top-menu-bar">
  <div class="row hide-for-small">
    <div class="small-12 large-12 columns">  
      <nav class="top-bar" data-topbar="" role="navigation">
        <ul class="title-area">
          <li class="name">
            <h1><a href="http://www.hamburg-judo.de/">HJV</a></h1>
          </li>
        </ul>
        
      <section class="top-bar-section">
          <!-- Left Nav Section -->
          <ul class="left"><li><a href="http://www.hamburg-judo.de/aktuelles/">Aktuelles</a></li><li class="active"><a href="http://www.hamburg-judo.de/termine-ausschreibungen/">Termine &amp; Ausschreibungen</a></li><li class="has-dropdown not-click"><a href="http://www.hamburg-judo.de/der-hjv/gesch-vorstand/">Der HJV</a><ul class="dropdown"><li class="title back js-generated"><h5><a href="javascript:void(0)">Back</a></h5></li><li class="parent-link show-for-small"><a class="parent-link js-generated" href="http://www.hamburg-judo.de/der-hjv/gesch-vorstand/">Der HJV</a></li><li><a href="http://www.hamburg-judo.de/der-hjv/gesch-vorstand/">gesch. Vorstand</a></li><li><a href="http://www.hamburg-judo.de/der-hjv/ehrenmitglieder/">Ehrenmitglieder</a></li><li><a href="http://www.hamburg-judo.de/der-hjv/vorstand/">Vorstand</a></li><li><a href="http://www.hamburg-judo.de/der-hjv/landestrainer/">Landestrainer</a></li><li><a href="http://www.hamburg-judo.de/der-hjv/beauftragte/">Beauftragte</a></li><li><a href="http://www.hamburg-judo.de/der-hjv/kassenpruefer/">Kassenprüfer</a></li><li><a href="http://www.hamburg-judo.de/der-hjv/rechtsausschuss/">Rechtsausschuss</a></li><li><a href="http://www.hamburg-judo.de/der-hjv/ehrenrat/">Ehrenrat</a></li><li><a href="http://www.hamburg-judo.de/der-hjv/ehrenliste/">Ehrenliste</a></li><li><a href="http://www.hamburg-judo.de/der-hjv/mitgliedsvereine/">Mitgliedsvereine</a></li><li><a href="http://www.hamburg-judo.de/der-hjv/leistungen-preise/">Leistungen &amp; Preise</a></li></ul></li><li class="has-dropdown not-click"><a href="http://www.hamburg-judo.de/ressort/wettkampf-leistungssport/stuetzpunkttraining/">Ressort</a><ul class="dropdown"><li class="title back js-generated"><h5><a href="javascript:void(0)">Back</a></h5></li><li class="parent-link show-for-small"><a class="parent-link js-generated" href="http://www.hamburg-judo.de/ressort/wettkampf-leistungssport/stuetzpunkttraining/">Ressort</a></li><li><a href="http://www.hamburg-judo.de/ressort/wettkampf-leistungssport/stuetzpunkttraining/">Wettkampf-/Leistungssport</a></li><li><a href="http://www.hamburg-judo.de/ressort/eliteschule-des-sports/">Eliteschule des Sports</a></li><li><a href="http://www.hamburg-judo.de/ressort/kampfrichter/">Kampfrichter</a></li><li><a href="http://www.hamburg-judo.de/ressort/lehr-und-pruefungswesen/">Lehr- und Prüfungswesen</a></li><li><a href="http://www.hamburg-judo.de/ressort/hamburg-liga/">Hamburg-Liga</a></li><li><a href="http://www.hamburg-judo.de/ressort/hamburger-judo-team/" target="_blank">Hamburger Judo Team</a></li><li><a href="http://www.hamburg-judo.de/ressort/foerderverein-judo-in-hamburg/" target="_blank">Förderverein Judo in Hamburg</a></li><li><a href="http://www.hamburg-judo.de/ressort/kyudo/">Kyudo</a></li><li><a href="http://www.hamburg-judo.de/ressort/kendo/">Kendo</a></li><li><a href="http://www.hamburg-judo.de/ressort/jiu-jitsu/">Jiu-Jitsu</a></li><li><a href="http://www.hamburg-judo.de/ressort/aikido/">Aikido</a></li></ul></li><li><a href="http://www.hamburg-judo.de/downloads/">Downloads</a></li><li><a href="http://www.hamburg-judo.de/kontakt/">Kontakt</a></li><li><a href="http://www.hamburg-judo.de/impressum/">Impressum</a></li></ul>
        </section></nav>
    </div>
  </div>
</section>
<header class="show-for-small-only">
<img class="show-for-small-only" src="http://www.hamburg-judo.de/typo3conf/ext/mc_foundation_template/Resources/Public/Images/header-small.jpg" width="100%">
</header>
<section id="main-content">
<h1><?php echo($info->Competition);?></h1>
<h1><?php echo($info->Date . " | " . $info->Place);?></h1>
  <h3><?php echo(_("Register new competitors:"));?></h3>
  <div>
    <div id="message" >
<?php if (count($competitors)>0 && getCoachId(false)==""){
  echo('      <div class="ui-widget"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><strong>' . _('Hint:') . ' </strong>' . _('In order to view and modify the entered competitors later on you should create a Coach Id (username).') . '</p></div></div>');
}?>
<?php if ($forceRegistration && getCoachId(false)==""){
  echo('      <div class="ui-widget"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p>' . _('Before you can register competitors you need to sign up by entering your email address as Coach Id. We use the email to keep you updated about any changes regarding the tournament. Further you can view and modify your competitors later on with this email/Coach Id as login.') . '</p></div></div>');
}?>
    </div>
    <form action="index.php" method="post" id="signUpForm" <?php if ($forceRegistration && getCoachId(false)==""){echo('style="display: none;"');}?>>
      <div><label for="input_firstName"><?php echo(_("First Name"));?> </label><input required name="firstName" id="input_fistName" type="text"></div>
      <div><label for="input_lastName"><?php echo(_("Last Name"));?> </label><input required name="lastName" id="input_lastName" type="text"></div>
      <div style="margin-bottom: 1rem;">
        <label for="input_yearOfBirth"><?php echo(_("Year of birth"));?> </label><input name="yearOfBirth" id="input_yearOfBirth" style="width: 100%; height: 100%; margin: 0;" type="number" required readonly value="<?php echo(floor(($minYearOfBirth+$maxYearOfBirth)/2));?>">
        <span style="margin-left:1em;" id="labelAgeCat"></span>
      </div>
      <div>
        <label for="radioset"><?php echo(_("Sex"));?> </label>
        <div  style="margin-bottom: 1rem;" id="radioset">
          <label for="input_male"><?php echo(_("male"));?></label><input id="input_male" required type="radio" name="sex" value="m">
          <label for="input_female"><?php echo(_("female"));?></label><input id="input_female" required type="radio" name="sex" value="f">
        </div>
      </div>
      <div><label for="input_weight"><?php echo(_("Weight Category"));?> </label>
      <select name="weight" id="input_weight">
        <option value=""><?php echo(_("Select year of birth and sex first."));?></option>
      </select></div>
      <div><label for="input_club"><?php echo(_("Club"));?> </label>
      <select name="club" required id="input_club">
        <option value=""><?php echo(_("Choose the competitor's club."));?></option>
<?php
foreach( $clubs as $club ){
  echo("        <option value=\"$club\">$club</option>\n");
}
?>
      </select></div>
      <div><input style="margin-bottom: 1rem;" name="register" type="submit" value="<?php echo(_('Register Competitor'));?>"><span id="loading" style="display:none;"><p><img src="loading.gif" /> <?php echo(_('please wait...'));?></p></span></div>
<!--      <div id="test-output" style="padding: .7em;"></div> -->
    </form>
  </div>
  <h3><?php echo(_("Already registered competitors:"));?></h3>
  <div>
    <div id="messageCoachId" >
    </div>
    <form id="coachIdForm">
      <div style="margin-bottom: 1rem;"><label for="input_coachId"><?php echo(_('Coach Id'));?> </label><input required name="coachId" id="input_coachId" type="text" value="<?php echo(getCoachId(false));?>"><input name="postCoachId" id="input_postCoachId" type="submit" value="<?php echo(_("Log-in / Register")); ?>" <?php if (getCoachId(false)!=''){echo('style="display:none;"');}?>><input name="delCoachId" id="input_delCoachId" type="submit" value="<?php echo(_('Log-out'));?>" <?php if (getCoachId(false)==''){echo('style="display:none;"');}?>><span id="loading_coachId" style="display:none;"><p><img src="loading.gif" /> <?php echo(_('please wait...'));?></p></span></div>
    </form>
  <table id="competitor_table">
    <tr><th><?php echo(_("Name"));?></th><th><?php echo(_("Year of birth"));?></th><th><?php echo(_("Sex"));?></th><th><?php echo(_("Category"));?></th><th><?php echo(_("Club"));?></th></tr>
<?php
foreach( $competitors as $competitor ){
  echo("      <tr><td>" . $competitor->firstName . " " . $competitor->lastName . "</td><td>" . $competitor->yearOfBirth . "</td><td>" . $competitor->sex . "</td><td>" . $competitor->category . "</td><td>" . $competitor->club . "</td></tr>\n");
}
?>
  </table>
  </div>
</section>
<section class="footer-top">
  <div class="row">
    <div class="small-12 large-12 columns">
      <ul class="small-block-grid-3 medium-block-grid-5 large-block-grid-5">
        <li>
          <a href="http://www.foerderverein-judo-in-hamburg.de" target="_blank">
            <img src="http://www.hamburg-judo.de/fileadmin/template/Resources/Public/Images/footer_logo_foerderverein.jpg">
          </a>
        </li>
        <li>
          <a href="https://www.facebook.com/FoerdervereinJudoInHamburg" target="_blank">
            <img src="http://www.hamburg-judo.de/fileadmin/template/Resources/Public/Images/footer_logo_herz.jpg">
          </a>
        </li>
        <li>
          <a href="http://www.hamburger-judo-team.de" target="_blank">
            <img src="http://www.hamburg-judo.de/fileadmin/template/Resources/Public/Images/footer_logo_hjt.jpg">  
          </a>
        </li>
        <li>
          <a href="http://www.stiftung-leistungssport.de" target="_blank">
            <img src="http://www.hamburg-judo.de/fileadmin/template/Resources/Public/Images/footer_logo_leistungssport.jpg">
          </a>
        </li>
        <li>
          <a href="http://www.hamburg.de/active-city/" target="_blank">
            <img src="http://www.hamburg-judo.de/fileadmin/template/Resources/Public/Images/footer_logo_activecity.jpg">
          </a>
        </li>
      </ul>
    </div>
  </div>
</section>
<footer class="footer-bottom">
  <div class="row">
    <div class="small-12 large-12 columns">
      © Copyright 2016 Hamburger Judo Verband e.V. | <a href="http://www.hamburg-judo.de/kontakt/">Kontakt</a> | <a href="http://www.hamburg-judo.de/impressum/">Impressum</a><br>
      Powered by <a href="https://github.com/Xilaew/JudoShiai-xPack">JudoShiai-xPack</a> | Author: Felix von Poblotzki
    </div>
  </div>
</footer>
<a class="exit-off-canvas"></a>
</div>
</div>
<script src="http://www.hamburg-judo.de/typo3conf/ext/mc_foundation_template/Resources/Public/foundation-5.4.6/js/vendor/jquery.js?1412891670" type="text/javascript"></script><script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="http://www.hamburg-judo.de/typo3conf/ext/mc_foundation_template/Resources/Public/foundation-5.4.6/js/foundation.min.js?1412891670" type="text/javascript"></script><script src="jquery-ui.min.js"></script>
<script>
	$(document).foundation();
</script>
<script>
var yearOfTournament=<?php echo($yearOfTournament);?>;
var minYearOfBirth=<?php echo($minYearOfBirth);?>;
var maxYearOfBirth=<?php echo($maxYearOfBirth);?>;
var categories=<?php echo(json_encode($categories));?>;
var coachId = '<?php echo(getCoachId(false)); ?>';
var competitors = <?php echo(json_encode($competitors)); ?>;
var forceRegistration = <?php echo(json_encode($forceRegistration)); ?>;

function getFormData($form){
  var unindexed_array = $form.serializeArray();
  var indexed_array = {};
  $.map(unindexed_array, function(n, i){
    indexed_array[n['name']] = n['value'];
  });
  return indexed_array;
}

$('#signUpForm').submit(function(e){ 
  e.preventDefault(); 
  var data = getFormData($( this ));
  console.log( data );
  $.ajax({
    type: 'POST',
    url: 'rest.php/competitors',
    data: JSON.stringify(data),
    contentType: "application/json",
    beforeSend: function() { $('#loading').show(); },
    complete: function() { $('#loading').hide(); },
    success: function (data,textStatus,jqXHR){
      if (jqXHR.status==201){
        message([ '<?php printf(_('%s was successfully registered.'),'<strong>\' + data.firstName + \' \' + data.lastName + \'</strong>');?>' ]);
        addCompetitorTableEntry(data);
        competitors.push(data);
        $('#radioset input').removeAttr('checked');
        $('#radioset').buttonset('refresh');
        $('input[name=firstName]').val('');
        $("input[name=lastName]").val('');
        updateWeights(null);
        if (coachId == ''){
          message([ '<?php echo('<strong>' . _('Hint:') . ' </strong>' . _('In order to view and modify the entered competitors later on you should create a Coach Id (username).'));?>' ], 'message', 'error');
        }
      } else {
        message([ <?php echo('\'<strong>' . _('Error:') . ' </strong> \' + data.msg');?>, developerContact() ], 'message', 'error');
      }
    },
    error: function(jqXHR,textStatus,errorThrown) { handleError(jqXHR,textStatus,errorThrown,'message');}
  });
});

$('#coachIdForm').submit(function(e){ 
  e.preventDefault(); 
  var data = document.getElementById('input_coachId').value ;
  var val = 'GET';
  if ( coachId=='' && competitors.length>0 ){
    val = "POST";
  } else if(coachId=='' && competitors.length==0 ){
    val = "PUT";
  } else if (coachId!=''){
    val = "DELETE";
  }
  $.ajax({
    type: val,
    url: 'rest.php/coachid',
    data: JSON.stringify(data),
    contentType: "application/json",
    beforeSend: function() { $('#loading_coachId').show(); },
    complete: function() { $('#loading_coachId').hide(); },
    success: function (data,textStatus,jqXHR){
      if (val=='POST' && jqXHR.status==201){
        message([ "<?php printf(_("From now on you can log-in with your Coach Id %s anytime to view and edit your registered competitors."), '<strong>" + data.new_sid + "</strong>' );?>" ], 'message' );
        coachId = data.new_sid;
        document.getElementById('input_coachId').value = data.new_sid;
        document.getElementById('input_postCoachId').style.display="none";
        document.getElementById('input_delCoachId').style.display="";
        document.getElementById('signUpForm').style.display="";
      } else if (val=='DELETE' && jqXHR.status==204){
        message([ "<?php echo(_("You have been logged-out successfully."));?>" ], 'message' );
        coachId = '';
        document.getElementById('input_coachId').value = '';
        document.getElementById('input_postCoachId').style.display="";
        document.getElementById('input_delCoachId').style.display="none";
        if (forceRegistration){
          document.getElementById('signUpForm').style.display="none";
          message([ "<?php echo(_("Before you can register competitors you need to sign up by entering your email address as Coach Id. We use the email to keep you updated about any changes regarding the tournament. Further you can view and modify your competitors later on with this email/Coach Id as login."));?>" ], 'message', 'error', true );
        }
      } else if (val=='PUT' && jqXHR.status==200){
        message([ "<?php printf(_("You have been logged-in as %s successfully."),'<strong>" + data.new_sid + "</strong>');?>" ], 'message' );
        coachId = data.new_sid;
        document.getElementById('input_coachId').value = data.new_sid;
        document.getElementById('input_postCoachId').style.display="none";
        document.getElementById('input_delCoachId').style.display="";
        document.getElementById('signUpForm').style.display="";
      } else {
        handleError(jqXHR,textStatus,'setting Coach Id: unexpected response.','message');
        return;
      }
      getCompetitors();
    },
    error: function(jqXHR,textStatus,errorThrown) { handleError(jqXHR,textStatus,errorThrown,'message');}
  });
});

function getCompetitors(){
  $.ajax({
    type: 'GET',
    url: 'rest.php/competitors',
    contentType: "application/json",
    beforeSend: function() { $('#loading_coachId').show(); },
    complete: function() { $('#loading_coachId').hide(); },
    success: function (data,textStatus,jqXHR){
      var cntnt=document.getElementById('competitor_table');
      cntnt.getElementsByTagName("tbody")[0].innerHTML = cntnt.rows[0].innerHTML;
      data.forEach(function (competitor,index){
        addCompetitorTableEntry(competitor);
        // $("#test-output").text(function(i,text){return text + index});
      });
      competitors=data;
      if(competitors.length == 0 && coachId != '' ){
        message([ "<?php printf( _('No competitors were found for the Coach Id %s.'), '<strong>" + coachId + "</strong>');?>" ], 'message', 'error', true);
      }
    },
    error: function(jqXHR,textStatus,errorThrown) { handleError(jqXHR,textStatus,errorThrown,'message');}
  });
};

function addCompetitorTableEntry(data){
  $("<tr><td>"+data.firstName+" "+data.lastName+"</td><td>"+data.yearOfBirth+"</td><td>"+data.sex+"</td><td>"+data.category+"</td><td>"+data.club+"</td></tr>").appendTo("#competitor_table");
}

function handleError(jqXHR,textStatus,errorThrown,msgFieldId){
  message([ "<?php printf( '<strong>' . _('Error:') . ' </strong>' . _('Something went wrong. textStatus: %s errorThrown: %s'), '" + textStatus + "', '" + errorThrown + "' );?>" ,
           developerContact() ], msgFieldId, 'error' );
}

function developerContact(){
  return "<?php echo(_("Developer's contact details: Felix von Poblotzki, +4915232787790, xilaew@gmail.com"));?>"
};

function message(messages,msgFieldId="message",msgType="highlight",append=false){
  var html = '<div class="ui-widget"><div class="ui-state-'+msgType+' ui-corner-all" style="padding: 0 .7em;">'
  messages.forEach(function (m,i) {
    html += '<p>' + m + '</p>'
  });
  html += '</div></div>';
  if (append){
    document.getElementById(msgFieldId).insertAdjacentHTML('beforeend', html);
  } else {
    document.getElementById(msgFieldId).innerHTML=html;
  }
};

var category = "";
function updateWeights(e) {
  var newcategory="";
  var weights=null;
  var sex = $('input[name=sex]:checked').val();
  var yearOfBirth = $('input[name=yearOfBirth]').val();
  var age=yearOfTournament-yearOfBirth;
  if( sex == "m"){
    var sexCategories=categories.male
//    $("#test-output").text(function(i,text){return text + "♂"});
  }
  if( sex == "f"){
    var sexCategories=categories.female
//    $("#test-output").text(function(i,text){return text + "♀"});
  }
//XXX This code assumes, that the categories within categories.male and categories.female are in ascending order by their max age.
  for (var cat in sexCategories){
    if (age<=cat){
//      $("#test-output").text(function(i,text){return text + cat});
      var newcategory=sexCategories[cat].agetext;
      weights=sexCategories[cat].weights;
      var weightTexts=sexCategories[cat].weightTexts;
      break;
    }
  }
  if (newcategory == category ){
//    $("#test-output").text(function(i,text){return text + "."});
  } else {
//    $("#test-output").text(function(i,text){return text + "#"});
    category=newcategory;
    $("#labelAgeCat").text(category);
    $("#input_weight").empty();
    if (weights == null){
      $("<option/>").text("<?php echo(_("Select year of birth and sex first."));?>").appendTo("#input_weight");
    } else {
      $("<option/>").val("").text("<?php echo(_("Please choose a weight category."));?>").appendTo("#input_weight");
      weightTexts.forEach(function (item,index) {
        $("<option/>").val(weights[index]).text(item).appendTo("#input_weight");
      })
    }
  };
};

$( "input[name='sex']" ).change(updateWeights);
$( "input[name='yearOfBirth']" ).change(updateWeights);

//$( "#accordion" ).accordion({heightStyle: "content"});
$( "#signUpForm input:submit" ).button();
$('#signUpForm input:text, #signUpForm input:password')
  .button()
  .css({
          'font' : 'inherit',
         'color' : 'inherit',
    'text-align' : 'left',
       'outline' : 'none',
        'cursor' : 'text',
  });
$('#signUpForm select')
  .button()
  .css({
          'font' : 'inherit',
         'color' : 'inherit',
    'text-align' : 'left',
       'outline' : 'none',
  });
$( "#radioset" ).buttonset();
$( "#controlgroup" ).controlgroup();
$( "#input_yearOfBirth" ).spinner({
  stop: function( event, ui ) {updateWeights(event);},
  min:minYearOfBirth,
  max:maxYearOfBirth
  });
$( "#coachIdForm input:submit" ).button();
$('#coachIdForm input:text, #signUpForm input:password')
  .button()
  .css({
          'font' : 'inherit',
         'color' : 'inherit',
    'text-align' : 'left',
       'outline' : 'none',
        'cursor' : 'text',
  });
</script>
</body>
</html>