<?php
require 'locale.php';
require_once 'config.php';
require 'lib.php';
$db=new SQLite3($judoShiaiTemplateFile);
$info=sqlite_getInfo($db);
$categories=sqlite_getCategories($db);
$db->close();
$fp=fopen($clubsTxt, "r");
$clubs=csv_getClubs($fp);
fclose($fp);
$fp=fopen($dataCsv, "r");
$competitors=csv_getCompetitors($fp, getCoachId(true));
fclose($fp);
?><!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo(_('Anmeldung:') . ' ' . $info->Competition);?></title>
  <link href="jquery-ui.min.css" rel="stylesheet">
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
<div id="accordion">
  <h2><?php echo(_('Anmeldung:') . ' ' . $info->Competition);?></h2>
  <div>
    <div id="message" ></div>
    <form action="index.php" method="post" id="signUpForm">
      <div style="padding: .7em;"><label for="input_firstName"><?php echo(_('Vorname:'));?> </label><input required name="firstName" id="input_fistName" type="text"></div>
      <div style="padding: .7em;"><label for="input_lastName"><?php echo(_('Nachname:'));?> </label><input required name="lastName" id="input_lastName" type="text"></div>
      <div style="padding: .7em;">
        <label for="input_yearOfBirth"><?php echo(_('Geburtsjahr:'));?> </label><input name="yearOfBirth" id="input_yearOfBirth" type="number" required readonly value="2005">
        <span style="margin-left:1em;" id="labelAgeCat"></span>
      </div>
      <div style="padding: .7em;"><?php echo(_('Geschlecht:'));?> 
        <div id="radioset">
          <label for="input_male"><?php echo(_('männlich'));?></label><input id="input_male" required type="radio" name="sex" value="m">
          <label for="input_female"><?php echo(_('weiblich'));?></label><input id="input_female" required type="radio" name="sex" value="f">
        </div>
      </div>
      <div style="padding: .7em;"><label for="input_weight"><?php echo(_('Gewichtsklasse:'));?> </label>
      <select name="weight" id="input_weight">
        <option value=""><?php echo(_('Wähle zuerst Geburtsjahr und Geschlecht'));?></option>
      </select></div>
      <div style="padding: .7em;"><label for="input_club"><?php echo(_('Verein:'));?> </label>
      <select name="club" required id="input_club">
        <option value=""><?php echo(_('Wähle den Verein des Kämpfers'));?></option>
<?php
foreach( $clubs as $club ){
  echo("        <option value=\"$club\">$club</option>\n");
}
?>
      </select></div>
      <div style="padding: .7em;"><input name="register" type="submit" value="<?php echo(_('Anmelden'));?>"><span id="loading" style="display:none;"><p><img src="loading.gif" /> <?php echo(_('Bitte Warten...'));?></p></span></div>
<!--      <div id="test-output" style="padding: .7em;"></div> -->
    </form>
  </div>
  <h2><?php echo(_('Bereits eingegebene Anmeldungen:'));?></h2>
  <div>
    <div id="messageCoachId" >
<?php if (count($competitors)>0 && getCoachId(false)==""){
  echo('      <div class="ui-widget"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><strong>' . _('Hinweis:') . ' </strong>' . _('Um später deine bereits angemeldeten Kämpfer einsehen und bearbeiten zu können solltest du eine Trainer Id (Benutzernamen) anlegen.') . '</p></div></div>');
}?>
    </div>
    <form id="coachIdForm">
      <div style="padding: .7em;"><label for="input_coachId"><?php echo(_('Trainer Id:'));?> </label><input required name="coachId" id="input_coachId" type="text" value="<?php echo(getCoachId(false));?>"><input name="postCoachId" id="input_postCoachId" type="submit" value="<?php echo(_('Anmelden / Registrieren')); ?>" <?php if (getCoachId(false)!=''){echo('style="display:none;"');}?>><input name="delCoachId" id="input_delCoachId" type="submit" value="<?php echo(_('Abmelden'));?>" <?php if (getCoachId(false)==''){echo('style="display:none;"');}?>><span id="loading_coachId" style="display:none;"><p><img src="loading.gif" /> <?php echo(_('Bitte Warten...'));?></p></span></div>
    </form>
  <table id="competitor_table">
    <tr><th><?php echo(_('Name'));?></th><th><?php echo(_('Geburtsjahr'));?></th><th><?php echo(_('Geschlecht'));?></th><th><?php echo(_('Klasse'));?></th><th><?php echo(_('Verein'));?></th></tr>
<?php
foreach( $competitors as $competitor ){
  echo("      <tr><td>" . $competitor->firstName . " " . $competitor->lastName . "</td><td>" . $competitor->yearOfBirth . "</td><td>" . $competitor->sex . "</td><td>" . $competitor->category . "</td><td>" . $competitor->club . "</td></tr>\n");
}
?>
  </table>
  </div>
</div>
<script src="external/jquery/jquery.js"></script>
<script src="jquery-ui.js"></script>
<script>
var yearOfTournament=<?php echo($yearOfTournament);?>;
var minYearOfBirth=<?php echo($minYearOfBirth);?>;
var maxYearOfBirth=<?php echo($maxYearOfBirth);?>;
var categories=<?php echo(json_encode($categories));?>;
var coachId = '<?php echo(getCoachId(false)); ?>';
var competitors = <?php echo(json_encode($competitors)); ?>

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
        message([ '<?php printf(_('%s wurde erfolgreich angemeldet.'),'<strong>\' + data.firstName + \' \' + data.lastName + \'</strong>');?>' ]);
        addCompetitorTableEntry(data);
        competitors.push(data);
        $('#radioset input').removeAttr('checked');
        $('#radioset').buttonset('refresh');
        $('input[name=firstName]').val('');
        $("input[name=lastName]").val('');
        updateWeights(null);
        if (coachId == ''){
          message([ '<?php echo('<strong>' . _('Hinweis:') . ' </strong>' . _('Um später deine bereits angemeldeten Kämpfer einsehen und bearbeiten zu können solltest du eine Trainer Id (Benutzernamen) anlegen.'));?>' ], 'messageCoachId', 'error');
        }
      } else {
        message([ <?php echo('\'<strong>' . _('Fehler:') . ' </strong> \' + data.msg');?>, developerContact() ], 'message', 'error');
      }
    },
    error: function(jqXHR,textStatus,errorThrown) { handleError(jqXHR,textStatus,errorThrown,'messageCoachId');}
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
        message([ '<?php printf(_('Du kannst dich ab sofort jederzeit mit der CoachId %s wieder einloggen und deine Anmeldungen einsehen und bearbeiten.'), '<strong>\' + data.new_sid + \'</strong>' );?>' ], 'messageCoachId' );
        coachId = data.new_sid;
        document.getElementById('input_coachId').value = data.new_sid;
        document.getElementById('input_postCoachId').style.display="none";
        document.getElementById('input_delCoachId').style.display="";
      } else if (val=='DELETE' && jqXHR.status==204){
        message([ '<?php echo(_('Du wurdest erfolgreich ausgeloggt.'));?>' ], 'messageCoachId' );
        coachId = '';
        document.getElementById('input_coachId').value = '';
        document.getElementById('input_postCoachId').style.display="";
        document.getElementById('input_delCoachId').style.display="none";
      } else if (val=='PUT' && jqXHR.status==200){
        message([ '<?php printf(_('Du wurdest erfolgreich als %s eingeloggt.'),'<strong>\' + data.new_sid + \'</strong>');?>' ], 'messageCoachId' );
        coachId = data.new_sid;
        document.getElementById('input_coachId').value = data.new_sid;
        document.getElementById('input_postCoachId').style.display="none";
        document.getElementById('input_delCoachId').style.display="";
      } else {
        handleError(jqXHR,textStatus,'setting Trainer Id: unexpected response.','messageCoachId');
        return;
      }
      getCompetitors();
    },
    error: function(jqXHR,textStatus,errorThrown) { handleError(jqXHR,textStatus,errorThrown,'messageCoachId');}
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
        message([ "<?php printf( _('Mit der Trainer Id %s wurden keine Kämpfer gefunden.'), '<strong>" + coachId + "</strong>');?>" ], 'messageCoachId', 'error', true);
      }
    },
    error: function(jqXHR,textStatus,errorThrown) { handleError(jqXHR,textStatus,errorThrown,'messageCoachId');}
  });
};

function addCompetitorTableEntry(data){
  $("<tr><td>"+data.firstName+" "+data.lastName+"</td><td>"+data.yearOfBirth+"</td><td>"+data.sex+"</td><td>"+data.category+"</td><td>"+data.club+"</td></tr>").appendTo("#competitor_table");
}

function handleError(jqXHR,textStatus,errorThrown,msgFieldId){
  message([ "<?php printf( '<strong>' . _('Fehler:') . ' </strong>' . _('Etwas ist schief gegangen. textStatus: %s errorThrown: %s'), '" + textStatus + "', '" + errorThrown + "' );?>" ,
           developerContact() ], msgFieldId, 'error' );
}

function developerContact(){
  return "<?php echo(_('Kontakt zum Entwickler: Felix von Poblotzki, +4915232787790, xilaew@gmail.com'));?>"
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
      $("<option/>").text("<?php echo(_("Wähle zuerst Geburtsjahr und Geschlecht"));?>").appendTo("#input_weight");
    } else {
      $("<option/>").val("").text("<?php echo(_("Bitte wähle eine Gewichtsklasse"));?>").appendTo("#input_weight");
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
</script></body>
</html>