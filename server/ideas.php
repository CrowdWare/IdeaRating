<?php
require 'vendor/autoload.php';
require 'datastore.php'; 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$app = $_REQUEST["app"];
if($app == "")
{
	echo '{success:false,message:"App is not specified."}';
	die();
}
$ds = Datastore::getOrCreate();
$query = $ds->gqlQuery('SELECT * FROM Idea WHERE app = @1', [
	'bindings' => [
			$app
    	]
]);
$result = $ds->runQuery($query);
echo '{"idea":[';
$i = 0;
foreach ($result as $entity) 
{
	$subquery = $ds->gqlQuery('SELECT * FROM Vote WHERE app = @1 and idea = @2', [
    	'bindings' => [
			$app,
        	$entity['id']
    	]
	]);
	$votes = 0;
	$subresult = $ds->runQuery($subquery);
	foreach ($subresult as $subentity) 
	{
		$votes++;
	}
	if($i > 0)
		echo ',';
	$arr = array('id' => $entity['id'], 'name' => $entity['name'], 'description' => $entity['description'], 'votes' => $votes);
	echo json_encode($arr);
	$i++;
}
echo ']}';
?>



