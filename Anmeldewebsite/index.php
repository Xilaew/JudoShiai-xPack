<?php
require_once 'config.php';
#require 'locale.php';
require 'lib.php';
$db=new SQLite3($judoShiaiTemplateFile);
$info=sqlite_getInfo($db);
$clubs=csv_getClubs(fopen($clubsTxt, "r"))
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Anmeldung <?php echo $info->Competition; ?></title>
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
  <h2><?php echo _("Anmeldung"); echo " ".$info->Competition; ?></h2>
  <div>
    <div id="message" ></div>
    <form action="index.php" method="post" id="signUpForm">
      <input type="hidden"/>
      <div style="padding: .7em;"><label for="input_firstName">Vorname: </label><input required name="firstName" id="input_fistName" type="text"></div>
      <div style="padding: .7em;"><label for="input_lastName">Nachname: </label><input required name="lastName" id="input_lastName" type="text"></div>
      <div style="padding: .7em;">
        <label for="input_yearOfBirth">Geburtsjahr: </label><input name="yearOfBirth" id="input_yearOfBirth" type="number" required readonly value="2005">
        <span style="margin-left:1em;" id="labelAgeCat"></span>
      </div>
      <div style="padding: .7em;">Geschlecht: 
        <div id="radioset">
          <label for="input_male">männlich</label><input id="input_male" required type="radio" name="sex" value="m">
          <label for="input_female">weiblich</label><input id="input_female" required type="radio" name="sex" value="f">
        </div>
      </div>
      <div style="padding: .7em;"><label for="input_weight">Gewichtsklasse: </label>
      <select name="weight" id="input_weight">
        <option value="">Wähle zuerst Geburtsjahr und Geschlecht</option>
      </select></div>
      <div style="padding: .7em;"><label for="input_club">Verein: </label>
      <select name="club" required id="input_club">
        <option value="">Wähle den Verein des Kämpfers</option>
<?php
foreach( $clubs as $club ){
  echo "        <option value=\"$club\">$club</option>\n";
}
?>
      </select></div>
      <div style="padding: .7em;"><input name="register" type="submit" value="Anmelden"><span id="loading" style="display:none;"><p><img src="loading.gif" /> Please Wait</p></span></div>
<!--      <div id="test-output" style="padding: .7em;"></div> -->
    </form>
  </div>
  <h2>Bereits eingegebene Anmeldungen:</h2>
  <div>
  <table id="competitor_table">
    <tr><th>Name</th><th>Geburtsjahr</th><th>Geschlecht</th><th>Klasse</th><th>Verein</th></tr>
  </table>
  </div>
</div>
<script src="external/jquery/jquery.js"></script>
<script src="jquery-ui.js"></script>
<script>
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
  data =  getFormData($( this ));
  console.log( data );
  $.ajax({
    type: 'POST',
    url: 'rest.php/competitors',
    data: JSON.stringify(data),
    contentType: "application/json",
    beforeSend: function() { $('#loading').show(); },
    complete: function() { $('#loading').hide(); },
    success: handleSuccess,
    error: handleError
  });
});

function handleSuccess(data,textStatus,jqXHR){
  if (jqXHR.status==201){
    $("#message").html('<div class="ui-widget"><div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"><p><strong>' + data.firstName + ' ' + data.lastName + '</strong> wurde erfolgreich angemeldet.</p></div></div>');
    $("<tr><td>"+data.firstName+" "+data.lastName+"</td><td>"+data.yearOfBirth+"</td><td>"+data.sex+"</td><td>"+data.category+"</td><td>"+data.club+"</td></tr>").appendTo("#competitor_table");
    $('#radioset input').removeAttr('checked');
    $('#radioset').buttonset('refresh');
    $('input[name=firstName]').val('');
    $("input[name=lastName]").val('');
    updateWeights(null);
  } else {
    $("#message").html('<div class="ui-widget"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><strong>Fehler: </strong> ' + data.msg + '</p><p>Kontakt zum Entwickler: Felix von Poblotzki, +4915232787790, xilaew@gmail.com</p></div></div>');
  }
}

function handleError(jqXHR,textStatus,errorThrown){
  $("#message").html('<div class="ui-widget"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><strong>Fehler: </strong> etwas ist schief gegangen. textStatus: ' + textStatus + ' errorThrown: ' + errorThrown + ' </p><p>Kontakt zum Entwickler: Felix von Poblotzki, +4915232787790, xilaew@gmail.com</p></p></div></div>');
}

var category = "";
var yearOfTournament=<?php echo $yearOfTournament;?>;
var minYearOfBirth=<?php echo $minYearOfBirth;?>;;
var maxYearOfBirth=<?php echo $maxYearOfBirth;?>;;
<?php
  echo "var categories=".json_encode(sqlite_getCategories($db), JSON_PRETTY_PRINT).";\n";
?>

var updateWeights = function(e) {
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
      $("<option/>").text("<?php echo _("Wähle zuerst Geburtsjahr und Geschlecht");?>").appendTo("#input_weight");
    } else {
      $("<option/>").val("").text("Bitte wähle eine Gewichtsklasse").appendTo("#input_weight");
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
</script></body>
</html>