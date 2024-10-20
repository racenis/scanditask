<?php

interface LogWriterInterface {
	public function write($text);
};

class ConsoleLogWriter implements LogWriterInterface {
	public function write($text) {
		echo $text;
		echo "\n";
	}
};

class FileLogWriter implements LogWriterInterface {
	public function __construct() {
		
		// TODO: implement
		
	}
	
	public function __destruct() {
		
		// TODO: implement
		
	}
	
	public function write($text) {
		
		// TODO: implement
		
	}
};

class Logger {
	
	static public function getInstance() : LogWriterInterface {
		if (Logger::$console_debug) {
			return new ConsoleLogWriter;
		} else {
			return new FileLogWriter;
		}
	}
	
	static public function setConsoleDebug($debug) {
		Logger::$console_debug = $debug;
	}
	
	static private $console_debug = true;
};

?>