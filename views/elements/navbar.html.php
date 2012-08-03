<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
	<div class="container">
		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</a>
		<?php echo ($this->request()->user) ? $this->html->link('Scottys', array('controller' => 'users', 'action' => 'dashboard'), array('class' => 'brand')):$this->html->link('Lithium Bootstrap', '/', array('class' => 'brand')); ?>
		<div class="btn-group pull-right">
		<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			<i class="icon-user"></i> <?=$user['first_name'] . ' ' . $user['last_name']; ?>
			<span class="caret"></span>
		</a>
		<ul class="dropdown-menu">
			<li><a href="#">Profile</a></li>
			<li class="divider"></li>
			<li><a href="/logout">Sign Out</a></li>
		</ul>
		</div>
		<div class="nav-collapse">
			<?=$this->bootstrapMenu->static_menu('public', array('menu_class' => 'nav', 'current_class' => 'active')); ?>
		</div><!--/.nav-collapse -->
	</div>
	</div>
</div>