<?php
use Google\Cloud\Datastore\DatastoreClient;

class Datastore 
{
    private static $ds;

    public static function getOrCreate() 
	{
        if (isset(Datastore::$ds)) 
			return Datastore::$ds;
       
		# only for dev env
        //putenv('DATASTORE_EMULATOR_HOST=http://localhost:8081');

        $datastore = new DatastoreClient([
            'projectId' => 'idearating-186209'
        ]);

        Datastore::$ds = $datastore;
        return Datastore::$ds;
    }

	public static function resetVotes($ds, $app)
	{
		$query = $ds->gqlQuery('SELECT * FROM Vote WHERE app = "' . $app . '"');
		$result = $ds->runQuery($query);

		foreach ($result as $entity) 
		{
			$ds->delete($entity->key());
		}	
	}

	public static function resetIdeas($ds, $app)
	{
		$query = $ds->gqlQuery('SELECT * FROM Idea WHERE app = "' . $app . '"');
		$result = $ds->runQuery($query);

		foreach ($result as $entity) 
		{
			$ds->delete($entity->key());
		}	
	}


	public static function addIdea($ds, $app, $idea, $name, $description)
	{
		$key = $ds->key('Idea', $idea);
		$entity = $ds->entity(
			$key, 
			[
				'id' => $idea,
				'app' => $app,
				'name' => $name, 
				'description' => $description
			],
			['excludeFromIndexes' => ['name', 'description']]
		);
		$ds->insert($entity);
	}

	public static function voteForIdea($ds, $app, $idea, $email)
	{
		$key = $ds->key('Vote', uniqid());
		$entity = $ds->entity(
			$key, 
			[
				'idea' => $idea,
				'app' => $app,
				'email' => $email
			]
		);
		$ds->insert($entity);
	}
}
