<?php
use lithium\analysis\Logger;
use lithium\core\Libraries;

// Again, like sessions.php this will allow other libraries to
// set Logger confiurations without them being overwritten here.
$config = Logger::config();
$config += array(
	'default' => array(
		'adapter' => 'File',
		'priority' => array(
			'debug', 'alert', 'error'
		)
	)
);

Logger::config($config);
?>