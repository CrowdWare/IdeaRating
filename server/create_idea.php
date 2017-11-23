<?php
require 'vendor/autoload.php';
require 'datastore.php'; 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$name = $_REQUEST["name"];
$description = $_REQUEST["description"];
$app = $_REQUEST["app"];
if($name == "")
{
	echo '{';
	echo 'success: false,';
	echo 'message: "No name specified"';
	echo '}';
	die();
}

if($description == "")
{
	echo '{';
	echo 'success: false,';
	echo 'message: "No description specified"';
	echo '}';
	die();
}
if($app == "")
{
	echo '{';
	echo 'success: false,';
	echo 'message: "No app specified"';
	echo '}';
	die();
}

$ds = Datastore::getOrCreate();
$idea = uniqid();
Datastore::addIdea($ds, $app, $idea, $name, $description);
echo json_encode(array('success' => true));
//echo '{';
//echo 'success: true,';
//echo 'message: "Idea has been added."';
//echo '}';
?>
