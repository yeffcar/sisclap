<div class="main">
	<?php echo $header; ?>
	<div class="container">
		<div class="row">
			<div class="col s12">
				<div class="panel panel-default">
					<div class="row event">
						<?php
							$this->load->helper('array');

							$modalid = random_string('alnum', 16);
						?>
						<?php
							$quotes = array(" indigo", "blue", " cyan", "grey", " teal", "green", "blue-grey", "pink");
							$deep = array("darken-1", "accent-3", 'lighten-1', '');
						?>
						<?php if ($claps): ?>
						<?php foreach ($claps as $clap): ?>
						<?php
							$itemid = random_string('alnum', 16);
							$ddmid = random_string('alnum', 16);
							$checkbox_id = random_string('alnum', 16);
						?>						
						<div class="col m6 s12 l4 video" id="<?php echo $itemid; ?>">
							<div class="card" style="overflow: visible">
							<?php if ($this->session->userdata('level')=='1'): ?>
								<div class="card-chekbox-content">
								<input type="checkbox" class="card-checkbox filled-in" id="<?php echo $checkbox_id ?>" value="<?php echo $clap['id'] ?>" data-target-element="#<?php echo $itemid; ?>"/>
								<label for="<?php echo $checkbox_id ?>"></label>
							</div>
							
								<a class='dropdown-button right' href='#' data-activates='<?php echo $ddmid ?>'><i class="material-icons">more_vert</i></a>
								<ul id='<?php echo $ddmid ?>' class='dropdown-content'>
									<?php if (4 > $this->session->userdata('level')): ?>
									<li><a href="<?php echo base_url('admin/clap/editardatos/'.$clap['id']); ?>" title="Editar">Editar</a></li>
									<?php endif ?>
									<?php if (3 > $this->session->userdata('level')): ?>
									<li><a href="#<?php echo $modalid; ?>" class="modal-trigger"  data-action-param='{"id":[<?php echo $clap['id'] ?>], "table":"datos_clap"}' data-url="admin/clap/fn_ajax_delete_data" data-ajax-action="inactive" data-target-selector="<?php echo "#$itemid"; ?>">Eliminar</a></li>
									<?php endif ?>
									<li><a href="<?php echo base_url('admin/clap/ver/'.$clap['id']) ?>" title="Ver">Ver</a>
								</li>
							</ul>
							<?php endif ?>
							<div class="card-content  <?php echo random_element($quotes).' '.random_element($deep);?>">
								<span class="card-title"><?php echo $clap['nombre'] ?></span>
							</div>
							<div class="card-content">
								<span class="activator grey-text text-darken-4">
									<a href="<?php echo base_url('admin/clap/ver/'.$clap['id']) ?>" title="Ver">Ver detalles</a>
									<?php if ($clap['status'] === '1'): ?>
									<i class="material-icons tooltipped right" data-position="left" data-delay="50" data-tooltip="Activo">assignment_ind</i>
									<?php else: ?>
									<i class="material-icons tooltipped right" data-position="left" data-delay="50" data-tooltip="Inactivo">lock</i>
									<?php endif ?>
								</span>
							</div>
							<div class="card-reveal">
								<span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
								<p><?php echo 'Fecha: '.$clap['fecha'] ?><br>
									
								</p>
							</div>
						</div>
					</div>
					<?php endforeach ?>
					<?php else: ?>
					No hay clap creados todavía
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php if ($this->session->userdata('level')=='1'): ?>
	<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
		<a class="btn-floating btn-large red waves-effect waves-teal btn-flat new tooltipped" data-position="left" data-delay="50" data-tooltip="Registrar clap" href="<?php echo base_url('admin/user/nuevo/responsable') ?>">
			<i class="large material-icons">add</i>
		</a>
	</div>
<?php endif ?>
<div id="<?php echo $modalid; ?>" class="modal" >
	<div class="modal-content">
		<h4><i class="material-icons">warning</i> Eliminar clap</h4>
		<p>¿Desea eliminar ésta clap?</p>
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
	<a class="opt-delete tooltipped btn-delete-multiple modal-trigger" data-position="left" data-delay="50" data-tooltip="Borrar" href="#<?php echo $modalid; ?>" data-action-param='{"table":"datos_clap"}' data-url="admin/clap/fn_ajax_delete_data" data-ajax-action="inactive" data-target-selector="#">
		<i class="material-icons">delete</i>
	</a>
	<?php endif ?>
	</a><a href="#" class="opt-options dropdown-button white-text" data-activates="<?php echo $ddmid; ?>"><i class="material-icons">more_vert</i></a>
	<ul id="<?php echo $ddmid; ?>" class='dropdown-content'>
		<li><a href="#" data-option-select-all="true">Seleccionar todo</a></li>
	</ul>
</div>