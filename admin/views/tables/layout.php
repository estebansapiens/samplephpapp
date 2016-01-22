<div class="panel-heading"><?=$datatitle?></div>
<div class="panel-body">
	<p>
		<button special-action="//<?=$GLOBALS['maincontrol']->adminDirectory?>forms/<?=$scriptname?>/create.php" title="Agregar Miembro(a)..." class="btn btn-success btn-md editbtn"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Agregar <?=$dataname?></button>
	</p>
	<table class="table table-striped table-bordered" id="<?=$tableid?>" cellspacing="0" width="100%">
		<thead>
			<tr>
				<?php 
				foreach ($tablecolumns as $column) {
				?>
				<th><?=$column?></th>
				<?php	
				}
				?>
				<th>Acciones</th>
			</tr>
		</thead>
	</table>
</div>
<script>
$('#<?=$tableid?>').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "//<?=$GLOBALS['maincontrol']->adminDirectory?>views/ajaxdata/<?=$scriptname?>.php",
    "order": [[ 1, 'asc' ]],
    "columnDefs": [ 
		{
            "targets": [ 0 ],
            "visible": false,
            "searchable": false
        },
    ]
} );
</script>