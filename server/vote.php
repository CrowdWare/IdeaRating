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
if($idea == "")
{
	echo '{';
	echo '"message": "No idea specified"';
	echo '}';
	die();
}
if($email == "")
{
	echo '{';
	echo '"message": "No email specified"';
	echo '}';
	die();
}
$ds = Datastore::getOrCreate();
Datastore::voteForIdea($ds, $idea, $email);
echo '{';
echo '"message": "Vote has been added."';
echo '}';
?>
