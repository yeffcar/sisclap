				<?php
					$this->load->helper('array');
					$quotes = array("indigo", "blue"," cyan",  "green", "blue-grey");
					$deep = array("darken-1", 'accent-4', '');
				?>
				<?php if ($relations): ?>
				<?php foreach ($relations as $key => $value): ?>
				<div class="row">
					<div class="col s12">
						
				<?php if ($value['tiperel'] === 'album'): ?>
						<div class="top">
							<div class="row-title left"><a href="<?php echo base_url('admin/user/ver/'.$value['id_user_rel']) ?>"><?php echo $value['user_rel']; ?></a><span> ha creado un album</span></div>
							<div class="row-date right"><?php echo $value['date_rel']; ?></div>
						</div>
						<div class="card hoverable album">
							<div class="card-content <?php echo random_element($quotes); ?> <?php echo random_element($deep); ?>">
								<span class="card-title white-text"><?php echo $value['nombre'] ?></span>
								
							</div>
							<div class="card-action">
								<a href="<?php echo base_url('admin/galeria/albumes/'.$value['id']); ?>/">Ver album</a>
								<span class="estatus right">
									<?php if ($value['status'] === '1'): ?>
									<i class="material-icons tooltipped" data-position="left" data-delay="50" data-tooltip="Publico">assignment_ind</i>
									<?php else: ?>
									<i class="material-icons tooltipped" data-position="left" data-delay="50" data-tooltip="Privado">lock</i>
									<?php endif ?>
								</span>
							</div>
						</div>
				
			<?php elseif($value['tiperel'] === 'user'): ?>
					<div class="top">
							<div class="row-title left"><a href="<?php echo base_url('admin/user/ver/'.$value['id_user_rel']) ?>"><?php echo $value['user_rel']; ?></a><span> ha creado un usuario</span></div>
							<div class="row-date right"><?php echo $value['date_rel']; ?></div>
						</div>
						<div class="card hoverable user">
							<div class="card-content <?php echo random_element($quotes); ?> <?php echo random_element($deep); ?>">
								<?php if (is_file('./img/profile/'.$value['id'].'_thumb.jpg')): ?>
								<img class="circle" src="<?php echo base_url('img/profile/'.$value['id'].'_thumb.jpg'); ?>" alt="Avatar">
								<?php else: ?>
								<?php if (is_file('./img/profile/'.$value['id'].'_thumb.png')): ?>
									<img class="circle" src="<?php echo base_url('img/profile/'.$value['id'].'_thumb.png'); ?>" alt="Avatar">
								<?php else: ?>
								<span class="user-icon circle"><i class="material-icons">perm_identity</i></span>
								<?php endif ?>
								<?php endif ?>
								<span class="card-title"><?php echo $value['username'] ?></span>
								

							</div>
							<div class="card-action">
								<a href="<?php echo base_url('admin/user/ver/'.$value['id']); ?>">Ver usuario</a>
								<span class="estatus right">
									<?php if ($value['status'] === '1'): ?>
									<i class="material-icons tooltipped" data-position="left" data-delay="50" data-tooltip="Permitido">assignment_ind</i>
									<?php else: ?>
									<i class="material-icons tooltipped" data-position="left" data-delay="50" data-tooltip="Restringido">lock</i>
									<?php endif ?>
								</span>
							</div>
							<div class="card-reveal">
								<span class="card-title grey-text text-darken-4">
									<?php echo $value['username'] ?><i class="material-icons right">close</i>
									
								</span>
							</div>
						</div>
			<?php elseif($value['tiperel'] === 'jefe_hogar'): ?>
					<div class="top">
							<div class="row-title left"><a href="<?php echo base_url('admin/user/ver/'.$value['id_user_rel']) ?>"><?php echo $value['user_rel']; ?></a><span> ha registrado un jefe de hogar</span></div>
							<div class="row-date right"><?php echo $value['date_rel']; ?></div>
						</div>
						<div class="card hoverable">
							<div class="card-content red lighten-1">
								<span class="grey-text text-darken-4"><?php echo $value['nombre'].' '.$value['apellido'] ?></span><span class="estatus right">
									<?php if ($value['status'] === '1'): ?>
									<i class="material-icons tooltipped" data-position="left" data-delay="50" data-tooltip="Activo">assignment_ind</i>
									<?php else: ?>
									<i class="material-icons tooltipped" data-position="left" data-delay="50" data-tooltip="Inactivo">lock</i>
									<?php endif ?>
								</span>
							</div>
							<div class="card-action">
								<p>
									Teléfono: <?php echo $value['telefono'] ?><br>
									Email: <?php echo $value['email'] ?><br>
									Nº Miembros: <?php echo $value['n_miembros'] ?><br>
								</p>
							</div>
						</div>
				<?php elseif($value['tiperel'] === 'datos_clap'): ?>
					<div class="top">
							<div class="row-title left"><a href="<?php echo base_url('admin/user/ver/'.$value['id_user_rel']) ?>"><?php echo $value['user_rel']; ?></a><span> ha registrado un clap</span></div>
							<div class="row-date right"><?php echo $value['date_rel']; ?></div>
						</div>
						<div class="card hoverable">
							<div class="card-content ">
								<span class="grey-text text-darken-4"><?php echo $value['nombre'] ?></span>
							</div>
							<div class="card-action">
								<a href="<?php echo base_url('admin/clap/ver/'.$value['id']); ?>">Ver registro</a>
								<span class="estatus right">
									<?php if ($value['status'] === '1'): ?>
									<i class="material-icons tooltipped" data-position="left" data-delay="50" data-tooltip="Publico">assignment_ind</i>
									<?php else: ?>
									<i class="material-icons tooltipped" data-position="left" data-delay="50" data-tooltip="Privado">lock</i>
									<?php endif ?>
								</span>
							</div>
							<div class="card-reveal">
								<span class="card-title grey-text text-darken-4"><?php echo $value['nombre'] ?><i class="material-icons right">close</i></span>
								<p>
									duration: <?php echo $value['duration'] ?><br>
									youtubeid: <?php echo $value['youtubeid'] ?><br>
									<?php echo $value['fecha'] ?>
								</p>
							</div>
						</div>
				<?php endif ?>
					</div>
				</div>
				
<?php endforeach ?>
<?php endif ?>