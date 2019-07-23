<div class="main">
	<?php echo $header; ?>
	<div class="container">
		<div class="row">
			<div class="col s12">
				<div class="panel-heading">
					Líderes registrados:
				</div>
				<?php if ($userdata): ?>
					<?php
							$this->load->helper('array');
							$quotes = array(" indigo", "blue", " light-blue", " cyan", "grey", " teal", "green", "blue-grey", "pink");
							$deep = array("darken-1", "accent-3", 'lighten-1', '');					
					?>
					<?php foreach ($userdata as $array): ?>
					<ul class="collection">
						<li class="collection-item avatar">
							<?php if (is_file('./img/profile/'.$array['id'].'_thumb.jpg')): ?>
								<img class="circle" src="<?php echo base_url('img/profile/'.$array['id'].'_thumb.jpg'); ?>" alt="Avatar">
							<?php else: ?>
							<?php if (is_file('./img/profile/'.$array['id'].'_thumb.png')): ?>
								<img class="circle" src="<?php echo base_url('img/profile/'.$array['id'].'_thumb.png'); ?>" alt="Avatar">
							<?php else: ?>
							<i class="material-icons circle medium <?php echo random_element($quotes).' '.random_element($deep);?>">perm_identity</i>
							<?php endif ?>
							<?php endif ?>
							<a href="<?php echo base_url('/admin/user/ver/'.$array['id'])?>" class="tooltipped" data-position="right" data-delay="50" data-tooltip="Mas detalles" ><span class="title black-text"><b><?php echo $array['username'] ?></b></span></a>
							<p><?php echo $array['name'] ?><br>
								Ultima vez: <?php echo $array['lastseen'] ?>
							</p>
						<?php if ($this->session->userdata('id')!=$array['id']): ?>
						<?php
							$itemid = random_string('alnum', 16);
						?>	
						<div class="switch">
							<label>
								Bloqueado
								<input id="<?php echo $itemid; ?>" type="checkbox" class="change_state" name="status" <?php if ($array['status']=="1"): ?>
								checked="checked" <?php endif ?> data-url="admin/user/fn_ajax_change_state/" 
								data-action-param='{"id":"<?php echo $array['id']; ?>", "table":"user"}'
								 >
								<span class="lever"></span>
								Permitido
							</label>
							
						</div>
						<?php endif ?>
							<a href="<?php echo base_url('/admin/user/ver/'.$array['id'])?>" class="secondary-content tooltipped" data-position="left" data-delay="50" data-tooltip="Mas detalles" ><i class="material-icons cyan-text small">info_outline</i></a>
						</li>
					</ul>
					<?php endforeach ?>
				<?php else: ?>
				No hay más líderes registrados
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
<?php if ($this->session->userdata('level')==1): ?>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
	<a class="btn-floating btn-large red waves-effect waves-teal btn-flat new tooltipped" data-position="left" data-delay="50" data-tooltip="Registrar responsable de clap"  href="<?php echo base_url('admin/user/nuevo/responsable') ?> ">
	<i class="large material-icons">add</i>
	</a>
</div>
<?php else: ?>
	<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
	<a class="btn-floating btn-large green waves-effect waves-teal btn-flat new tooltipped" data-position="left" data-delay="50" data-tooltip="Registrar lider" href="<?php echo base_url('admin/user/nuevo/lider') ?>"><i class="material-icons">add</i></i>
	</a>
</div>
<?php endif ?>