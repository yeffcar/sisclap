<?php
	$this->load->helper('array');
?>
<div class="main">
	<div class="container">
		<div class="row">
			<div class="col s12">
				<div class="card banner">
					<div class="card-image">
						<a class='dropdown-button right' href='#' data-activates='dropdown'><i class="material-icons">more_vert</i></a>
						<?php echo $options; ?>
						<img src="<?php echo base_url('img/profile/usertop.jpg'); ?>">
					</div>
					<div class="avatar">
						<a href="#modal2" class="modal-trigger">
							<?php if (array_key_exists('avatar',$userdata[0])): ?>
								<?php if (is_file('./img/profile/'.$userdata[0]['id'].'_thumb.jpg')): ?>
								<img class="circle" src="<?php echo base_url('img/profile/'.$userdata[0]['id'].'_thumb.jpg'); ?>" alt="Avatar">
								<?php else: ?>
								<?php if (is_file('./img/profile/'.$userdata[0]['id'].'_thumb.png')): ?>
									<img class="circle" src="<?php echo base_url('img/profile/'.$userdata[0]['id'].'_thumb.png'); ?>" alt="Avatar">
								<?php endif ?>
								<?php endif ?>
							<?php else: ?>
						<i class="material-icons circle grey lighten-5 z-depth-1">account_circle</i>
						<?php endif ?>
					</a>
					</div>
					
					<div class="card-content row">
						<div class="col s12 m6">
							<span class="card-title"><?php echo $userdata[0]['nombre'] ?> <?php echo $userdata[0]['apellido'] ?></span><br>
							<span class=""><?php echo $userdata[0]['name'] ?></span>
						</div>
						<div class="col s12 m6">
							<span class="card-title"><?php echo $userdata[0]['username'] ?></span>
							<p>
								Ultima vez: <?php echo $userdata[0]['lastseen'] ?>
							</p>
						</div>
						
						
					</div>
				</div>
			</div>
			<div class="col s12 m5">
				<ul class="collection with-header">
					<li class="collection-header"><h4>Datos del usuario</h4></li>
					<li class="collection-item"><i class="material-icons left">message</i> <?php echo $userdata[0]['cedula'] ?></li>
					<li class="collection-item"><i class="material-icons left">mail</i><a href="mailto:<?php echo $userdata[0]['email'] ?>"><?php echo $userdata[0]['email'] ?></a> </li>
					<li class="collection-item"><i class="material-icons left">contact_phone</i> <a href="tel:<?php echo $userdata[0]['telefono'] ?>"><?php echo $userdata[0]['telefono'] ?></a></li>
					<li class="collection-item"><i class="material-icons left">location_on</i> <?php echo $userdata[0]['direccion'] ?></li>
					<?php if (array_key_exists('create by',$userdata[0])): ?>
						<li class="collection-item"><i class="material-icons left">perm_contact_calendar</i> Registrado por <a href="<?php echo base_url('admin/user/ver/'.$userdata[0]['idcreateby']); ?>"><?php echo $userdata[0]['create by'] ?></a></li>
					<?php endif ?>
				</ul>
			</div>
			<div class="col s12 m7 timeline">
				<?php echo $timeline; ?>
			</div>
		</div>
	</div>
</div>
<div id="modal2" class="modal bottom-sheet">
	<div class="modal-content">
		<h4>Cambiar foto de perfil</h4>
		<?php echo $form ?>
	</div>
	<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
	</div>
</div>
<div id="<?php echo $modalid; ?>" class="modal" >
	<div class="modal-content">
		<h4><i class="material-icons">warning</i> Eliminar usuario</h4>
		<p>¿Desea eliminar éste usuario?</p>
	</div>
	<div class="modal-footer">
		<a href="#!" data-action="acept" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
		<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
	</div>
</div>
