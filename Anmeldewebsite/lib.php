<?php
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

function csv_getCompetitors($input){
  $result=array();
  $indices=array("firstName","lastName","yearOfBirth","sex","club");
  $f = fopen("data.csv", "r");
  while (($line = fgetcsv($f)) !== false) {
    $competitor=array();
    foreach($line as $k => $content){
      $key=$indices[$k];
      $competitor[$key]=$content;
    }
    $result[]=$competitor;
  }
  fclose($f);
  echo json_encode($result);
}

function csv_addCompetitor($competitor,$fp) {
  $indices=array("firstName","lastName","yearOfBirth","sex","weight","category","club");
  $result= new \stdClass;
  if ($competitor->lastName=="" and $competitor->firstName=="" ) {
    $result->msg="Please enter a name!";
  } elseif ($competitor->club=="" ) {
    $result->msg="Please enter a valid club!";
  } elseif ($competitor->sex!="m" and $competitor->sex!="f" ) {
    $result->msg="Transgenders not allowed!";
  }elseif ($competitor->yearOfBirth>2006 or $competitor->yearOfBirth<1998 ) {
    $result->msg="Year Of Birth must be between 1998 and 2006";
  } else {
    $competitor->category=map_category($competitor->sex,$competitor->yearOfBirth,$competitor->weight);
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

function map_category ($sex, $yearOfBirth, $weight ) {
  $mU15=array("-34", "-37", "-40", "-43", "-46", "-50", "-55", "-60", "-66", "+66");
  $fU15=array("-33", "-36", "-40", "-44", "-48", "-52", "-57", "-63", "+63");
  $mU18=array("-43", "-46", "-50", "-55", "-60", "-66", "-73", "-81", "-90", "+90");
  $fU18=array("-40", "-44", "-48", "-52", "-57", "-63", "-70", "-78", "+78");
  $mU21=array("-55", "-60", "-66", "-73", "-81", "-90", "-100", "+100");
  $fU21=array("-44", "-48", "-52", "-57", "-63", "-70", "-78", "+78");
  $category="";
  $weights=array();
  if ($yearOfBirth <= 2006 and $yearOfBirth >= 2004 ){
    if ( $sex == "m"){
      $category="männliche Jugend U15";
      $weights=$mU15;
    } else if ( $sex == "f"){
      $category="weibliche Jugend U15";
      $weights=$fU15;
    }
  } else if ($yearOfBirth <= 2003 and $yearOfBirth >= 2001 ){
    if ( $sex == "m"){
      $category="Männer U18";
      $weights=$mU18;
    } else if ( $sex == "f"){
      $category="Frauen U18";
      $weights=$fU18;
    }
  } else if($yearOfBirth <= 2000 and $yearOfBirth >= 1998 ){
    if ( $sex == "m"){
      $category="Männer U21";
      $weights=$mU21;
    } else if ( $sex == "f"){
      $category="Frauen U21";
      $weights=$fU21;
    }
  };
  if ( in_array($weight, $weights) and $category!=""){
    $category .= " ".$weight."kg";
  } else {
    $category = "";
  }
  return $category;
}

?>