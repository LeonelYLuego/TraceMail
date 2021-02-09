<?php

class DataBase {

	private static $server = "localhost";
	private static $user = "root";
	private static $password = "";
	private static $database = "tracemail";
	private static $connection = null;

	static function getServer() { return self::$server; }
	static function setServer($server) { self::$server = $server; }

	static function getUser() { return self::$user; }
	static function setUser($user) { self::$user = $user; }

	static function getPassword() { return self::$password; }
	static function setPassword($password) { self::$password = $password; }

	static function getDatabase() { return self::$database; }
	static function setDatabase($database) { self::$database = $database; }

	static function getConnection() { return self::$connection; }
	static function setConnection($connection) { self::$connection = $connection; }

	static function startConnection() {
		if(self::$connection == null) {
			self::$connection = new mysqli(self::$server, self::$user, self::$password, self::$database);
			self::$connection->set_charset('utf8');
			if(self::$connection->connect_error) 
				die("Connection failed: " . self::$connection->connect_error);
		}
	}

	static function closeConnection() {
		if(self::$connection != null)
			self::$connection->close();
	}

	static function query($query) {
		if($result = self::$connection->query($query))
			return $result;
		return false;
	}

}

DataBase::startConnection();

?>
