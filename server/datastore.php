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

	public static function resetVotes($ds)
	{
		$query = $ds->gqlQuery('SELECT * FROM Vote');
		$result = $ds->runQuery($query);

		foreach ($result as $entity) 
		{
			$ds->delete($entity->key());
		}	
	}

	public static function resetIdeas($ds)
	{
		$query = $ds->gqlQuery('SELECT * FROM Idea');
		$result = $ds->runQuery($query);

		foreach ($result as $entity) 
		{
			$ds->delete($entity->key());
		}	
	}


	public static function addIdea($ds, $idea, $name, $description)
	{
		$key = $ds->key('Idea', $idea);
		$entity = $ds->entity(
			$key, 
			[
				'id' => $idea,
				'name' => $name, 
				'description' => $description
			],
			['excludeFromIndexes' => ['name', 'description']]
		);
		$ds->insert($entity);
	}

	public static function voteForIdea($ds, $idea, $email)
	{
		$key = $ds->key('Vote', uniqid());
		$entity = $ds->entity(
			$key, 
			[
				'idea' => $idea, 
				'email' => $email
			]
		);
		$ds->insert($entity);
	}
}
