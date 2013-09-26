<?php

class DB {

	private static $instance;
	private $MYSQLI;

	private function __construct(array $DBS) {
		$this->MYSQLI = @new mysqli( $DBS['HOST'], $DBS['USERNAME'], $DBS['PASSWORD'], $DBS['DB'] );

		if( mysqli_connect_errno() ) {
			throw new Exception("Error connecting to database.");
		}

		$this->MYSQLI->set_charset("utf8");
	}

	public static function init(array $DBS) {
		if( self::$instance instanceof self ) {
			return false;
		}

		self::$instance = new self($DBS);
	}
	
	public static function getMObj() {
		return self::$instance->MYSQLI;
	}

	public static function query($q) {
		return self::$instance->MYSQLI->query($q);
	}

	public static function escape($string) {
		return self::$instance->MYSQLI->real_escape_string($string);
	}


}


?>
