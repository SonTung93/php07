<a id="leftmenu-trigger" class="" data-toggle="tooltip" data-placement="right" title="Toggle Sidebar"></a>
<a class="navbar-brand" href="<?php echo ROOT; ?>/admin/">Avalon</a>

<ul class="nav navbar-nav toolbar pull-right">		
	<li class="dropdown toolbar-icon-bg demo-search-hidden mr5">
		<a href="#" class="dropdown-toggle tooltips" data-toggle="dropdown"><span class="icon-bg"><i class="fa fa-fw fa-search"></i></span></a>
		
		<div class="dropdown-menu arrow search dropdown-menu-form">
			<div class="dd-header">
				<span>Search</span>
				<span><a href="#">Advanced search</a></span>
			</div>
			<div class="input-group">
				<input type="text" class="form-control" placeholder="">
				
				<span class="input-group-btn">
					
					<a class="btn btn-primary" href="#">Search</a>
				</span>
			</div>
		</div>
	</li>

	<li class="dropdown">
		<a href="#" class="dropdown-toggle username" data-toggle="dropdown">
			<span class="hidden-xs"><?php echo $currentuser->getUsername();?></span>
			<img class="img-circle" src="<?php echo ROOT ?>/admin/assets/img/avatar.png" alt="Dangerfield" />
		</a>
		<ul class="dropdown-menu userinfo">
			<li><a href="#"><span class="pull-left">Edit Profile</span> <i class="pull-right fa fa-pencil"></i></a></li>
			<li><a href="#"><span class="pull-left">Account Settings</span> <i class="pull-right fa fa-cogs"></i></a></li>
			<li><a href="#"><span class="pull-left">Help</span> <i class="pull-right fa fa-question-circle"></i></a></li>
			<li class="divider"></li>
			<li><a href="<?php echo ROOT . '/admin/login/logout'; ?>"><span class="pull-left">Sign Out</span> <i class="pull-right fa fa-sign-out"></i></a></li>
		</ul>
	</li>

</ul>