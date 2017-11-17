<?php
require 'vendor/autoload.php';
require 'datastore.php'; 

$name = $_REQUEST["name"];
$description = $_REQUEST["description"];
if($name == "")
{
	echo 'No name specified';
	die();
}

if($description == "")
{
	echo 'No description specified';
	die();
}

echo 'addIdea("' . $name . '","' . $description . '")';
$ds = Datastore::getOrCreate();
$idea = uniqid();
Datastore::addIdea($ds, $idea, $name, $description);
echo ';';
?>
