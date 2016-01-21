<div id="popupModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
<footer class="pm-admin-footer animated fadeInUp" role="contentinfo">
	<div class="container">
		<p>
			Diseñado y programado por <?=($GLOBALS['systemconfigs']->appDetails['authorURL']!="")?'<a href="'.$GLOBALS['systemconfigs']->appDetails['authorURL'].'" target="_blank">'.$GLOBALS['systemconfigs']->appDetails['author'].'</a>':$GLOBALS['systemconfigs']->appDetails['author']?>.
		</p>
		<ul class="text-muted">
			<li>
				Version 0.5b
			</li>
			<li>
				·
			</li>
			<li>
				<a href="http://getbootstrap.com" target="_blank">Bootstrap 3.3.5</a>
			</li>
			<li>
				·
			</li>
			<li>
				<a href="http://jquery.com/" target="_blank">JQuery 1.11</a>
			</li>
			<li>
				·
			</li>
			<li>
				<a href="https://www.mysql.com/" target="_blank">MySQL 5.6</a>
			</li>
		</ul>
	</div>
	<p>
		<?=$GLOBALS['systemconfigs']->appDetails['copyright']?> <?=$GLOBALS['systemconfigs']->appDetails['appName']?>
	</p>
</footer>