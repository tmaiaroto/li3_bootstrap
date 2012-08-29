<?php
use li3b_core\models\BootstrapMenu as Menu;

/**
 * Apply filters to Menu::staticMenu() in order to alter and create new menus.
 * The following is an example. You can apply this filter just about anywhere,
 * it does not need to be in this bootstrap file...Though, it's a pretty good
 * place. Another good place is under the bootstrap for your own libraries.
*/

/*
Menu::applyFilter('staticMenu',  function($self, $params, $chain) {
	if($params['name'] == 'admin') {
		$self::$staticMenus['admin']['someKeyThatDeterminesMenuItemPositionOrderedAlphabetically'] = array(
			'title' => 'Menu Dropdown Title <b class="caret"></b>',
			'url' => '#',
			'activeIf' => array('controller' => 'example'),
			'options' => array('escape' => false),
			'subItems' => array(
				array(
					'title' => 'List All',
					'url' => array('admin' => true, 'controller' => 'example', 'action' => 'index')
				),
				array(
					'title' => 'Create New',
					'url' => array('admin' => true, 'controller' => 'example', 'action' => 'create')
				)
			)
		);
	}
	
	return $chain->next($self, $params, $chain);
});
*/
?>