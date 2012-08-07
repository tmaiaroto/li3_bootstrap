<?php

namespace li3Bootstrap\extensions\command;

use lithium\core\Libraries;
use lithium\util\Set;
use lithium\util\Inflector;
use lithium\data\Connections;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use DirectoryIterator;

class Bootstrap extends \lithium\console\Command {
	
	private static $_packageConfig;

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
		
		Bootstrap::installDependencies($packageName);
		
		$appRoot = dirname(dirname(__DIR__));
		$libraryAddFile = $appRoot . '/config/bootstrap/libraries/' . $packageName . '.php';

		if(!file_exists($libraryAddFile)) {
			$fp = fopen($libraryAddFile, 'x+');
			
			fwrite($fp, '<?php');
			fwrite($fp, "\n");
			fwrite($fp, 'use lithium\core\Libraries;');
			fwrite($fp, "\n");
			fwrite($fp, "\n");
			fwrite($fp, "Libraries::add('{$packageName}');\n");
			fwrite($fp, "\n");
			fwrite($fp, '?>');
			
			fclose($fp);
		}
		
		if(file_exists($libraryAddFile)) {
			if(!empty(Libraries::get($packageName))) {
				echo "Installation successful!" . PHP_EOL;
			} else {
				echo "Installation failed. The library was added but it does not seem to load." . PHP_EOL;
			}
		} else {
			echo "Installation failed. Could not write the file which adds the library with Libraries::add(). You can try manually adding the library." . PHP_EOL;
		}
	}
	
	public static function installDependencies($packageName=null) {
		if(empty($packageName)) {
			echo "No package name provided." . PHP_EOL;
			exit();
		}
		
		static::_getPackageConfig($packageName);
		
		$appRoot = dirname(dirname(__DIR__));
		//$git = '/usr/bin/git';
		$git = 'git';
		
		echo "Getting the dependencies for this package...\n\n";
		if(static::$_packageConfig['dependencies']) {
			foreach(static::$_packageConfig['dependencies'] as $lib => $repo) {
				// If we did this, then we would need to include -f and that would add the plugins to the main repo.
				// We don't want that.
				// $command = 'submodule add ' . $repo . ' libraries/' . $lib;
				// system("/usr/bin/env -i HOME={$appRoot} {$git} {$command} 2>&1");
				// So instead, clone them.
				
				if(file_exists('libraries/' . $lib)) {
					// TODO: Read .git/config files and check for this.
					echo "It seems that {$lib} already exists. Please ensure that is it compatible with or is:\n {$repo}\n";
				} else {
					$command = 'clone ' . $repo . ' libraries/' . $lib;
					system("/usr/bin/env -i HOME={$appRoot} {$git} {$command} 2>&1");
				}
			}
			// Don't need this anymore. Going to leave it commented out because I can use this elsewhere.
			//system("/usr/bin/env -i HOME={$appRoot} {$git} submodule init --update --recursive 2>&1");
			echo PHP_EOL;
		}
		
	}
	
	private static function _getPackageConfig($packageName=null) {
		if($libConfig = Libraries::get($packageName)) {
			$packageConfigPath = $libConfig['path'] . '/config/config.ini';
			
			$packageConfig = file_exists($packageConfigPath) ? parse_ini_file($packageConfigPath, true):false;
			if(!$packageConfig) {
				return false;
			}
			
			$defaults = array(
				'dependencies' => false
			);
			$packageConfig += $defaults;
			
			self::$_packageConfig = $packageConfig;
		}
	}
	
	
}
?>