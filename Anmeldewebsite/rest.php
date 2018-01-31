<?php
require 'lib.php';

$categories = new \stdClass;
$categories->mU15= new \stdClass;
$categories->mU15->maxAge=14;
$categories->mU15->sex=m;
$categories->mU15->maxWeights=array("34000", "370000", "40000", "43000", "46000", "50000", "55000", "60000", "66000", "1000000");
$categories->mU15->weightTexts=array("-34kg", "-37kg", "-40kg", "-43kg", "-46kg", "-50kg", "-55kg", "-60kg", "-66kg", "+66kg");
$categories->wU15= new \stdClass;
$categories->wU15->maxAge=14;
$categories->wU15->sex=f;
$categories->wU15->maxWeights=array("33000", "360000", "40000", "44000", "48000", "52000", "57000", "63000", "1000000");
$categories->wU15->weightTexts=array("-33kg", "-36kg", "-40kg", "-44kg", "-48kg", "-52kg", "-57kg", "-63kg", "+63kg");
$categories->mU18=array("-43", "-46", "-50", "-55", "-60", "-66", "-73", "-81", "-90", "+90");
$categories->fU18=array("-40", "-44", "-48", "-52", "-57", "-63", "-70", "-78", "+78");
$categories->mU21=array("-55", "-60", "-66", "-73", "-81", "-90", "-100", "+100");
$categories->fU21=array("-44", "-48", "-52", "-57", "-63", "-70", "-78", "+78");

header("Content-Type:application/json");
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'));
session_start();

// create SQL based on HTTP method
switch ($method) {
  case 'GET':
    get($request);
#    echo json_encode($categories);
#    methodNotAllowed();
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

function get($request) {
	$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
	switch ($table) {
		case 'info':
		get_info();
		break;
		case 'categories':
		get_categories();
		break;
	}
}

function get_info(){
	echo json_encode(sqlite_getInfo(new SQLite3('template.shi')));
}

function get_categories(){
	echo json_encode(sqlite_getCategories(new SQLite3('template.shi')));
}


function post_competitors($input){
  $fp = fopen("data.csv", "a"); // $fp is now the file pointer to file $filename
  if (!$input){
    http_response_code(400);
    $msg="Input could not be parsed as JSON.";
  } elseif ( is_object($input) ) {
    $result = csv_addCompetitor($input,$fp);
    if ($result->msg) {
      http_response_code(200);
    } else {
      http_response_code(201);
#      http_response_code(301);
    }
  } elseif ( is_array($input) ) {
    foreach( $input as $competitor ){
      csv_addCompetitor($competitor,$fp);
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
?>