<?php
require_once 'config.php';

function sqlite_getInfo ($db) {
  $result = new \stdClass;
  $result->Competition = $db->querySingle("SELECT value FROM info WHERE item=='Competition'");
  $result->Date = $db->querySingle("SELECT value FROM info WHERE item=='Date'");
  $result->Place = $db->querySingle("SELECT value FROM info WHERE item=='Place'");
  return $result;
}

function sqlite_getCategories ($db) {
  $male = array();
  $female = array();
  $queryResults = $db->query("SELECT age, agetext, flags, weight, weighttext FROM catdef");
  while ($row = $queryResults->fetchArray()) {
    $map=&$female;
    $sex="f";
    if ($row["flags"]==1) {
      $map=&$male;
      $sex="m";
    }
    $age=$row[age];
    if (($cat=$map[$age])!=NULL){
      $cat->weights[]=$row[weight];
      $cat->weightTexts[]=$row[weighttext];
    } else {
      $cat= new \stdClass;
      $cat->age=$age;
      $cat->agetext=$row[agetext];
      $cat->sex=$sex;
      $cat->weights=array($row[weight]);
      $cat->weightTexts=array($row[weighttext]);
      $map[$age]=$cat;
    }
  }
  $result=new \stdClass;
  $result->male = $male;
  $result->female = $female;
  return $result;
}

function csv_getClubs($fp){
  $result=array();
  while (($line = fgetcsv($fp)) !== false) {
    $result[]=$line[0];
  }
  return $result;
}

function csv_getCompetitors($fp){
  $result=array();
  $indices=array("firstName","lastName","yearOfBirth","sex","club");
  while (($line = fgetcsv($fp)) !== false) {
    $competitor=array();
    foreach($line as $k => $content){
      $key=$indices[$k];
      $competitor[$key]=$content;
    }
    $result[]=$competitor;
  }
  echo json_encode($result);
}

function csv_addCompetitor($competitor,$fp,$categories) {
  global $maxYearOfBirth;
  global $minYearOfBirth;
  $indices=array("firstName","lastName","yearOfBirth","sex","weight","category","club");
  $result= new \stdClass;
  if ($competitor->lastName=="" and $competitor->firstName=="" ) {
    $result->msg="Please enter a name!";
  } elseif ($competitor->club=="" ) {
    $result->msg="Please enter a valid club!";
  } elseif ($competitor->sex!="m" and $competitor->sex!="f" ) {
    $result->msg="Transgenders not allowed!";
  }elseif ($competitor->yearOfBirth>$maxYearOfBirth or $competitor->yearOfBirth<$minYearOfBirth ) {
    $result->msg="Year Of Birth must be between $minYearOfBirth and $maxYearOfBirth";
  } else {
    $competitor->category=map_category($competitor->sex,$competitor->yearOfBirth,$competitor->weight,$categories);
    $line=array();
    foreach ($indices as $key){
      $line[]=$competitor->$key;
      $result->$key=$competitor->$key;
    }
    if (!fputcsv($fp,$line)) {
      $result->msg="Not saved due to internal error!";
    } 
  }
  return $result;
}

function map_category ($sex, $yearOfBirth, $weight, $categories ) {
  global $yearOfTournament;
  $category=NULL;
  $age=$yearOfTournament-$yearOfBirth;
  if ($sex=='m'){
      $sexCategories=$categories->male;
  }
  if ($sex=='f'){
      $sexCategories=$categories->female;
  }
  //XXX This code assumes, that the categories within categories.male and categories.female are in ascending order by their max age.
  foreach ($sexCategories as $catAge => $cat) {
    if ($age<=$catAge){
      $category=$cat;
      break;
    }
  }
  //XXX This code assumes, that the weights within the weight array are in ascending order.
  $weightText=NULL;
  foreach($category->weights as $k => $w) {
    if ($weight<=$w){
      $weightText=$category->weightTexts[$k];
      break;
    }
  }
  if ($weight>1000 and $category!=NULL and $weightText!=NULL){
      $result = $category->agetext . $weightText;
  } else {
    $result = "";
  }
  return $result;
}
?>