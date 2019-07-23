<?php 
	$modalid = random_string('alnum', 16);	
?>
<div class="main">
	<?php echo $header ?>
	<div class="container">
		<div class="row">
			<form action="<?php echo base_url($action);?>" method="post" id="form" class="col s12 m10 l10">
				<div id="introduction" class="section scrollspy">
				<input type="hidden" name="id" value="<?php echo element('id', $clap, ''); ?>">
				<span class="header grey-text text-darken-2">Datos básicos <i class="material-icons left">description</i></span>
				<div class="input-field">
					<label for="nombre" >Nombre:</label>
					<input type="text" id="nombre" name="nombre" required="required" value="<?php echo element('nombre', $clap, ''); ?>">
				</div>
				<div class="input-field">
					<input type="text" id="codigo" name="codigo" required="required" value="<?php echo element('codigo', $clap, ''); ?>"  data-segment-url="admin/clap/fn_ajax_check_value/" data-value="<?php echo element('codigo', $clap, ''); ?>" data-action-param='{"table":"datos_clap", "field":"codigo"}' class="fn_checkvalue validate" maxlength="75" >
					<label for="codigo" data-error="En uso">Codigo:</label>

				</div>
				<div class="input-field">
					<label for="n_consejosc" >Número de consejos comunales participantes:</label>
					<input type="number" id="n_consejosc" name="n_consejosc" required="required" value="<?php echo element('n_consejosc', $clap, ''); ?>">
				</div>
				</div>
				<div id="preview" class="section scrollspy">
					<span class="header grey-text text-darken-2">Ubicación <i class="material-icons left">description</i></span>
					<div class="input-field">
						<label for="estado" >Estado:</label>
						<input type="text" id="estado" name="estado" required="required" value="<?php echo element('estado', $clap, ''); ?>">
					</div>
					<div class="input-field">
						<label for="municipio" >Municipio:</label>
						<input type="text" id="municipio" name="municipio" required="required" value="<?php echo element('municipio', $clap, ''); ?>">
					</div>
					<div class="input-field">
						<label for="parroquia" >Parroquia:</label>
						<input type="text" id="parroquia" name="parroquia" required="required" value="<?php echo element('parroquia', $clap, ''); ?>">
					</div>
					<div class="input-field">
						<label for="direccion" >Dirección:</label>
						<input type="text" id="direccion" name="direccion" required="required" value="<?php echo element('direccion', $clap, ''); ?>">
					</div>
				</div>
				<br>
				Estatus
				<br>
				<div class="input-field">
						<div class="switch">
							<label>
								Inactivo
								<input type="checkbox" name="status" value="1" <?php if (element('status', $clap, '')=="1"): ?>
								checked="checked"
							<?php endif ?>>
								<span class="lever"></span>
								Activo
							</label>
						</div>
					</div>
				<br><br>
				<div class="input-field" id="buttons">
					<a href="<?php echo base_url('admin/clap/'); ?>" class="btn red darken-1">Cancelar</a>
					<button type="submit" class="btn btn-primary"><i class="material-icons right">done</i> Guardar</button>
				</div>
			</form>		
			<div class="col hide-on-small-only m2 l2">
				<ul class="section table-of-contents tabs-wrapper">
					<li><a href="#introduction">Información</a></li>
					<li><a href="#preview">Ubicación</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>