<div class="main">
	<?php echo $header ?>
		<?php echo form_open_multipart($action, array('class' => 'container'));?>
			<div class="row step1">
				<div class="col s12 m10 l10 validate-form">
					<h4>Datos del Responsable</h4>
					<div id="initialization" class="section scrollspy">
						<div class="input-field">
							<input data-segment-url="admin/user/fn_ajax_check_value/" data-value="<?php echo element('username', $user, ''); ?>" data-action-param='{"table":"user", "field":"username"}' class="fn_checkvalue validate" maxlength="25" type="text" id="username" name="username" value="<?php echo element('username', $user, ''); ?>" required="required">
							<label for="username" data-error="En uso">Username</label>
						</div>
						<div class="input-field ">
							<input maxlength="25"   id="password"  name="password" value="<?php echo element('password', $user, ''); ?>" required="required" type="password">
							<label for="password">Contraseña</label>
						</div>
						<div class="input-field">
							<input id="email" type="email" data-segment-url="admin/user/fn_ajax_check_value/" data-value="<?php echo element('email', $user, ''); ?>" data-action-param='{"table":"user", "field":"email"}' class="fn_checkvalue validate"  name="email" value="<?php echo element('email', $user, ''); ?>" required="required" maxlength="255">
							<label for="email" data-error="En uso">Email</label>
						</div><br>
						<div class="input-field">
							<select name="usergroup">
								<?php foreach ($usergroups as $key => $value): ?><option value="<?php echo $value['id'] ?>" <?php if ($value['id']==element('usergroup', $user, '')): ?>
									selected
								<?php endif ?>><?php echo $value['name'] ?></option>
								<?php endforeach ?>
							</select>
							<label>Tipo de usuario:</label>
						</div>
					</div>
					<h4>Información adicional</h4>
					<div id="structure" class="section scrollspy">
						<div class="input-field">
							<input maxlength="20" id="cedula" " data-segment-url="admin/user/fn_ajax_check_value/" data-value="<?php echo element('cedula', $user, ''); ?>" data-action-param='{"table":"datauserstorage", "field":"_key=\"cedula\" AND _value ="}' class="fn_checkvalue validate"  type="text" name="cedula" value="<?php echo element('cedula', $user, ''); ?>">
							<label for="cedula" data-error="Cedula registrada">Cedula:</label>
						</div>
						<div class="input-field">
							<input maxlength="20" id="nombre"  type="text" name="nombre" value="<?php echo element('nombre', $user, ''); ?>">
							<label>Nombre:</label>
						</div>
						<div class="input-field">
							
							<input maxlength="20"  type="text"  id="apellido"  name="apellido" value="<?php echo element('apellido', $user, ''); ?>"><label for="apellido">Apellido:</label>
						</div>
						<div class="input-field">
							
							<input maxlength="200" type="text"   id="direccion"  name="direccion" value="<?php echo element('direccion', $user, ''); ?>"><label for="direccion">Direccion:</label>
						</div>
						<div class="input-field">
							<input maxlength="50"  type="text"  id="telefono" name="telefono" value="<?php echo element('telefono', $user, ''); ?>"><label for="telefono">Telefono:</label>
						</div>
						<br><br>
						<div class="switch">
							<label>
								Bloqueado
								<input type="checkbox" id="status" name="status" checked="checked">
								<span class="lever"></span>
								Permitido
							</label>
						</div>
						<br>
						<br>
						<div class="row userform">
							<div class="col s12" id="buttons">
								<a href="<?php echo base_url('admin/user/'); ?>" class="btn red darken-1">Cancelar</a>
								<a  href="#" id="next-step-btn" class="btn btn-primary tooltipped" data-position="right" data-delay="50" data-tooltip="Registrar Clap">Siguiente</a>
							</div>
						</div>
						<input type="hidden" name="id" value="<?php echo element('id', $user, ''); ?>">
					</div>
				
			</div>
			<div class="col hide-on-small-only m2 l2">
					<ul class="section table-of-contents tabs-wrapper">
						<li><a href="#initialization">Perfil</a></li>
						<li><a href="#structure">Información</a></li>
					</ul>
			</div>
		</div>
		<div class="row step2">
			<div class="col s12 m10 l10">
			<h4>Datos del clap asociado</h4>
				<div id="introduction" class="section scrollspy">
				<span class="header grey-text text-darken-2">Datos básicos <i class="material-icons left">description</i></span>
				<div class="input-field">
					<label for="nombre" >Nombre:</label>
					<input type="text" id="nombre" name="nombre_clap" required="required" value="<?php echo element('nombre', $clap, ''); ?>">
				</div>
				<div class="input-field">
					<input type="text" id="codigo" name="codigo_clap" required="required" value="<?php echo element('codigo', $clap, ''); ?>"  data-segment-url="admin/clap/fn_ajax_check_value/" data-value="<?php echo element('codigo', $clap, ''); ?>" data-action-param='{"table":"datos_clap", "field":"codigo"}' class="fn_checkvalue validate" maxlength="75" >
					<label for="codigo" data-error="En uso">Codigo:</label>

				</div>
				<div class="input-field">
					<label for="n_consejosc" >Número de consejos comunales participantes:</label>
					<input type="number" id="n_consejosc" name="n_consejosc_clap" required="required" value="<?php echo element('n_consejosc', $clap, ''); ?>">
				</div>
				</div>
				<div id="preview" class="section scrollspy">
					<span class="header grey-text text-darken-2">Ubicación <i class="material-icons left">description</i></span>
					<div class="input-field">
						<label for="estado" >Estado:</label>
						<input type="text" id="estado" name="estado_clap" required="required" value="<?php echo element('estado', $clap, ''); ?>">
					</div>
					<div class="input-field">
						<label for="municipio" >Municipio:</label>
						<input type="text" id="municipio" name="municipio_clap" required="required" value="<?php echo element('municipio', $clap, ''); ?>">
					</div>
					<div class="input-field">
						<label for="parroquia" >Parroquia:</label>
						<input type="text" id="parroquia" name="parroquia_clap" required="required" value="<?php echo element('parroquia', $clap, ''); ?>">
					</div>
					<div class="input-field">
						<label for="direccion" >Dirección:</label>
						<input type="text" id="direccion" name="direccion_clap" required="required" value="<?php echo element('direccion', $clap, ''); ?>">
					</div>
				</div>
				<br>
				Estatus
				<br>
				<div class="input-field">
						<div class="switch">
							<label>
								Inactivo
								<input type="checkbox" name="status_clap" value="1" <?php if (element('status', $clap, '')=="1"): ?>
								checked="checked"
							<?php endif ?>>
								<span class="lever"></span>
								Activo
							</label>
						</div>
					</div>
				<br><br>
				<div class="input-field" id="buttons">
					<a href="#" class="btn red darken-1" id="prev-step">Anterior</a>
					<button type="submit" class="btn btn-primary"><i class="material-icons right">done</i> Guardar</button>
				</div>
			</div>		
			<div class="col hide-on-small-only m2 l2">
				<ul class="section table-of-contents tabs-wrapper">
					<li><a href="#introduction">Información</a></li>
					<li><a href="#preview">Ubicación</a></li>
				</ul>
			</div>
		</div>
	</form>
</div>