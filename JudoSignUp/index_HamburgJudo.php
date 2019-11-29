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
/* Buissness logic to determine which parts of the website are visible and which not. */
$showAlertDisabled = ($disabled || $turnamentIsOver || ($registrationIsClosed && $lateRegistrationHandling == 'reject'));
if (!$disabled) { /* if manually disabled the $disabledErrorMessage supplied in the config file shall be used */
  if ($registrationIsClosed && $lateRegistrationHandling == 'reject') {
    $disabledErrorMessage = sprintf(_('Registration for this tournament was closed on %s. No new registrations will be accepted. Please consider registering before closing of registration for the next tournament.'), $registrationClosingDate);
  }
  if ($turnamentIsOver) {
    $disabledErrorMessage = sprintf(_('The tounament took place on %s. There is no point in registering new competitors for a long gone turnament.'), $dateOfTournament);
  }
}
$showAlertCoachId = (!$showAlertDisabled && count($competitors) > 0 && getCoachId(false) == "");
$showAlertRegistrationRequired = (!$showAlertDisabled && $forceRegistration && getCoachId(false) == "");
$showAlertLateRegistration = (!$showAlertDisabled && ($registrationIsClosed && $lateRegistrationHandling == 'warn'));
$showAlertTroubleshooting = isset($_GET['troubleshooting']);
$showLinkTroubleshooting = ($emailAlternativeRegistration != '');
$showContainerSignUp = !($disabled || $turnamentIsOver || ($registrationIsClosed && $lateRegistrationHandling == 'reject'));
$displayFormSignUp = !($forceRegistration && getCoachId(false) == "");
$showContainerAlreadyRegistered = !($disabled || $turnamentIsOver);
$showInputWeight = ($inputWeight == 'optional' || $inputWeight == 'required');
$attributesInputWeight = ($inputWeight == 'required') ? 'required' : '';
$textLabelLegalConsent = ($customLegalConsentText == '') ? _("I consent that my information provided here can be used throughout the planning and execution of the tournament. My name will be written on competition sheets visible to anybody pysically present on the tournament. The data will be deleted one week after the tournament.") : $customLegalConsentText;
?><!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="no-js" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- 
	This website is powered by TYPO3 - inspiring people to share!
	TYPO3 is a free open source Content Management Framework initially created by Kasper Skaarhoj and licensed under GNU/GPL.
	TYPO3 is copyright 1998-2019 of Kasper Skaarhoj. Extensions are copyright of their respective owners.
	Information and contribution at https://typo3.org/
-->

<link rel="shortcut icon" href="https://www.hamburg-judo.de/fileadmin/template/Resources/Public/Icon/favicon.ico" type="image/x-icon" />

<meta name="generator" content="TYPO3 CMS" />
<meta name="author" content="Author" />
<meta name="robots" content="index,follow" />
<meta name="language" content="deutsch,de" />


<link rel="stylesheet" type="text/css" href="https://www.hamburg-judo.de/typo3temp/assets/compressed/merged-864823138d307e6efb75442ab65753e6-89949576671f2b6a0010bc2bbdc5eee1.css?1563091149" media="all" />
<link rel="stylesheet" type="text/css" href="https://www.hamburg-judo.de/typo3temp/assets/compressed/merged-3c464f7d7d2999cef9094e97109006ab-ac49b268eb9f4b5ec72639bf659a1702.css?1563015424" media="screen" />
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

      /* The switch - the box around the slider */
      .switch {
        position: relative;
        display: inline;
        width: 60px;
        height: 34px;
        float:left;
        margin-right: 0.5em;
      }
      .switch-label {
        display: inline;
      }
      /* Hide default HTML checkbox */
      .switch input {display:none;}
      /* The slider */
      .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
      }
      .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
      }
      input:checked + .slider {
        background-color: #007bff;
      }
      input:focus + .slider {
        box-shadow: 0 0 1px #007bff;
      }
      input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
      }
      /* Rounded sliders */
      .slider.round {
        border-radius: 34px;
      }
      .slider.round:before {
        border-radius: 50%;
      }
    </style>



<script src="https://www.hamburg-judo.de/typo3temp/assets/compressed/merged-548afee6001c7b2aa6b98d9e382046c2-a9bb53a79192c05396b70b6a244ef1a2.js?1563015424" type="text/javascript"></script>



<title><?php echo($info->Competition); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="manifest" href="https://www.hamburg-judo.de/fileadmin/template/Resources/Public/Icon/manifest.json">

</head>
<body>

﻿<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">
	
		<!-- Off Canvas Menu -->
		<aside class="left-off-canvas-menu">
		
			<!-- whatever you want goes here -->
			<ul><li><a href="https://www.hamburg-judo.de/aktuelles">Aktuelles</a></li><li><a href="https://www.hamburg-judo.de/termine-ausschreibungen">Termine & Ausschreibungen</a></li><li><a href="https://www.hamburg-judo.de/der-hjv/gesch-vorstand">Der HJV</a></li><li><a href="https://www.hamburg-judo.de/ressort/wettkampf-leistungssport/stuetzpunkttraining">Ressort</a></li><li><a href="https://www.hamburg-judo.de/downloads">Downloads</a></li><li><a href="https://www.hamburg-judo.de/kontakt">Kontakt</a></li><li><a href="https://www.hamburg-judo.de/impressum">Impressum</a></li><li><a href="https://www.hamburg-judo.de/datenschutz">Datenschutz</a></li></ul>
			
		</aside>
		
		<!-- main content goes here -->

		<!-- top bar -->	
		<nav class="tab-bar show-for-small-only">
			<section class="left-small">
				<a class="left-off-canvas-toggle menu-icon" href="#off-canvas-navigation"><span></span></a>
			</section>
			<section class="right tab-bar-section">
				<a href="https://www.hamburg-judo.de/">
					Hamburger Judo Verband e.V.
				</a>
			</section>
		</nav>			


		<!-- header -->
		<header calss="hide-for-small">
			<img class="lazy hide-for-small" data-src="https://www.hamburg-judo.de/typo3conf/ext/mc_foundation_template/Resources/Public/Images/header-2019.jpg" width="100%" alt="Hamburger Judo Verband e.V.">
		</header>
		
		<section class="top-menu-bar">
			<div class="row hide-for-small">
				<div class="small-12 large-12 columns">	
					<nav class="top-bar" data-topbar role="navigation">
						<ul class="title-area">
							<li class="name">
								<h1><a href="https://www.hamburg-judo.de/">HJV</a></h1>
							</li>
						</ul>
						<section class="top-bar-section">
							<!-- Left Nav Section -->
							<ul class="left"><li><a href="https://www.hamburg-judo.de/aktuelles">Aktuelles</a></li><li><a href="https://www.hamburg-judo.de/termine-ausschreibungen">Termine & Ausschreibungen</a></li><li class="has-dropdown"><a href="https://www.hamburg-judo.de/der-hjv/gesch-vorstand">Der HJV</a><ul class="dropdown"><li><a href="https://www.hamburg-judo.de/der-hjv/gesch-vorstand">gesch. Vorstand</a></li><li><a href="https://www.hamburg-judo.de/der-hjv/ehrenmitglieder">Ehrenmitglieder</a></li><li><a href="https://www.hamburg-judo.de/der-hjv/vorstand">Vorstand</a></li><li><a href="https://www.hamburg-judo.de/der-hjv/landestrainer">Landestrainer</a></li><li><a href="https://www.hamburg-judo.de/der-hjv/beauftragte">Beauftragte</a></li><li><a href="https://www.hamburg-judo.de/der-hjv/kassenpruefer">Kassenprüfer</a></li><li><a href="https://www.hamburg-judo.de/der-hjv/rechtsausschuss">Rechtsausschuss</a></li><li><a href="https://www.hamburg-judo.de/der-hjv/ehrenrat">Ehrenrat</a></li><li><a href="https://www.hamburg-judo.de/der-hjv/ehrenliste">Ehrenliste</a></li><li><a href="https://www.hamburg-judo.de/der-hjv/mitgliedsvereine">Mitgliedsvereine</a></li><li><a href="https://www.hamburg-judo.de/der-hjv/leistungen-preise">Leistungen & Preise</a></li></ul></li><li class="has-dropdown"><a href="https://www.hamburg-judo.de/ressort/wettkampf-leistungssport/stuetzpunkttraining">Ressort</a><ul class="dropdown"><li><a href="https://www.hamburg-judo.de/ressort/wettkampf-leistungssport/stuetzpunkttraining">Wettkampf-/Leistungssport</a></li><li><a href="https://www.hamburg-judo.de/ressort/eliteschule-des-sports">Eliteschule des Sports</a></li><li><a href="https://www.hamburg-judo.de/ressort/kampfrichter">Kampfrichter</a></li><li><a href="https://www.hamburg-judo.de/ressort/lehr-und-pruefungswesen">Lehr- und Prüfungswesen</a></li><li><a href="https://www.hamburg-judo.de/ressort/hamburg-liga">Hamburg-Liga</a></li><li><a href="https://www.hamburger-judo-team.de" target="_blank">Hamburger Judo Team</a></li><li><a href="http://www.foerderverein-judo-in-hamburg.de" target="_blank">Förderverein Judo in Hamburg</a></li><li><a href="https://www.hamburg-judo.de/ressort/kyudo">Kyudo</a></li><li><a href="https://www.hamburg-judo.de/ressort/kendo">Kendo</a></li><li><a href="https://www.hamburg-judo.de/ressort/jiu-jitsu">Jiu-Jitsu</a></li><li><a href="https://www.hamburg-judo.de/ressort/aikido">Aikido</a></li></ul></li><li><a href="https://www.hamburg-judo.de/downloads">Downloads</a></li><li><a href="https://www.hamburg-judo.de/kontakt">Kontakt</a></li><li><a href="https://www.hamburg-judo.de/impressum">Impressum</a></li><li><a href="https://www.hamburg-judo.de/datenschutz">Datenschutz</a></li></ul>
						</section>
					</nav>
				</div>
			</div>
		</section>
		
		<!-- header -->
		<header calss="show-for-small-only">
			<img class="show-for-small-only lazy" data-src="https://www.hamburg-judo.de/typo3conf/ext/mc_foundation_template/Resources/Public/Images/header-small-2019.jpg" width="100%" alt="Hamburger Judo Verband e.V.">
		</header>
		
		
		

		<section id="main-content">
			<div class="row">
			
				<div class="small-12 large-9 columns">
					<!--TYPO3SEARCH_begin-->
    <div class="container">
      <h1><?php echo($info->Competition); ?></h1>
      <h1><?php echo($info->Date . " | " . $info->Place); ?></h1>
      <div id="message" >
        <?php
        if ($showAlertDisabled) {
        ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo($disabledErrorMessage); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php
        }
        ?>
        <?php
        if ($showAlertCoachId) {
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
        if ($showAlertLateRegistration) {
        ?>
          <div class="alert alert-warning fade show" role="alert">
            <strong><?php echo(_('Hint:')); ?></strong><?php printf(_('Registration for this tournament was closed on %s. We kindly accept late registrations. Please consider registering before closing of registration for the next tournament.'), $registrationClosingDate); ?>
          </div>
        <?php
        }
        ?>
        <?php
        if ($showAlertRegistrationRequired) {
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
        <?php
        if ($showAlertTroubleshooting) {
        ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php 
            $emailLink = '<a href="mailto:'.$emailAlternativeRegistration.'?subject='.rawurlencode(sprintf(_('Registration for %s'),$info->Competition)).'&amp;body='.rawurlencode(_('Hi,')."\n"._('I was not able to use the registration website because [Reason why I could not use Website].')."\n\n"._('I would like to register the following competitors:')."\n"._('John,Smith,1990,m,,,London Judo Club,')."\n"._('Amanda,Johnson,2002,f,,,London Judo Club,')."\n\n"._('Regards [your Name]')).'">'.$emailAlternativeRegistration.'</a>';
            printf(_('If you are having trouble with this registration page please tell us about it and of course we also take your registration when you send an email to %s.'),$emailLink);
            echo('<br>');
            echo(_('Please enclose the competitors information in the following format in your email:'));
            echo('<br>');
            echo(_('first name,last name,year of birth,sex as "m"=male or "f"=female,,,club,'));
            echo('<br>');
            echo(_('for example:'));
            echo('<br>');
            echo(_('John,Smith,1990,m,,,London Judo Club,'));
            echo('<br>');
            echo(_('Amanda,Johnson,2002,f,,,London Judo Club,')); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  <?php
    if ($showContainerSignUp) {
  ?>
    <div class="container <?php echo( $displayFormSignUp ? '' : 'd-none'); ?>" id="containerSignUp">
      <h2><?php echo(_("Register new competitors:")); ?></h2>
      <div>
        <form action="index.php" method="post" id="signUpForm" class="">
          <div class="row">
            <div class="col-md form-group"><label for="input_firstName"><?php echo(_("First Name")); ?></label><input required name="firstName" id="input_firstName" type="text" class="form-control"></div>
            <div class="col-md form-group"><label for="input_lastName"><?php echo(_("Last Name")); ?></label><input required name="lastName" id="input_lastName" type="text" class="form-control"></div>
          </div>
          <div class="row">
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
            <div class="col-md form-group">
              <label for="input_yearOfBirth"><?php echo(_("Year of birth")); ?></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <button id="btn_dec_yearOfBirth" class="btn btn-outline-primary" type="button" tabindex="-1">-</button>
                </div>
                <input name="yearOfBirth" id="input_yearOfBirth" type="number" required value="<?php echo(floor(($minYearOfBirth + $maxYearOfBirth) / 2)); ?>" min="<?php echo($minYearOfBirth); ?>" max="<?php echo($maxYearOfBirth); ?>" class="form-control input-number–noSpinners">
                <div class="input-group-append">
                  <button id="btn_inc_yearOfBirth" class="btn btn-outline-primary" type="button" tabindex="-1">+</button>
                </div>
              </div>
  <?php
    if (!$showInputWeight) {
  ?>
              <span class="form-text text-muted small" id="labelAgeCat"></span>
  <?php
    }
  ?>
            </div>
          </div>
  <?php
    if ($showInputWeight) {
  ?>
          <div class="row">
            <div class="col-md form-group">
              <label for="labelAgeCat"><?php echo(_("Age Category")); ?></label>
              <input id="labelAgeCat" type="text" readonly class="form-control-plaintext" value="">
            </div>
            <div class="col-md form-group"><label for="input_weight"><?php echo(_("Weight Category")); ?></label>
              <select name="weight" id="input_weight" class="form-control" <?php echo($attributesInputWeight)?>>
                <option value="" selected disabled><?php echo(_("Select year of birth and sex first.")); ?></option>
              </select>
            </div>
          </div>
  <?php
    }
  ?>
          <div class="form-group"><label for="input_club"><?php echo(_("Club")); ?></label>
            <select name="club" required id="input_club" class="form-control" onchange="if(this.options[this.selectedIndex].value=='customOption'){toggleField(this,this.nextSibling); this.selectedIndex='0';}">
              <option value="" selected disabled><?php echo(_("Choose the competitor's club.")); ?></option>
              <?php
              if ($allowCustomClub == true) {
                echo('<option value="customOption">' . _('My club is not in this list.') . '</option>' . "\n");
              }
              foreach ($clubs as $club) {
                echo("              <option value=\"$club\">$club</option>\n");
              }
              ?>
<!--        No space allowed between </select> and <input> because nextSibling would return a reference to that whitespace node instad of the input node-->
            </select><input name="club" style="display:none;" disabled="disabled" type="text" class="form-control" onblur="if(this.value==''){toggleField(this,this.previousSibling);}">
          </div>
  <?php
    if ($showInputLegalConsent) {
  ?>
          <div class="form-group clearfix">
            <label for="input_legal" class="switch mb-0">
              <input type="checkbox" id="input_legal" name="legal" class="">
              <div class="slider round"></div>
            </label>
            <span class="switch-label"><?php echo($textLabelLegalConsent); ?></span>
          </div>
  <?php
    }
  ?>
          <div class="form-group">
            <input name="register" type="submit" value="<?php echo(_('Register Competitor')); ?>" class="btn btn-primary">
            <span id="loading" class="d-none"><p><img src="loading.gif" /><?php echo(_('please wait...')); ?></p></span>
  <?php
    if ($showLinkTroubleshooting) {
  ?>
            <a href='index.php?troubleshooting=true' class="form-text text-muted small"><?php echo(_('I am having trouble registering competitors.')); ?></a>
  <?php
    }
  ?>
          </div>
          <!--      <div id="test-output" style="padding: .7em;"></div> -->
        </form>
      </div>
    </div>
  <?php
    }
  ?>
  <?php
    if ($showContainerAlreadyRegistered) {
  ?>
  <div class="container">
    <h2><?php echo(_("Already registered competitors:")); ?></h2>
    <div>
      <div id="messageCoachId" >
      </div>
      <form id="coachIdForm">
        <div class="row"> 
          <div class="col-md form-group">
            <label for="input_coachId"><?php echo(_('Coach Id')); ?></label><input required name="coachId" id="input_coachId" type="<?php echo($forceRegistration ? 'email' : 'text'); ?>" value="<?php echo(getCoachId(false)); ?>" class="form-control">
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
  <?php
    }
  ?>

<!--TYPO3SEARCH_end-->
				</div>
				
			</div>
		</section>

				




		<section class="footer-top">
			<div class="row">
				<div class="small-12 large-12 columns">
					<ul class="small-block-grid-3 medium-block-grid-5 large-block-grid-5">
						<li>
							<a href="http://www.foerderverein-judo-in-hamburg.de" target="_blank">
								<img class="lazy" data-src="https://www.hamburg-judo.de/fileadmin/template/Resources/Public/Images/footer_logo_foerderverein.jpg" alt="Förderverein: Judo in Hamburg e.V.">
							</a>
						</li>
						<li>
							<a href="https://www.facebook.com/FoerdervereinJudoInHamburg" target="_blank">
								<img class="lazy" data-src="https://www.hamburg-judo.de/fileadmin/template/Resources/Public/Images/footer_logo_herz.jpg" alt="Förderverein: Judo in Hamburg e.V.">
							</a>
						</li>
						<li>
							<a href="https://www.hamburger-judo-team.de" target="_blank">
								<img class="lazy" data-src="https://www.hamburg-judo.de/fileadmin/template/Resources/Public/Images/footer_logo_hjt.jpg" alt="Förderverein Facebook Seite">
							</a>
						</li>
						<li>
							<a href="https://www.stiftung-leistungssport.de" target="_blank">
								<img class="lazy" data-src="https://www.hamburg-judo.de/fileadmin/template/Resources/Public/Images/footer_logo_leistungssport.jpg" alt="Stiftung Leistungssport Hamburg">
							</a>
						</li>
						<li>
							<a href="https://www.hamburg.de/active-city/" target="_blank">							
								<img class="lazy" data-src="https://www.hamburg-judo.de/fileadmin/template/Resources/Public/Images/footer_logo_activecity.jpg" alt="Hamburg Active City">
							</a>
						</li>						
					</ul>
				</div>
			</div>
		</section>
		
		<footer class="footer-bottom">
			<div class="row">
				<div class="small-12 large-12 columns">
        <span>Powered by <a href="https://github.com/Xilaew/JudoShiai-xPack">JudoShiai-xPack</a> - <a href="https://github.com/Xilaew/JudoShiai-xPack/releases/download/v1.0.1-10-ga6de902/JudoSignUp-v1.0.1-10-ga6de902.zip">JudoSignUp-v1.0.1-10-ga6de902</a></span><br/>
        <span>© 2018 Felix von Poblotzki. All Rights Reserved.</span>				</div>
			</div>
		</footer>

		<!-- close the off-canvas menu -->
		<a class="exit-off-canvas"></a>
	</div>
</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48635879-1', 'auto');
  ga('set', 'anonymizeIp', true);
  ga('send', 'pageview');

</script>

<script type="text/javascript">
	var gaProperty = 'UA-48635879-1';

	var disableStr = 'ga-disable-' + gaProperty;
	if (document.cookie.indexOf(disableStr + '=true') > -1) {
	  window[disableStr] = true;
	}

	function gaOptout() {
	  document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
	  window[disableStr] = true;
	}
</script>
<script src="https://www.hamburg-judo.de/typo3temp/assets/compressed/merged-4b712c7f7e3ac0f7dde027df3a688aee-8cf15ecfbe692bced5039b1cbeef95f3.js?1568547437" type="text/javascript"></script>

<script src="https://www.hamburg-judo.de/typo3temp/assets/compressed/merged-46e0369ca5e2a03e2042a290ac63d621-7b8f833318b45c400d5c1369f1c16b80.js?1563015424" type="text/javascript"></script>


<script>
	$(document).foundation();
</script>
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
            if (data.lateRegistration) {
              message(['<?php printf(_('The late registration of %s has been accepted.'), '<strong>\' + data.firstName + \' \' + data.lastName + \'</strong>'); ?>'], 'message', 'success');
            } else {
              message(['<?php printf(_('%s was successfully registered.'), '<strong>\' + data.firstName + \' \' + data.lastName + \'</strong>'); ?>'], 'message', 'success');
            }
            addCompetitorTableEntry(data);
            competitors.push(data);
            $('#radioset input').removeAttr('checked');
            $('input[name=firstName]').val('');
            $("input[name=lastName]").val('');
            updateWeights(null);
            if (coachId === '') {
              message(['<?php echo('<strong>' . _('Hint:') . ' </strong>' . _('In order to view and modify the entered competitors later on you should create a Coach Id (username).')); ?>'], 'message', 'warning', true);
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
            document.getElementById('containerSignUp').classList.remove("d-none");
          } else if (val === 'DELETE' && jqXHR.status === 204) {
            message(["<?php echo(_("You have been logged-out successfully.")); ?>"], 'message');
            coachId = '';
            document.getElementById('input_coachId').value = '';
            document.getElementById('input_postCoachId').classList.remove("d-none");
            document.getElementById('input_delCoachId').classList.add("d-none");
            if (forceRegistration) {
              document.getElementById('containerSignUp').classList.add("d-none");
              message(["<?php echo(_("Before you can register competitors you need to sign up by entering your email address as Coach Id. We use the email to keep you updated about any changes regarding the tournament. Further you can view and modify your competitors later on with this email/Coach Id as login.")); ?>"], 'message', 'warning', true);
            }
          } else if (val === 'PUT' && jqXHR.status === 200) {
            message(["<?php printf(_("You have been logged-in as %s successfully."), '<strong>" + data.new_sid + "</strong>'); ?>"], 'message');
            coachId = data.new_sid;
            document.getElementById('input_coachId').value = data.new_sid;
            document.getElementById('input_postCoachId').classList.add("d-none");
            document.getElementById('input_delCoachId').classList.remove("d-none");
            document.getElementById('containerSignUp').classList.remove("d-none");
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

    function message(messages, msgFieldId = "message", msgType = "success", append = false) {
      if (!(["success", "info", "warning", "danger"].includes(msgType))) {
        console.log('msgType: \"' + msgType + '\" is not a valid Message Type');
        var msgType = "info";
      }
      var content = '';
      messages.forEach(function (m, i) {
        if (i > 0) {
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
        $("#labelAgeCat").val(category).text(category);
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

    function toggleField(hideObj, showObj) {
      hideObj.disabled = true;
      hideObj.style.display = 'none';
      showObj.disabled = false;
      showObj.style.display = 'inline';
      showObj.focus();
    }
  </script>
</body>
</html>
<!-- Cached page generated 17-10-19 21:46. Expires 19-10-19 00:00 -->