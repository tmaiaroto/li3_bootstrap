<?php
/**
 * Lithium Bootstrap prefers MongoDB.
 * However, it can use any other database as needed.
 *
 * Lithium Bootstrap plugins written for use with MongoDB
 * will use a common `li3b_mongodb` connection.
 *
 * The `li3b_core` library also defines the `li3b_mongodb` connection
 * just in case li3_core is used without this li3_bootstrap wrapper.
 * 
 * This file can be overwritten and configured to change that
 * database connection, or the settings can be changed by using the
 * `config.ini` file. Of course, additional database connections can
 * be added here or under any other file in the `connections` directory.
 * 
 * In the optional `config.ini` file under the `config` directory (create one
 * if it doesn't exist), ensure you have a [mongodb] section. Under that section
 * use the following keys:
 * database=
 * host=
 * timeout=
 * login=
 * password=
 * port=
 * devDatabase=
 * devHosts=
 * 
 * devHosts is a comma separated string, for ex: localhost,www.mydevsite.com
 * Same goes for host. That key will be used for the MongoDB connection, so
 * when you are using replica sets, it is a comma separate string with optional
 * port numbers after each host name. See Mongo docs for more on that one.
 */
use lithium\data\Connections;
use lithium\core\Environment;

// For CLI
$env = 'production';
if(isset($_SERVER['argv'][1])) {
	if(substr($_SERVER['argv'][1], 0, 6) == '--env=') {
		$env = substr($_SERVER['argv'][1], 6);
	}
}
if($env == 'development') {
	Environment::set('development');
}

$li3Options = false;
// Optional config.ini file sets some options.
if(file_exists(dirname(dirname(__DIR__)) . '/config.ini')) {
	$li3Options = parse_ini_file(dirname(dirname(__DIR__)) . '/config.ini', true);
	$li3Options = isset($li3Options['mongodb']) ? $li3Options['mongodb']:$li3Options;
}
if($li3Options) {
	$defaults = array(
		'database' => 'li3b_mongodb',
		'devDatabase' => 'li3b_mongodb_dev',
		'host' => 'localhost',
		// this is a good value for remote MongoDB services such as MongoLab or MongoHQ or Object Rocket, etc.
		// on a local server, this is obviously quite generous and could be lowered...
		'timeout' => 81000,
		'devHosts' => array('localhost')
	);
	$options = $li3Options += $defaults;
	if(is_string($options['devHosts'])) {
		$options['devHosts'] = explode(',', $options['devHosts']);
	}

	$httpHost = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST']:'localhost';

	if(in_array($httpHost, $options['devHosts']) || $env == 'development') {
		$options['database'] = $options['devDatabase'];
	}

	$dbOptions = array(
			'type' => 'database',
			'adapter' => 'MongoDb',
			'database' => $options['database'],
			'host' => $options['host'],
			'timeout' => $options['timeout']
	);
	if(isset($options['login'])) {
		$dbOptions['login'] = $options['login'];
	}
	if(isset($options['password'])) {
		$dbOptions['password'] = $options['password'];
	}

	Connections::add('li3b_mongodb', $dbOptions);

	// li3b_users is going to use the same database. If this is not the case,
	// you will not be able to configure it from the ini file and must overwrite
	// this connection by overwriting this file or making another file in the
	// `connections` directory. Keep in mind the order in which they are parsed.
	Connections::add('li3b_users', $dbOptions);

	// Of course set the default connection to use this MongoDB connection as well.
	// This will make it a little easier for your main application. You won't need
	// to specify the connection name in each model class.
	Connections::add('default', $dbOptions);
}

// Add your own connections here or in another file within the `connections`
// directory. You may want to consider adding another file if you wisht to
// keep up to date with the li3_bootstrap repository. Though the li3_bootstrap
// repository is meant to be forked (it is the li3_core library along with some
// others that power Lithium Bootstrap).
?>