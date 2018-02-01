<?php
require 'lib.php';

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
  break;
  case 'PUT':
    methodNotAllowed();
    break;
  case 'POST':
    post($request,$input);
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
    case 'clubs':
      get_clubs();
      break;
    default:
      http_response_code(404);
  }
}

function post($request,$input) {
  $table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
  switch ($table) {
    case 'competitors':
      post_competitors($input);
      break;
    default:
      http_response_code(404);
  }
}


function get_info(){
  echo json_encode(sqlite_getInfo(new SQLite3('template.shi')));
}

function get_categories(){
  echo json_encode(sqlite_getCategories(new SQLite3('template.shi')));
}

function get_clubs(){
  echo json_encode(csv_getClubs(fopen("clubs.txt", "r")));
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