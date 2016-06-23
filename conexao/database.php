<?php


class Database
{
	private static $dbName = 'bd_emporio' ;
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'root';
	private static $dbUserPassword = '';
    private static $opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');

	private static $cont  = null;

	public function __construct() {
		exit('Init function is not allowed');
	}

	public static function connect()
	{
	   // One connection through whole application
       if ( null == self::$cont )
       {
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword, self::$opcoes);
        }
        catch(PDOException $e)
        {
          die($e->getMessage());
        }
       }
       return self::$cont;
	}

	public static function disconnect()
	{
		self::$cont = null;
	}
}
?>
