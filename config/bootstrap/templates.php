<?php
/**
 * The following filter allows any library's templates to be overridden.
 * This allows for greater control over the look of your application when
 * using 3rd party libraries without mucking around in the library code
 * which can, of course, lead to all sort of maintenance issues.
 * 
 * Ultimately, we need to allow the following to happen:
 * 1. If there are no override templates, then the layout and view template will be used from the library (default behavior).
 * 2. If there are templates placed in `/views/_libraries/library_name/`, use those.
 * 3. Try the main application as a last ditch effort. Libraries without templates will assume the main app has them.
 * 4. If Libraries::add() passes a config that specifically says to use templates from the main app, do so.
 * 5. Also consider elements and how they may need to work.
 */
use lithium\action\Dispatcher;
use lithium\core\Libraries;

Dispatcher::applyFilter('_callable', function($self, $params, $chain) {
	
	//var_dump($params['params']);
	//exit();
	
	if(isset($params['params']['library'])) {
		// Instead of using LITHIUM_APP_PATH,for future compatibility.
		$defaultAppConfig = Libraries::get('li3Bootstrap');
		$appPath = $defaultAppConfig['path'];

		$libConfig = Libraries::get($params['params']['library']);
		
		/**
		 * LAYOUTS AND TEMPLATES
		 * Note the path ordering for how templates override others.
		 * First, your overrides and then the default render paths for a library.
		 * Last, (worst case) it tries to grab what it can from the main application.
		 */
		$paths['layout'] = array(
			$appPath . '/views/_libraries/' . $params['params']['library'] . '/layouts/{:layout}.{:type}.php',
			'{:library}/views/layouts/{:layout}.{:type}.php',
			$appPath . '/views/layouts/{:layout}.{:type}.php'
		);
		$paths['template'] = array(
			$appPath . '/views/_libraries/' . $params['params']['library'] . '/{:controller}/{:template}.{:type}.php',
			'{:library}/views/{:controller}/{:template}.{:type}.php',
			$appPath . '/views/{:controller}/{:template}.{:type}.php'
		);
		
		/*
		 * Condition #4 here. This will use Lithium Bootstrap's core layout templates.
		 * Libraries added with this configuration option were designed specifically
		 * for use with Lithium Bootstrap and wish to use it's default design.
		 * 
		 * Of course, there is still template fallback support in case the user
		 * has changed up their copy of Lithium Bootstrap...But the library is
		 * now putting the priority on the Lithium Bootstrap default layout.
		 */
		if(isset($libConfig['useBootstrapLayout']) && $libConfig['useBootstrapLayout'] === true) {
			$paths['layout'] = array(
				$appPath . '/views/layouts/{:layout}.{:type}.php',
				$appPath . '/views/_libraries/' . $params['params']['library'] . '/layouts/{:layout}.{:type}.php',
				'{:library}/views/layouts/{:layout}.{:type}.php'
			);
		}

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
			$appPath . '/views/_libraries/' . $params['params']['library'] . '/elements/{:template}.{:type}.php',
			'{:library}/views/elements/{:template}.{:type}.php',
			$appPath . '/views/elements/{:template}.{:type}.php'
		);

		$params['options']['render']['paths'] = $paths;

	}

	return $chain->next($self, $params, $chain);
});
?>