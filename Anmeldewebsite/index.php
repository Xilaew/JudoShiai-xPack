<?php
require_once 'config.php';
require 'locale.php';
require 'lib.php';
$db = new SQLite3($judoShiaiTemplateFile);
$info = sqlite_getInfo($db);
$categories = sqlite_getCategories($db);
$db->close();
$fp = fopen($clubsTxt, "r");
$clubs = csv_getClubs($fp);
fclose($fp);
if (file_exists($dataCsv)) {
  $fp = fopen($dataCsv, "r");
} else {
  $fp = fopen($dataCsv, "a");
}
$competitors = csv_getCompetitors($fp, getCoachId(true));
fclose($fp);
?><!DOCTYPE html>
<html lang="<?php echo(_("en"));?>">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
      input[type=number].input-number–noSpinners {
        -moz-appearance: textfield; 
      }
      input[type=number].input-number–noSpinners::-webkit-inner-spin-button,
      input[type=number].input-number–noSpinners::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }
      .label{
        display:inline-block;
        margin-bottom:.5rem;
        font-size:1rem;
      }
      .legend{
        display:block;
        width:100%;
        max-width:100%;
        padding:0;
        margin-bottom:.5rem;
        font-size:1.5rem;
        line-height:inherit;
        color:inherit;
        white-space:normal
      }
    </style>
    <title><?php echo($info->Competition); ?></title>
  </head>
  <body>
    <div class="container">
      <h1><?php echo($info->Competition); ?></h1>
    </div>
    <div class="container">
      <h2><?php echo(_("Register new competitors:")); ?></h2>
      <div>
        <div id="message" >
          <?php
          if (count($competitors) > 0 && getCoachId(false) == "") {
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong><?php echo(_('Hint:')); ?></strong><?php echo(_('In order to view and modify the entered competitors later on you should create a Coach Id (username).')); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
          }
          ?>
          <?php
          if ($forceRegistration && getCoachId(false) == "") {
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?php echo(_('Before you can register competitors you need to sign up by entering your email address as Coach Id. We use the email to keep you updated about any changes regarding the tournament. Further you can view and modify your competitors later on with this email/Coach Id as login.')); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
          }
          ?>
        </div>
        <form action="index.php" method="post" id="signUpForm" class="<?php echo( ($forceRegistration && getCoachId(false) == "") ? 'd-none' : ''); ?>">
          <div class="row">
            <div class="col-md form-group"><label for="input_firstName"><?php echo(_("First Name")); ?></label><input required name="firstName" id="input_firstName" type="text" class="form-control"></div>
            <div class="col-md form-group"><label for="input_lastName"><?php echo(_("Last Name")); ?></label><input required name="lastName" id="input_lastName" type="text" class="form-control"></div>
          </div>
          <div class="row">
            <div class="col-md form-group">
              <label for="input_yearOfBirth"><?php echo(_("Year of birth")); ?></label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button id="btn_dec_yearOfBirth" class="btn btn-outline-primary" type="button" tabindex="-1">-</button>
                </div>
                <input name="yearOfBirth" id="input_yearOfBirth" type="number" required value="<?php echo(floor(($minYearOfBirth + $maxYearOfBirth) / 2)); ?>" min="<?php echo($minYearOfBirth); ?>" max="<?php echo($maxYearOfBirth); ?>" class="form-control input-number–noSpinners">
                <div class="input-group-append">
                  <button id="btn_inc_yearOfBirth" class="btn btn-outline-primary" type="button" tabindex="-1">+</button>
                </div>            
              </div>
            </div>
            <fieldset class="col-md form-group">
              <legend class="label"><?php echo(_("Sex")); ?></legend>
              <div id="btn_group_sex" class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                <label class="btn btn-outline-primary active w-100" for="input_male">
                  <input type="radio" name="sex" id="input_male" value="m" checked="" autocomplete="off"><?php echo(_("male")); ?>
                </label>
                <label class="btn btn-outline-primary w-100" for="input_female">
                  <input type="radio" name="sex" id="input_female" value="f" autocomplete="off"><?php echo(_("female")); ?>
                </label>
              </div>
            </fieldset>
          </div>
          <div class="row">
            <div class="col-md form-group">
              <label for="labelAgeCat"><?php echo(_("Age Category")); ?></label>
              <input id="labelAgeCat" type="text" readonly class="form-control-plaintext" value="">
            </div>
            <div class="col-md form-group"><label for="input_weight"><?php echo(_("Weight Category")); ?></label>
              <select name="weight" id="input_weight" class="form-control">
                <option value="" selected disabled><?php echo(_("Select year of birth and sex first.")); ?></option>
              </select>
            </div>
          </div>
          <div class="form-group"><label for="input_club"><?php echo(_("Club")); ?> </label>
            <select name="club" required id="input_club" class="form-control">
              <option value="" selected disabled><?php echo(_("Choose the competitor's club.")); ?></option>
              <?php
              foreach ($clubs as $club) {
                echo("              <option value=\"$club\">$club</option>\n");
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <input name="register" type="submit" value="<?php echo(_('Register Competitor')); ?>" class="btn btn-primary">
            <span id="loading" class="d-none"><p><img src="loading.gif" /><?php echo(_('please wait...')); ?></p></span>
          </div>
          <!--      <div id="test-output" style="padding: .7em;"></div> -->
        </form>
      </div>
    </div>
  </div>
  <div class="container">
    <h2><?php echo(_("Already registered competitors:")); ?></h2>
    <div>
      <div id="messageCoachId" >
      </div>
      <form id="coachIdForm">
        <div class="row"> 
          <div class="col-md form-group">
            <label for="input_coachId"><?php echo(_('Coach Id')); ?></label><input required name="coachId" id="input_coachId" type="text" value="<?php echo(getCoachId(false)); ?>" class="form-control">
          </div>              
          <div class="col-md form-group align-self-end">
            <input name="postCoachId" id="input_postCoachId" type="submit" value="<?php echo(_("Log-in / Register")); ?>" class="btn btn-primary btn-blk <?php echo((getCoachId(false) != '') ? 'd-none' : ''); ?>">
            <input name="delCoachId" id="input_delCoachId" type="submit" value="<?php echo(_('Log-out')); ?>" class="btn btn-primary btn-blk <?php echo((getCoachId(false) == '') ? 'd-none' : ''); ?>">
            <span id="loading_coachId" class="d-none"><p><img src="loading.gif" /><?php echo(_('please wait...')); ?></p></span>
          </div>
        </div>
      </form>
      <table id="competitor_table" class="table table-striped">
        <thead>
          <tr>
            <th><?php echo(_("Name")); ?></th>
            <th><?php echo(_("Year of birth")); ?></th>
            <th><?php echo(_("Sex")); ?></th>
            <th><?php echo(_("Category")); ?></th>
            <th><?php echo(_("Club")); ?></th>
          </tr>
        </thead><tbody>
          <?php
          foreach ($competitors as $competitor) {
            echo("      <tr><td>" . $competitor->firstName . " " . $competitor->lastName . "</td><td>" . $competitor->yearOfBirth . "</td><td>" . $competitor->sex . "</td><td>" . $competitor->category . "</td><td>" . $competitor->club . "</td></tr>\n");
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
    var yearOfTournament =<?php echo($yearOfTournament); ?>;
    var minYearOfBirth =<?php echo($minYearOfBirth); ?>;
    var maxYearOfBirth =<?php echo($maxYearOfBirth); ?>;
    var categories =<?php echo(json_encode($categories)); ?>;
    var coachId = '<?php echo(getCoachId(false)); ?>';
    var competitors = <?php echo(json_encode($competitors)); ?>;
    var forceRegistration = <?php echo(json_encode($forceRegistration)); ?>;

    function getFormData($form) {
      var unindexed_array = $form.serializeArray();
      var indexed_array = {};
      $.map(unindexed_array, function (n, i) {
        indexed_array[n['name']] = n['value'];
      });
      return indexed_array;
    }

    $('#signUpForm').submit(function (e) {
      e.preventDefault();
      var data = getFormData($(this));
      console.log(data);
      $.ajax({
        type: 'POST',
        url: 'rest.php/competitors',
        data: JSON.stringify(data),
        contentType: "application/json",
        beforeSend: function () {
          $('#loading').show();
        },
        complete: function () {
          $('#loading').hide();
        },
        success: function (data, textStatus, jqXHR) {
          if (jqXHR.status === 201) {
            message(['<?php printf(_('%s was successfully registered.'), '<strong>\' + data.firstName + \' \' + data.lastName + \'</strong>'); ?>'],'message','success');
            addCompetitorTableEntry(data);
            competitors.push(data);
            $('#radioset input').removeAttr('checked');
            $('input[name=firstName]').val('');
            $("input[name=lastName]").val('');
            updateWeights(null);
            if (coachId === '') {
              message(['<?php echo('<strong>' . _('Hint:') . ' </strong>' . _('In order to view and modify the entered competitors later on you should create a Coach Id (username).')); ?>'], 'message', 'warning');
            }
          } else {
            message([<?php echo('\'<strong>' . _('Error:') . ' </strong> \' + data.msg'); ?>, developerContact()], 'message', 'danger');
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          handleError(jqXHR, textStatus, errorThrown, 'message');
        }
      });
    });

    $('#coachIdForm').submit(function (e) {
      e.preventDefault();
      var data = document.getElementById('input_coachId').value;
      var val = 'GET';
      if (coachId === '' && competitors.length > 0) {
        val = "POST";
      } else if (coachId === '' && competitors.length === 0) {
        val = "PUT";
      } else if (coachId !== '') {
        val = "DELETE";
      }
      $.ajax({
        type: val,
        url: 'rest.php/coachid',
        data: JSON.stringify(data),
        contentType: "application/json",
        beforeSend: function () {
          $('#loading_coachId').show();
        },
        complete: function () {
          $('#loading_coachId').hide();
        },
        success: function (data, textStatus, jqXHR) {
          if (val === 'POST' && jqXHR.status === 201) {
            message(["<?php printf(_("From now on you can log-in with your Coach Id %s anytime to view and edit your registered competitors."), '<strong>" + data.new_sid + "</strong>'); ?>"], 'message');
            coachId = data.new_sid;
            document.getElementById('input_coachId').value = data.new_sid;
            document.getElementById('input_postCoachId').classList.add("d-none");
            document.getElementById('input_delCoachId').classList.remove("d-none");
            document.getElementById('signUpForm').classList.remove("d-none");
          } else if (val === 'DELETE' && jqXHR.status === 204) {
            message(["<?php echo(_("You have been logged-out successfully.")); ?>"], 'message');
            coachId = '';
            document.getElementById('input_coachId').value = '';
            document.getElementById('input_postCoachId').classList.remove("d-none");
            document.getElementById('input_delCoachId').classList.add("d-none");
            if (forceRegistration) {
              document.getElementById('signUpForm').classList.add("d-none");
              message(["<?php echo(_("Before you can register competitors you need to sign up by entering your email address as Coach Id. We use the email to keep you updated about any changes regarding the tournament. Further you can view and modify your competitors later on with this email/Coach Id as login.")); ?>"], 'message', 'warning', true);
            }
          } else if (val === 'PUT' && jqXHR.status === 200) {
            message(["<?php printf(_("You have been logged-in as %s successfully."), '<strong>" + data.new_sid + "</strong>'); ?>"], 'message');
            coachId = data.new_sid;
            document.getElementById('input_coachId').value = data.new_sid;
            document.getElementById('input_postCoachId').classList.add("d-none");
            document.getElementById('input_delCoachId').classList.remove("d-none");
            document.getElementById('signUpForm').classList.remove("d-none");
          } else {
            handleError(jqXHR, textStatus, 'setting Coach Id: unexpected response.', 'message');
            return;
          }
          getCompetitors();
        },
        error: function (jqXHR, textStatus, errorThrown) {
          handleError(jqXHR, textStatus, errorThrown, 'message');
        }
      });
    });

    function getCompetitors() {
      $.ajax({
        type: 'GET',
        url: 'rest.php/competitors',
        contentType: "application/json",
        beforeSend: function () {
          $('#loading_coachId').show();
        },
        complete: function () {
          $('#loading_coachId').hide();
        },
        success: function (data, textStatus, jqXHR) {
          var cntnt = document.getElementById('competitor_table');
          cntnt.getElementsByTagName("tbody")[0].innerHTML = '';
          data.forEach(function (competitor, index) {
            addCompetitorTableEntry(competitor);
            // $("#test-output").text(function(i,text){return text + index});
          });
          competitors = data;
          if (competitors.length === 0 && coachId !== '') {
            message(["<?php printf(_('No competitors were found for the Coach Id %s.'), '<strong>" + coachId + "</strong>'); ?>"], 'message', 'warning', true);
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          handleError(jqXHR, textStatus, errorThrown, 'message');
        }
      });
    }
    ;

    function addCompetitorTableEntry(data) {
      $("<tr><td>" + data.firstName + " " + data.lastName + "</td><td>" + data.yearOfBirth + "</td><td>" + data.sex + "</td><td>" + data.category + "</td><td>" + data.club + "</td></tr>").appendTo("#competitor_table");
    }

    function handleError(jqXHR, textStatus, errorThrown, msgFieldId) {
      message(["<?php printf('<strong>' . _('Error:') . ' </strong>' . _('Something went wrong. textStatus: %s errorThrown: %s'), '" + textStatus + "', '" + errorThrown + "'); ?>",
        developerContact()], msgFieldId, 'danger');
    }

    function developerContact() {
      return "<?php echo(_("Developer's contact details: Felix von Poblotzki, +4915232787790, xilaew@gmail.com")); ?>";
    }
    ;

    function message(messages, msgFieldId = "message", msgType = "success", append = false) {
      if (!(["success","info","warning","danger"].includes(msgType))) {
        console.log('msgType: \"'+msgType+'\" is not a valid Message Type');
        var msgType="info";
      }
      var content = '';
      messages.forEach(function (m, i) {
        if (i > 0){
          content += '<br>';
        }
        content += m;
      });
      var html = `
      <div class="alert alert-${msgType} alert-dismissible fade show" role="alert">
        ${content}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>`;
      if (append) {
        document.getElementById(msgFieldId).insertAdjacentHTML('beforeend', html);
      } else {
        document.getElementById(msgFieldId).innerHTML = html;
      }
    }
    ;

    var category = "";
    function updateWeights(e) {
      var newcategory = "";
      var weights = null;
      var sex = $('input[name=sex]:checked').val();
      var yearOfBirth = $('input[name=yearOfBirth]').val();
      var age = yearOfTournament - yearOfBirth;
      if (sex === "m") {
        var sexCategories = categories.male;
        //    $("#test-output").text(function(i,text){return text + "♂"});
      }
      if (sex === "f") {
        var sexCategories = categories.female;
        //    $("#test-output").text(function(i,text){return text + "♀"});
      }
      //XXX This code assumes, that the categories within categories.male and categories.female are in ascending order by their max age.
      for (var cat in sexCategories) {
        if (age <= cat) {
          //      $("#test-output").text(function(i,text){return text + cat});
          var newcategory = sexCategories[cat].agetext;
          weights = sexCategories[cat].weights;
          var weightTexts = sexCategories[cat].weightTexts;
          break;
        }
      }
      if (newcategory === category) {
        //    $("#test-output").text(function(i,text){return text + "."});
      } else {
        //    $("#test-output").text(function(i,text){return text + "#"});
        category = newcategory;
        $("#labelAgeCat").val(category);
        $("#input_weight").empty();
        if (weights === null) {
          $("<option/>").text("<?php echo(_("Select year of birth and sex first.")); ?>").appendTo("#input_weight");
        } else {
          $("<option/>").val("").text("<?php echo(_("Please choose a weight category.")); ?>").appendTo("#input_weight");
          weightTexts.forEach(function (item, index) {
            $("<option/>").val(weights[index]).text(item).appendTo("#input_weight");
          });
        }
      }
    }

    $.fn.mouseheld = function (step) {
      var nextTime = 0;
      var delay = 160;
      var running = true;

      function runStep(time) {
        if (running)
          requestAnimationFrame(runStep);
        if (time < nextTime)
          return;
        nextTime = time + delay;

        step();
      }
      this.mousedown(function () {
        running = true;
        nextTime = 0;
        requestAnimationFrame(runStep);
      }).bind('mouseup mouseleave', function () {
        running = false;
      });
    };

    $("#btn_inc_yearOfBirth").mouseheld(function (e) {
      var elem = $("#input_yearOfBirth");
      if (elem.attr('max') > elem.val()) {
        elem.val(+elem.val() + 1);
        elem.change();
      }
    });

    $("#btn_dec_yearOfBirth").mouseheld(function (e) {
      var elem = $("#input_yearOfBirth");
      if (elem.attr('min') < elem.val()) {
        elem.val(+elem.val() - 1);
        elem.change();
      }
    });

    $("input[name='sex']").change(updateWeights);
    $("input[name='yearOfBirth']").change(updateWeights);
    updateWeights();
  </script>
</body>
</html>