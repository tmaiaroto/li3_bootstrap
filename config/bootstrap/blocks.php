<?php
/**
 * This uses the example 'helloworld' block position from the
 * li3b_core BootstrapBlock model.
 */
use li3b_core\models\BootstrapBlock;

/**
 * This is an example of how to re-order blocks.
 * Note that it comes before the following filter which
 * actually adds to the blocks, yet it still knows about
 * and orders the block that gets added below.
 *
 * You can order blocks however you like from just about
 * where ever you like. This allows multiple libraries to
 * add to the same block positions and not worry about order.
 * It is up to the developer using the libraries to then order
 * the blocks however they see fit. This is good because it's
 * practically impossible to guess what other people may add and
 * then guess what order someone may want all the blocks to be in.
 */
BootstrapBlock::applyFilter('order', function($self, $params, $chain) {
	// Example ordering. Changing key values and then running a ksort(). The key values can be anything really.
	// This ordering is only applied to the 'helloword' block position.
	if($params['position'] == 'helloworld') {
		$result = $chain->next($self, $params, $chain);


		$result[0] = $result[2];
		unset($result[2]);

		// Note the use of SORT_STRING, this will allow keys with numbers and letters to both be accounted for.
		ksort($result, SORT_STRING);

		return $result;
	}
	return $chain->next($self, $params, $chain);
});

/**
 * You can add blocks by filtering the staticBlock() method.
 * This works very similar to static menus.
 * Keey in mind you can define blocks with a `content` string
 * value which holds the exact content to use, or you can
 * specify an array for the content value which contains
 * options for rendering a template. You would pass the library
 * name (if applicable) and template name. Technically even a
 * `type` key...It is just a View::render() that's being called.
 * However, by default the render paths will be set to look in
 * a `blocks` directory which works much like elements.
 * Of course these block templates can also be overridden.
 */
BootstrapBlock::applyFilter('staticBlock', function($self, $params, $chain) {

	if($params['position'] == 'helloworld') {
		$self::$staticBlocks['helloworld']['zlast']['content'] = 'Last block position.';
	}

	return $chain->next($self, $params, $chain);
});
?>