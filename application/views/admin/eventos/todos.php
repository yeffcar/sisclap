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
				<?php if ($arrayEventos): ?>
				<?php foreach ($arrayEventos as $array): ?>
				<?php 
					$itemid = random_string('alnum', 16);
					$ddmid = random_string('alnum', 16);
					$checkbox_id = random_string('alnum', 16);
				?>
					<div class="col m6 s12" id="<?php echo $itemid; ?>">
					<div class="card">
						<div class="card-chekbox-content">
								<input type="checkbox" class="card-checkbox filled-in" id="<?php echo $checkbox_id ?>" value="<?php echo $array['id'] ?>" data-target-element="#<?php echo $itemid; ?>"/>
								<label for="<?php echo $checkbox_id ?>"></label>
							</div>
						<a class='dropdown-button right' href='#' data-activates='<?php echo $ddmid ?>'><i class="material-icons">more_vert</i></a>
							<ul id='<?php echo $ddmid ?>' class='dropdown-content'>
								<?php if (4 > $this->session->userdata('level')): ?>
								<li><a href="<?php echo base_url('admin/Eventos/Editar/'.$array['id']); ?>" title="Editar">Editar</a></li>
								<?php endif ?>
								<?php if (3 > $this->session->userdata('level')): ?>
									<li><a href="<?php echo "#$modalid"; ?>" class="modal-trigger" data-action-param='{"id":[<?php echo $array['id'] ?>], "table":"eventos"}' data-url="admin/Eventos/fn_ajax_delete_data" data-ajax-action="inactive" data-target-selector="<?php echo "#$itemid"; ?>">Eliminar</a></li>
								<?php endif ?>
								<li><a href="<?php echo base_url('admin/Eventos/Ver/'.$array['id']); ?>" title="Ver">Ver</a>
									</li>
							</ul>
						<div class="card-image waves-effect waves-block waves-light">
							<img class="activator" src="<?php echo base_url($array['imagen']); ?>">
							 <span class="card-title"><?php echo $array['nombre'] ?></span>
						</div>
						<div class="card-content">
							<span class="activator grey-text text-darken-4">
							<?php echo $array['titulo'] ?>
							</span>
							<?php if ($array['status'] === '1'): ?>
							<i class="material-icons tooltipped right" data-position="left" data-delay="50" data-tooltip="Publico">assignment_ind</i>
							<?php else: ?>
							<i class="material-icons tooltipped right" data-position="left" data-delay="50" data-tooltip="Privado">lock</i>
							<?php endif ?>
						</div>
						    <div class="card-reveal">
					      <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
					      <p><?php echo $array['fecha'] ?><br>
					      	<?php echo $array['ciudad'] ?><br>
					      </p>
					    </div>
					</div>
				</div>
				<?php endforeach ?>
				<?php else: ?>
					No hay Eventos
				<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;"><a class="btn-floating btn-large red waves-effect waves-teal btn-flat new tooltipped" data-position="left" data-delay="50" data-tooltip="Crear Evento"  href="<?php echo base_url('admin/eventos/agregar/') ?>"><i class="large material-icons">add</i></a>
	<ul>
	    <li><a class="btn-floating yellow darken-1 tooltipped" data-position="left" data-delay="50" data-tooltip="Nueva categoria"  href="<?php echo base_url('admin/categorias/nueva/evento') ?>"><i class="material-icons">insert_chart</i></a></li>
	</ul>
</div>
<div id="<?php echo $modalid; ?>" class="modal">
	<div class="modal-content">
		<h4><i class="material-icons">warning</i> Eliminar Evento</h4>
		<p>¿Desea eliminar este Evento?</p>
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
	<a class="opt-delete tooltipped btn-delete-multiple modal-trigger" data-position="left" data-delay="50" data-tooltip="Borrar" href="#<?php echo $modalid; ?>" data-action-param='{"table":"eventos"}' data-url="admin/eventos/fn_ajax_delete_data" data-ajax-action="inactive" data-target-selector="#">
		<i class="material-icons">delete</i>
	</a>
	<?php endif ?>
	</a><a href="#" class="opt-options dropdown-button white-text" data-activates="<?php echo $ddmid; ?>"><i class="material-icons">more_vert</i></a>
	<ul id="<?php echo $ddmid; ?>" class='dropdown-content'>
		<li><a href="#" data-option-select-all="true">Seleccionar todo</a></li>
	</ul>
</div>