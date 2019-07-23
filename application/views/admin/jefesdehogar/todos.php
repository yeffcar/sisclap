<div class="main">
	<?php echo $header; ?>
	<div class="container">
		<div class="row">
			<div class="col s12">
				<div class="panel panel-default">
					<div class="row event">
						<?php
							$modalid = random_string('alnum', 16);
						?>
						<?php if ($jefes): ?>
						<table class="bordered responsive">
							<thead>
							<tr>
								<th>Cédula</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Email</th>
								<th>Telefono</th>
								<th>Dirección</th>
								<th>N° Miembros</th>
								<th>Acciones</th>
							</tr>
							</thead>
							<?php foreach ($jefes as $jefes): ?>
						<?php
							$itemid = random_string('alnum', 16);
							$ddmid = random_string('alnum', 16);
							$checkbox_id = random_string('alnum', 16);
						?>						
						
							<tbody>
								<tr id="<?php echo "$itemid"; ?>">
								<td><?php echo $jefes['cedula'] ?></td>
								<td><?php echo $jefes['nombre'] ?></td>
								<td><?php echo $jefes['apellido'] ?></td>
								<td><?php echo $jefes['email'] ?></td>
								<td><?php echo $jefes['telefono'] ?></td>
								<td><?php echo $jefes['direccion'] ?></td>
								<td><?php echo $jefes['n_miembros'] ?></td>
								<td><a href="#<?php echo $modalid; ?>" class="modal-trigger tooltipped"  data-action-param='{"id":[<?php echo $jefes['id'] ?>], "table":"jefe_hogar"}' data-url="admin/jefesdehogar/fn_ajax_delete_data" data-ajax-action="inactive" data-target-selector="<?php echo "#$itemid"; ?>" data-position="left" data-delay="50" data-tooltip="Borrar Jefe de hogar"><i class="material-icons">delete</i></a>
								<a href="<?php echo base_url('admin/jefesdehogar/editar/'.$jefes['id']) ?>" data-position="left" data-delay="50" data-tooltip="Editar Datos" class="tooltipped"><i class="material-icons">edit</i></a>
								</td>
							</tr>
							
					<?php endforeach ?></tbody>
						</table>
					<?php else: ?>
					No hay jefes todavía
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
	<a class="btn-floating btn-large red waves-effect waves-teal btn-flat new tooltipped" data-position="left" data-delay="50" data-tooltip="Agregar Jefe de hogar" href="<?php echo base_url('admin/jefesdehogar/nuevo/') ?>">
		<i class="large material-icons">add</i>
	</a>
</div>

<div id="<?php echo $modalid; ?>" class="modal" >
	<div class="modal-content">
		<h4><i class="material-icons">warning</i> Eliminar datos</h4>
		<p>¿Desea eliminar éste jefe de hogar?</p>
	</div>
	<div class="modal-footer">
		<a href="#!" data-action="acept" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
		<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
	</div>
</div>
