<?php
header("Content-Type:application/json");

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'));

// create SQL based on HTTP method
switch ($method) {
  case 'GET':
    methodNotAllowed();
  break;
  case 'PUT':
    methodNotAllowed();
    break;
  case 'POST':
    post($input);
  break;
  case 'DELETE':
    methodNotAllowed();
  break;
  default:
    methodNotAllowed();
}

function get($input){
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

function post($input){
  $fp = fopen("data.csv", "a"); // $fp is now the file pointer to file $filename
  if (!$input){
    http_response_code(400);
    $msg="Input could not be parsed as JSON.";
  } elseif ( is_object($input) ) {
    $result = add_competitor($input,$fp);
    if ($result->msg) {
      http_response_code(200);
    } else {
      http_response_code(201);
#      http_response_code(301);
    }
  } elseif ( is_array($input) ) {
    foreach( $input as $competitor ){
      add_competitor($competitor,$fp);
    }
  } else {
    http_response_code(400);
    $msg="This is neither an object nor an array of Objects.";
  }
  if ($fp) {
    fclose($fp); // Close the file
  }
  echo $msg;
  echo json_encode($result);
}

function methodNotAllowed(){
    http_response_code(405);
}

function add_competitor($competitor,$fp) {
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

#function add_competitor($competitor,$fp) {
#  $reslt= new \stdClass;
#  if ($competitor->lastName=="" and $competitor->firstName=="" ) {
#    $result->msg="Please enter a name!";
#  } elseif ($competitor["club"]=="" ) {
#    $result->msg="Please enter a valid club!";
#  } elseif ($competitor["sex"]!="m" and $competitor["sex"]!="f" ) {
#    $result->msg="Transgenders not allowed!";
#  } else {
#    $line=array();
#    foreach ($indices as $key){
#      $line[]=$competitor[$key];
#    }
#    if (fputcsv($fp,$line)) {
#      $result->msg="success!!";
#    } else {
#    }
#  }
#  return $result;
#}


function maybelater(){// die if SQL statement failed
  if (!$result) {
    http_response_code(404);
    die(mysqli_error());
  }
   
  // print results, insert id or affected row count
  if ($method == 'GET') {
    if (!$key) echo '[';
    for ($i=0;$i<mysqli_num_rows($result);$i++) {
      echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
    if (!$key) echo ']';
  } elseif ($method == 'POST') {
  } else {
  }
}
?>