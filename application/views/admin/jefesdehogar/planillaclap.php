<div class="main">
	<?php echo $header; ?>
	<div class="container">
		<div class="row">
			<div class="col s12">
				<div class="panel panel-default">
					<div class="row">
					<div class="encabezado">
					    <img src="<?php echo base_url('/img/logoclapplanilla.jpg'); ?>" class="logo">
					    <img src="<?php echo base_url('/img/gobierno-bolivariano.jpg'); ?>" class="logo right">
						<span class="maintitle">Distribución de Alimentos Casa a Casa</span>
						<div class="clear"></div>
						<div class="info">
							<div class="field"><span class="label">Nombre Clap:</span> <?php echo $clap[0]['nombre'] ?></div>
							<div class="clear"></div>
							<div class="field"><span class="label">Estado:</span> <?php echo $clap[0]['estado'] ?></div>
							<div class="field"><span class="label">Municipio:</span> <?php echo $clap[0]['municipio'] ?></div>
							<div class="field"><span class="label">Parroquia:</span> <?php echo $clap[0]['parroquia'] ?></div>
							<div class="field"><span class="label">Dirección:</span> <?php echo $clap[0]['direccion'] ?></div>
							<div class="clear"></div>
							<div class="field"><span class="label">Total de familias Y/O Viviendas Beneficiadas por cada Planilla</span> _________________________</div>
							<div class="clear"></div>
							<div class="field">
								<span class="label">Responsable:</span> <?php echo $userdata[0]['nombre'].' '.$userdata[0]['apellido'] ?>
							</div>
							<div class="field">
								<span class="label">Cedula:</span> <?php echo $userdata[0]['cedula'] ?>
							</div>
							<div class="field">
								<span class="label">Telefono:</span> <?php echo $userdata[0]['telefono'] ?>
							</div>
							<div class="clear"></div>
							<div class="field">
								<span class="label">Costo de la bolsa:</span> _________________________
							</div>
							<div class="field">
								<span class="label">Cantidad de dinero a Entregar por la planilla:</span> _______________________________________
							</div>
						</div>

					</div>
						<?php
							$modalid = random_string('alnum', 16);
							$index = 1;
						?>
						<?php if ($jefes): ?>
						<table class="bordered responsive">
							<thead>
							<tr style="font-size: 12px;">
								<th>Nº</th>
								<th>Jefe (A) Del Hogar</th>
								<th>Cedula</th>
								<th>Telefono</th>
								<th>N° Miembros</th>
								<th>Diección</th>
								<th>Entrega <br>del dinero</th>
								<th>Recibí <br>conforme</th>
							</tr>
							</thead>
							<?php foreach ($jefes as $jefes): ?>
						<?php
							$itemid = random_string('alnum', 16);
							$ddmid = random_string('alnum', 16);
							$checkbox_id = random_string('alnum', 16);
						?>						
						
							<tbody>
								<tr style="font-size: 12px;" id="<?php echo "$itemid"; ?>">
								<td><?php echo $index; $index++; ?></td>
								<td><?php echo $jefes['nombre'] ?> <?php echo $jefes['apellido'] ?></td>
								<td><?php echo $jefes['cedula'] ?></td>
								<td><?php echo $jefes['telefono'] ?></td>
								<td><?php echo $jefes['n_miembros'] ?></td>
								<td><?php echo $jefes['direccion'] ?></td>
								<td></td>
								<td></td>
							</tr>
							
					<?php endforeach ?></tbody>
						</table>
					<?php else: ?>
					No hay jefes de hogar registrados
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
	<a class="btn-floating btn-large blue waves-effect waves-teal btn-flat" href="#!" onclick="print();">
		<i class="large material-icons">print</i>
	</a>
</div>
<div id="<?php echo $modalid; ?>" class="modal" >
	<div class="modal-content">
		<h4><i class="material-icons">warning</i> Eliminar datos</h4>
		<p>¿Desea eliminar éste jefe de hogar?</p>
	</div>
	<div class="modal-footer">
		<a href="#!" data-action="acept" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
		<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
	</div>
</div>

<style type="text/css">
	table, th, td{
		border: solid 1px #ccc !important;
	}
	th{
		text-align: center;
	}
	.encabezado{
		text-align: center;
		margin: 0 0 10px 0;
	}
	.logo{
		float: left;
		width: 70px;
		margin: 0 0 10px 0;
		position: relative;
		top: -10px;
	}
	.logo.right{
		float: right;
		width: 120px;
	}
	.info{
		border: solid 1px #ccc;
		padding: 3px;
		overflow: hidden;
	}
	.info .field{
		float: left;
		padding: 3px 10px 3px 3px; 
	}
	.field .label{
		text-transform: uppercase;
		font-weight: 700;
		padding:0 5px 0 0;
	}
	.clear{
		clear: both;
	}
	.maintitle{
		text-align: center;
		font-size: 16px;
		font-weight: 700;
		text-transform: uppercase;
		position: relative;
		top: 10px;
	}
	@media print{
		.side-nav{
			display: none;
		}
		.main-nav{
			display: none;
		}
		.main{
			padding: 0px;
		}
		.fixed-action-btn{
			display: none;
		}
	}
</style>
