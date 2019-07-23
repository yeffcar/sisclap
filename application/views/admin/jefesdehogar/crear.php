<?php 
	$modalid = random_string('alnum', 16);	
?>
<div class="main">
	<?php echo $header ?>
	<div class="container">
		<div class="row">
			<form action="<?php echo base_url($action);?>" method="post" id="form" class="col s12 m10 l10">
				<input type="hidden" name="id" value="<?php echo element('id', $jefe, ''); ?>">
				<span class="header grey-text text-darken-2">Datos básicos <i class="material-icons left">description</i></span>
				<div class="input-field">
					<label for="cedula" >Cédula:</label>
					<input type="text" id="cedula" name="cedula" required="required" value="<?php echo element('cedula', $jefe, ''); ?>" data-segment-url="admin/clap/fn_ajax_check_value/" data-value="<?php echo element('cedula', $jefe, ''); ?>" data-action-param='{"table":"jefe_hogar", "field":"cedula"}' class="fn_checkvalue validate">
				</div>
				<div class="input-field">
					<label for="nombre" >Nombre:</label>
					<input type="text" id="nombre" name="nombre" required="required" value="<?php echo element('nombre', $jefe, ''); ?>">
				</div>
				<div class="input-field">
					<label for="apellido" >Apellido:</label>
					<input type="text" id="apellido" name="apellido" required="required" value="<?php echo element('apellido', $jefe, ''); ?>">
				</div>
				<div class="input-field">
					<label for="email" >Email:</label>
					<input type="email" id="email" name="email" required="required" value="<?php echo element('email', $jefe, ''); ?>">
				</div>
				<div class="input-field">
					<label for="telefono" >Teléfono:</label>
					<input type="text" id="telefono" name="telefono" required="required" value="<?php echo element('telefono', $jefe, ''); ?>">
				</div>	
				<div class="input-field">
					<label for="direccion" > Dirección:</label>
					<input type="text" id="direccion" name="direccion" required="required" value="<?php echo element('direccion', $jefe, ''); ?>">
				</div>	
				<div class="input-field">
					<label for="n_miembros" >Miembros de la Familia:</label>
					<input type="number" id="n_miembros" name="n_miembros" required="required" value="<?php echo element('n_miembros', $jefe, ''); ?>">
				</div>				
				<?php if (5 > $this->session->userdata('level')): ?>
				<!-- Switch -->
				<br>
				Estatus
				<br>
				<div class="input-field">
						<div class="switch">
							<label>
								Bloqueado
								<input type="checkbox" name="status" value="1" <?php if (element('status', $jefe, '')=="1"): ?>
								checked="checked"
							<?php endif ?>>
								<span class="lever"></span>
								Desbloqueado
							</label>
						</div>
					</div>
				<?php endif ?>
				<br><br>
				<div class="input-field" id="buttons">
					<a href="<?php echo base_url('admin/videos/'); ?>" class="btn red darken-1">Cancelar</a>
					<button type="submit" class="btn btn-primary"><i class="material-icons right">done</i> Guardar</button>
				</div>
			</form>		
			<div class="col hide-on-small-only m2 l2">
				<ul class="section table-of-contents tabs-wrapper">
					<li><a href="#introduction">Información</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
