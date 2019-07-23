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
						<?php if ($jefess): ?>
						<?php foreach ($jefess as $jefes): ?>
						<?php
							$itemid = random_string('alnum', 16);
							$ddmid = random_string('alnum', 16);
							$checkbox_id = random_string('alnum', 16);
						?>						
						<div class="col m6 s12 l4 video" id="<?php echo $itemid; ?>">
							<div class="card" style="overflow: visible">
							<div class="card-chekbox-content">
								<input type="checkbox" class="card-checkbox filled-in" id="<?php echo $checkbox_id ?>" value="<?php echo $jefes['id'] ?>" data-target-element="#<?php echo $itemid; ?>"/>
								<label for="<?php echo $checkbox_id ?>"></label>
							</div>
						<a class='dropdown-button right' href='#' data-activates='<?php echo $ddmid ?>'><i class="material-icons">more_vert</i></a>
								<ul id='<?php echo $ddmid ?>' class='dropdown-content'>
									<?php if (4 > $this->session->userdata('level')): ?>
									<li><a href="<?php echo base_url('admin/videos/editar/'.$jefes['id']); ?>" title="Editar">Editar</a></li>
									<?php endif ?>
									<?php if (3 > $this->session->userdata('level')): ?>
									<li><a href="#<?php echo $modalid; ?>" class="modal-trigger"  data-action-param='{"id":[<?php echo $jefes['id'] ?>], "table":"video"}' data-url="admin/videos/fn_ajax_delete_data" data-ajax-action="inactive" data-target-selector="<?php echo "#$itemid"; ?>">Eliminar</a></li>
									<?php endif ?>
									<li><a href="<?php echo base_url('admin/videos/ver/'.$jefes['id']) ?>" title="Ver">Ver</a>
								</li>
							</ul>
							<div class="card-image waves-effect waves-block waves-light">
								<img class="activator" src="<?php echo base_url($jefes['preview']); ?> ?>">
								<span class="card-title"><?php echo $jefes['nombre'] ?></span>
							</div>
							<div class="card-content">
								<span class="activator grey-text text-darken-4">
									<a href="<?php echo base_url('admin/videos/ver/'.$jefes['id']) ?>" title="Ver"><?php echo $jefes['nombre'] ?>
									</a>
									<?php if ($jefes['status'] === '1'): ?>
									<i class="material-icons tooltipped right" data-position="left" data-delay="50" data-tooltip="Publico">assignment_ind</i>
									<?php else: ?>
									<i class="material-icons tooltipped right" data-position="left" data-delay="50" data-tooltip="Privado">lock</i>
									<?php endif ?>
								</span>
							</div>
							<div class="card-reveal">
								<span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
								<p><?php echo 'Fecha: '.$jefes['fecha'] ?><br>
									<?php echo $jefes['youtubeid'] ?><br>
								</p>
							</div>
						</div>
					</div>
					<?php endforeach ?>
					<?php else: ?>
					No hay videos todavía
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
	<a class="btn-floating btn-large red waves-effect waves-teal btn-flat new tooltipped" data-position="left" data-delay="50" data-tooltip="Crear video" href="<?php echo base_url('admin/videos/nuevo/') ?>">
		<i class="large material-icons">add</i>
	</a>
	<ul>
	    <li><a class="btn-floating yellow darken-1 tooltipped" data-position="left" data-delay="50" data-tooltip="Nueva categoria"  href="<?php echo base_url('admin/categorias/nueva/video') ?>"><i class="material-icons">insert_chart</i></a></li>
	</ul>
</div>

<div id="<?php echo $modalid; ?>" class="modal" >
	<div class="modal-content">
		<h4><i class="material-icons">warning</i> Eliminar video</h4>
		<p>¿Desea eliminar ésta video?</p>
	</div>
	<div class="modal-footer">
		<a href="#!" data-action="acept" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
		<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
	</div>
</div>
<a href="#" class="opt-return left done_all"><i class="material-icons">close</i></a>
<div class="multiple-options">
	<?php $ddmid = random_string('alnum', 16); ?>
	<?php if ($this->session->userdata('level')<3): ?>	
	<a class="opt-delete tooltipped btn-delete-multiple modal-trigger" data-position="left" data-delay="50" data-tooltip="Borrar" href="#<?php echo $modalid; ?>" data-action-param='{"table":"video"}' data-url="admin/videos/fn_ajax_delete_data" data-ajax-action="inactive" data-target-selector="#">
		<i class="material-icons">delete</i>
	</a>
	<?php endif ?>
	</a><a href="#" class="opt-options dropdown-button white-text" data-activates="<?php echo $ddmid; ?>"><i class="material-icons">more_vert</i></a>
	<ul id="<?php echo $ddmid; ?>" class='dropdown-content'>
		<li><a href="#" data-option-select-all="true">Seleccionar todo</a></li>
	</ul>
</div>