<?php
require 'vendor/autoload.php';
require 'datastore.php'; 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$what = $_REQUEST["what"];
$app = $_REQUEST["app"];
if($app == "")
{
	echo '{';
	echo 'success: false,';
	echo 'message: "App is not specified"';
	echo '}';
	die();
}
if($what == "votes")
{
	$ds = Datastore::getOrCreate();
	Datastore::resetVotes($ds, $app);
	echo '{';
	echo 'success: true,';
	echo 'message: "Votes resettet"';
	echo '}';
}
elseif($what == "ideas")
{
	$ds = Datastore::getOrCreate();
	Datastore::resetIdeas($ds, $app);
	echo '{';
	echo 'success: true,';
	echo 'message: "Ideas resettet"';
	echo '}';
}
else
{
	echo '{';
	echo 'success: false,';
	echo 'message: "Nothing to do"';
	echo '}';
}
?>
