<?php
require 'vendor/autoload.php';
require 'datastore.php'; 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$what = $_REQUEST["what"];
if($what == "votes")
{
	$ds = Datastore::getOrCreate();
	Datastore::resetVotes($ds);
	echo 'Votes resettet';
}
elseif($what == "ideas")
{
	$ds = Datastore::getOrCreate();
	Datastore::resetIdeas($ds);
	echo 'Ideas resettet';
}
else
	echo 'Nothing to do';
?>
