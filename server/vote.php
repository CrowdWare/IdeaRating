<?php
require 'vendor/autoload.php';
require 'datastore.php'; 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$idea = $_REQUEST["idea"];
$email = $_REQUEST["email"];
$app = $_REQUEST["app"];
if($app == "")
{
	echo '{';
	echo 'success: false,';
	echo 'message: "No app specified"';
	echo '}';
	die();
}
if($idea == "")
{
	echo '{';
	echo 'success: false,';
	echo 'message: "No idea specified"';
	echo '}';
	die();
}
if($email == "")
{
	echo '{';
	echo 'success: false,';
	echo 'message: "No email specified"';
	echo '}';
	die();
}
$ds = Datastore::getOrCreate();
Datastore::voteForIdea($ds, $app, $idea, $email);
echo json_encode(array('success' => true));
//echo '{';
//echo 'success: true,';
//echo 'message: "Vote has been added."';
//echo '}';
?>
