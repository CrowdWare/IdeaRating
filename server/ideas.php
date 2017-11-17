<?php
require 'vendor/autoload.php';
require 'datastore.php'; 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$ds = Datastore::getOrCreate();
$query = $ds->gqlQuery('SELECT * FROM Idea');
$result = $ds->runQuery($query);
echo '{"idea":[';
$i = 0;
foreach ($result as $entity) 
{
	$subquery = $ds->gqlQuery('SELECT * FROM Vote WHERE idea = @1', [
    	'bindings' => [
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

/*
{"idea":[
{"id":"1","name":"First idea","description":"Bla bla bla"},
{"id":"2","name":"Second idea","description":"Bla bla bla"},
{"id":"3","name":"Third idea","description":"Bla bla bla"}
]}
*/
?>



