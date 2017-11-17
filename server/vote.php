<?php
require 'vendor/autoload.php';
require 'datastore.php'; 

$idea = $_REQUEST["idea"];
$email = $_REQUEST["email"];
if($idea == "")
{
	echo 'No idea specified';
	die();
}
if($email == "")
{
	echo 'No email specified';
	die();
}
echo 'voteforIdea("' . $idea . '","' . $email . '")';
$ds = Datastore::getOrCreate();
Datastore::voteForIdea($ds, $idea, $email);
echo ';';
?>
