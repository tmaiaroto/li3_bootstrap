<?php
use lithium\net\http\Router;
// Get the current URL (false excludes the domain)
$here = $this->html->here(false);
?>
<div class="well sidebar-nav">
	<ul class="nav nav-list">
		<li class="nav-header">All About You</li>
		<?php
			$discover_menu_items = $this->bootstrapMenu->static_menu('user', array('return_data' => true)); 
			foreach($discover_menu_items as $item) {
				$matched_route = Router::match($item['url']);
				$active = $matched_route == $here ? 'active':'';
				echo '<li class="' . $active . '">' . $this->html->link($item['title'], $item['url']) . '</li>';
			}
		?>
		<li class="nav-header">Discover</li>
		<?php
			$discover_menu_items = $this->bootstrapMenu->static_menu('user_discover', array('return_data' => true)); 
			foreach($discover_menu_items as $item) {
				$matched_route = Router::match($item['url']);
				$active = $matched_route == $here ? 'active':'';
				echo '<li class="' . $active . '">' . $this->html->link($item['title'], $item['url']) . '</li>';
			}
		?>
	</ul>
</div><!--/.well -->