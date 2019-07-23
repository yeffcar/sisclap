<div class="main">
	<?php echo $header; ?>
	<div class="container">
		<div class="row">
			<div class="col s12">
				<?php if ($claps): ?>
									
						<table class="bordered highlight">
							<thead> 
								<th><input type="checkbox" class="card-checkbox filled-in" id="select_all"/>
								<label for="select_all"></label> Nombre Clap</th>
								<th>Codigo</th>
								<th>Fecha registro</th>
								<th>N° Consejos comunales</th>
							</thead>
							<tbody>
							<?php foreach ($claps as $clap): ?>	
								<tr>
								<?php
									$itemid = random_string('alnum', 16);
									$ddmid = random_string('alnum', 16);
									$checkbox_id = random_string('alnum', 16);
								?>	
								<td id="<?php echo $itemid; ?>"><input type="checkbox" class="card-checkbox filled-in" id="<?php echo $checkbox_id ?>" value="<?php echo $clap['id'] ?>" data-target-element="#<?php echo $itemid; ?>"/>
								<label for="<?php echo $checkbox_id ?>"></label>
								<a href="<?php echo base_url('admin/clap/ver/'.$clap['id']); ?>"><?php echo $clap['nombre']; ?></a></td>
								<td><?php echo $clap['codigo']; ?></td>
								<td><?php echo $clap['fecha']; ?></td>
								<td><?php echo $clap['n_consejosc']; ?></td>
								</tr>
							<?php endforeach ?>
							</tbody>
						</table>
					
				<?php else: ?>
					No hay clap creados todavía
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
	<a class="btn-floating btn-large red waves-effect waves-teal btn-flat new tooltipped" data-position="left" data-delay="50" data-tooltip="Registrar clap" href="<?php echo base_url('admin/clap/nuevo/') ?>">
		<i class="large material-icons">add</i>
	</a>
</div>