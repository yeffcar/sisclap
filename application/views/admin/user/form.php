<div class="main">
	<?php echo $header ?>
	<div class="container">
		<div class="row">
			<div class="col s12 m10 l10 validate-form">
				<?php echo form_open_multipart($action);?>
				<h4>Perfil</h4>
				<div id="initialization" class="section scrollspy">
				<div class="input-field">
					<input data-segment-url="admin/user/fn_ajax_check_value/" data-value="<?php echo element('username', $user, ''); ?>" data-action-param='{"table":"user", "field":"username"}' class="fn_checkvalue validate" maxlength="25" type="text" id="username" name="username" value="<?php echo element('username', $user, ''); ?>" required="required">
					<label for="username" data-error="En uso">Usuario</label>
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
					<label for="cedula" data-error="Cedula registrada">Cédula:</label>
				</div>
				<div class="input-field">
					<input maxlength="20" id="nombre"  type="text" name="nombre" value="<?php echo element('nombre', $user, ''); ?>">
					<label>Nombre:</label>
				</div>
				<div class="input-field">
					
					<input maxlength="20"  type="text"  id="apellido"  name="apellido" value="<?php echo element('apellido', $user, ''); ?>"><label for="apellido">Apellido:</label>
				</div>
				<div class="input-field">
					
					<input maxlength="200" type="text"   id="direccion"  name="direccion" value="<?php echo element('direccion', $user, ''); ?>"><label for="direccion">Dirección:</label>
				</div>
				<div class="input-field">
					<input maxlength="50"  type="text"  id="telefono" name="telefono" value="<?php echo element('telefono', $user, ''); ?>"><label for="telefono">Teléfono:</label>
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
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</div>
				<input type="hidden" name="id" value="<?php echo element('id', $user, ''); ?>">
				</div>
			</form>
		</div>
		<div class="col hide-on-small-only m2 l2">
				<ul class="section table-of-contents tabs-wrapper">
					<li><a href="#initialization">Perfil</a></li>
					<li><a href="#structure">Información</a></li>
				</ul>
			</div>
	</div>
</div>
</div>