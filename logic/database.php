<?php

require "logging.php";

/**
	SQL database interface.
*/
interface DatabaseInterface {
	
	/**
		Queries the database.
		
		@param $query SQL query.
		@return Array of whatever the database returned or a null.
	*/
	public function query(string $query);
	
};

/**
	Database connection.
	
	Abstraction of a database connection. Constructing it will perform a
	database connection.
*/
class Database implements DatabaseInterface {
	public function __construct() {
		
		// TODO: implement
		
	}
	
	public function __destruct() {
		
		// TODO: implement
		
	}
	
	public function query(string $query) {
		
		// TODO: implement
		
	}
};

/**
	Mock database connection.
	
	Useful for debugging.
*/
class MockDatabase implements DatabaseInterface {
	public function __construct() {
		Logger::getInstance()->write("Database connection initialized.");
	}
	
	public function __destruct() {
		Logger::getInstance()->write("Database connection terminated.");
	}
	
	public function query(string $query) {
		Logger::getInstance()->write("Database query: " . $query);
		
		return null;
	}
};

/**
	Database with extra debugging info.
	
	Useful for debugging.
*/
class NoisyDatabase extends Database {
	public function __construct() {
		Logger::getInstance()->write("Initializing database connection.");
		Database::__construct();
	}
	
	public function __destruct() {
		Logger::getInstance()->write("Terminating database connection.");
		Database::__destruct();
	}
	
	public function query(string $query) {
		Logger::getInstance()->write("Database query: " . $query);
		
		$result = Database::query($query);
		Logger::getInstance()->write("Response: " . var_export($result, true));
		
		return $result;
	}
};

?>