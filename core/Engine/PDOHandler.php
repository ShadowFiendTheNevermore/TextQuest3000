<?php 
namespace TextQuest\Engine;

use TextQuest\Patterns\Singleton;
/**
* 
*/
class PDOHandler extends Singleton
{

	private static $dbpath;

	private static $db;
	
	public static function setDB($dbname)
	{
		self::$db = $dbname;
	}

	public static function setDBpath($dbpath)
	{
		self::$dbpath = realpath($dbpath);
	}

	public static function create()
	{
		return new \PDO('sqlite:' . self::$dbpath . '/' . self::$db);
	}

	
}
