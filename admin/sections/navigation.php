<header role="banner" id="top" class="navbar navbar-static-top bs-docs-nav animated bounceInDown">
	<div class="container">
		<div class="navbar-header">
			<button aria-expanded="false" aria-controls="bs-navbar" data-target="#bs-navbar" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">PicMail Admin Panel</a>
		</div>
		<nav class="collapse navbar-collapse" id="bs-navbar">
			<ul id="topnav" class="nav navbar-nav nav-tabs">
				<li class="<?=($GLOBALS['pagecontrol']->currentPageName=="dashboard.php")?"active":""?>">
					<a ajax-active="ajax-it" href="/dashboard">Dashboard</a>
				</li>
				<li>
					<a ajax-active="ajax-it" href="/logs">Logs</a>
				</li>
				<li>
					<a ajax-active="ajax-it" href="/settings">Configuration</a>
				</li>
				<li>
					<a ajax-active="ajax-it" href="?logout=1">Logout</a>
				</li>
			</ul>
		</nav>
	</div>
</header>