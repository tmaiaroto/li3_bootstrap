<?php
/**
 * This really only adds a default MongoDB connection assuming MongoDB is
 * running locally. It is the first file included, if you wish to modify
 * this default 'li3b_mongodb' connection then simply make a new file
 * with your config in the config/connections directory. Ensure it is
 * named so that it gets included after this file. Files are loaded 
 * in alphabetical order.
 * 
 * There will be a connection setup wizard in the future via
 * command line. Possibly even through the admin interface.
 * This will allow users to create new configuration files.
 * The problem with most databses (even MongoDB) is that there
 * are usernames and passwords that are completely impossible
 * to guess or assume. MongoDB can run protected by iptables
 * without a username/password locally. Therefore it's easy
 * to assume a configuration for it. Especially for local
 * development.
 * 
 * Lithium Bootstrap (and libraries built for it) should use
 * connection configurations named: 'li3b_mongodb' or 'li3b_mysql'
 * and so on.
 * 
 * Add-on libraries may even want to put some instructions
 * in a README explaining how to configure the connection and/or
 * checks in the code that would ultimately alert the developer
 * that they need to configure a connection when they went to
 * load the application.
 * 
 * Models should also prefix their sources with a value
 * to help avoid table/collection conflicts.
 * 
 */
use lithium\data\Connections;

Connections::add(
	'li3b_mongodb', array(
		'production' => array(
			'type' => 'MongoDb',
			'host' => 'localhost',
			'database' => 'li3bootstrap'
		),
		'development' => array(
			'type' => 'MongoDb',
			'host' => 'localhost',
			'database' => 'li3bootstrap_dev'
		),
		'test' => array(
			'type' => 'database', 
			'adapter' => 'MongoDb', 
			'database' => 'li3bootstrap_test', 
			'host' => 'localhost'
		)
	)
);

/*
 * TODO: Add mysql... of course there's usernames and passwords... 
 * also for mongodb in some cases... so we need a connection manager.
 Connections::add('default', array(
	'type' => 'database',
 	'adapter' => 'MySql',
 	'host' => 'localhost',
 	'login' => 'root',
 	'password' => '',
 	'database' => 'my_app',
 	'encoding' => 'UTF-8'
 ));
 * 
 */
?>