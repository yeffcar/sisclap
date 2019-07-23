<?php 
	$modalid = random_string('alnum', 16);
	$modalid_2 = random_string('alnum', 16);
?>
<div class="main">
	<div class="parallax-container white-text">
		<div class="parallax"><img src="<?php echo base_url('img/profile/Material-Wallpaper.jpg')  ?>"></div>
	<?php echo $header; ?>
	</div>
	<div class="container">
		<div class="row">
		<?php if ($this->session->userdata('level')==1): ?>
			<div class="col s12 ">

				<div class="section">
					Estatus
					<div class="switch">
						<label>
							No Activo
							<input type="checkbox" class="change_state" name="status" data-url="admin/clap/fn_ajax_change_state/" 
								data-action-param='{"id":"<?php echo $clap[0]['id']; ?>", "table":"datos_clap"}' <?php if ( $clap[0]['status'] == '1'): ?> checked="checked" <?php endif ?> >
							<span class="lever"></span>
							Activo
							</label>
						<a class='dropdown-button right' href='#' data-activates='albumoptions'><i class="material-icons">more_vert</i></a>
						<ul id="albumoptions" class='dropdown-content'>
							<li><a href="<?php echo base_url('admin/clap/editardatos/'.$clap[0]['id']); ?>">Editar</a></li>
							<?php if ($this->session->userdata('level')<3): ?>	
							<li><a href="#<?php echo $modalid;?>" class="modal-trigger" data-action-param='{"id":"<?php echo $clap[0]['id'] ?>", "table":"datos_clap"}' data-url="admin/clap/fn_ajax_delete_data/" data-url-redirect="admin/galeria/" data-ajax-action="inactive" >Eliminar</a></li>
							<?php endif ?>
							
						</ul>
					</div>	
				</div>
			</div>
			<?php endif ?>

			<div class="col s12 m6 ">
				<div class="section">
				<h5>Datos del Clap:</h5>
				<b>Fecha de registro:</b>	<?php echo $clap[0]['fecha'] ?> <br>
				<b>Código del clap:</b>	<?php echo $clap[0]['codigo'] ?> <br>
				<b>Consejos comunales que participan:</b>	<?php echo $clap[0]['n_consejosc'] ?> <br>
				<b>Responsable del clap:</b><a href="<?php echo base_url('admin/user/ver/'.$userdata[0]['id']); ?>"> <?php echo $userdata[0]['nombre'].' '.$userdata[0]['apellido'] ?></a>
				</div> 
				<div class="divider"></div>
				<br>
			</div>
			<div class="col s12 m6 ">
			
				<div class="section">
				<h5>Ubicacion del Clap:</h5>
				<b>Estado:</b>	<?php echo $clap[0]['estado'] ?> <br>
				<b>Municipio</b>	<?php echo $clap[0]['municipio'] ?> <br>
				<b>Parroquia</b>	<?php echo $clap[0]['parroquia'] ?> <br>
				<b>Dirección:</b>	<?php echo $clap[0]['direccion'] ?> <br>
				
				</div> 
				<div class="divider"></div>
				<br>
			</div>
		<?php if ($this->session->userdata('level')!=3): ?>
			<div class="col s12">
			<h5>Líderes asignados a este clap:</h5>
				<div class="items">
				<?php if ($lideresasignados): ?>
					<?php foreach ($lideresasignados as $key => $value): ?>
						<?php 
							$itemid = random_string('alnum', 16);
							$checkbox_id = random_string('alnum', 16);
						?>
					<div class="col m4 s6 l3" id="<?php echo $itemid; ?>">
						<div class="card">
							<div class="card-chekbox-content">
								<input type="checkbox" class="card-checkbox filled-in" id="<?php echo $checkbox_id ?>" value="<?php echo $value['id'] ?>" data-target-element="#<?php echo $itemid; ?>" data-where-condition='<?php echo '"{id_lider:'.$value['id'].'}"'; ?>'/>
								<label for="<?php echo $checkbox_id ?>"></label>
							</div>
							<div class="card-content">
								<a href="<?php echo base_url('admin/user/ver/'.$value['id']) ?>"><?php echo $value['username'] ?></a>
							</div>
						</div>
					</div>
					<?php endforeach ?>
				<?php else: ?>
					<span class="red-text">No hay líderes asignados a este clap</span>
					<br><br>
				<?php endif ?>
				</div>
			</div>
	<?php endif ?>
		</div>
	</div>
</div>
<?php if ($this->session->userdata('level')==2): ?>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
	<a class="btn-floating btn-large red modal-trigger waves-effect waves-circle waves-light tooltipped" data-position="left" data-delay="50" data-tooltip="Asignar lideres de calles"  href="<?php echo base_url('admin/user/nuevo/lider') ?>">
		<i class="large material-icons">add</i>
	</a>
</div>
<?php endif ?>
<div id="<?php echo $modalid; ?>" class="modal">
	<div class="modal-content">
		<h4>Eliminar registro</h4>
		<p>¿Desea eliminar éste registro? Esta acción no podrá deshacerse</p>
	</div>
	<div class="modal-footer">
		<a href="#!"  data-action="acept" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
	</div>
</div>

<a href="#" class="opt-return left done_all"><i class="material-icons">close</i></a>
<div class="multiple-options">
	<?php $ddmid = random_string('alnum', 16); ?>
	<?php if ($this->session->userdata('level')<3): ?>	
	<a class="opt-delete tooltipped btn-delete-multiple modal-trigger" data-position="left" data-delay="50" data-tooltip="Borrar" href="#<?php echo $modalid; ?>" data-action-param='{"table":"datos_lideres"}' data-url="admin/clap/fn_ajax_delete_data" data-ajax-action="inactive" data-target-selector="#">
		<i class="material-icons">delete</i>
	</a>
	<?php endif ?>
	</a><a href="#" class="opt-options dropdown-button white-text" data-activates="<?php echo $ddmid; ?>"><i class="material-icons">more_vert</i></a>
	<ul id="<?php echo $ddmid; ?>" class='dropdown-content'>
		<li><a href="#" data-option-select-all="true">Seleccionar todo</a></li>
	</ul>
</div>

