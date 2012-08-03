<?php
/**
 * The following filter allows any library's templates to be overridden.
 * This allows for greater control over the look of your application when
 * using 3rd party libraries without mucking around in the library code
 * which can, of course, lead to all sort of maintenance issues.
 * 
 * Ultimately, we need to allow the following to happen:
 * 1. If nothing is passed in the Libraries::add() config, then the layout and template will be used from the library (default behavior).
 * 2. If Libraries::add() passes a config to use layout templates from the main app, (the default.html.php or a specific template)...use that.
 * 3. If Libraries::add() passes a config to look for view templates in the main app, do so.
 * 4. Also consider elements and how they may need to work.
 */
use lithium\action\Dispatcher;
use lithium\core\Libraries;

Dispatcher::applyFilter('_callable', function($self, $params, $chain) {

	if(isset($params['params']['library'])) {

		/**
		 * LAYOUTS AND TEMPLATES
		 * Note the path ordering for how templates override others.
		 * 1. Your overrides.
		 * 2. The default render paths for a library.
		 */
		$paths['layout'] = array(
			LITHIUM_APP_PATH . '/views/_libraries/' . $params['params']['library'] . '/layouts/{:layout}.{:type}.php',
			'{:library}/views/layouts/{:layout}.{:type}.php'
		);
		$paths['template'] = array(
			LITHIUM_APP_PATH . '/views/_libraries/' . $params['params']['library'] . '/{:controller}/{:template}.{:type}.php',
			'{:library}/views/{:controller}/{:template}.{:type}.php'
		);

		/**
		 * ELEMENTS
		 * This will allow the main application to still render it's elements 
		 * even though the View() class may be dealing with one of this library's
		 * controllers, which would normally suggest the element comes from the library
		 * Again, note the ordering here for how things override others.
		 * 1. Your overrides are considered first.
		 * 2. Elements that may come with the library.
		 * 3. Common elements that may have came with Lithium Bootstrap (or that you added) that a library wants to use.
		 */
		$paths['element'] = array( 
			LITHIUM_APP_PATH . '/views/_libraries/' . $params['params']['library'] . '/elements/{:template}.{:type}.php',
			'{:library}/views/elements/{:template}.{:type}.php',
			LITHIUM_APP_PATH . '/views/elements/{:template}.{:type}.php'
		);

		$params['options']['render']['paths'] = $paths;

	}

	return $chain->next($self, $params, $chain);
});
?>