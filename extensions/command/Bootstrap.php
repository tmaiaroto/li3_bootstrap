<?php

namespace li3Bootstrap\extensions\command;

use lithium\util\Set;
use lithium\util\Inflector;
use lithium\data\Connections;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use DirectoryIterator;

class Bootstrap extends \lithium\console\Command {

	
	/**
	 * Generates the appropriates indexes for the words collection.
	 *
	 * @param $packageName The name of the library/plugin to install.
	 * @return void
	*/
	public static function install($packageName=null) {
		if(empty($packageName)) {
			echo "No package name provided." . PHP_EOL;
			exit();
		}
		
		// get from the 
		
		echo "Installation complete!" . PHP_EOL;
	}
}
?>