<div class="side-nav" id="slide-out" >
	<div class="user white-text">
		<div class="group">
			<a href="<?php echo base_url('admin/user/ver/'.$this->session->userdata('id')) ?>" title="Perfil" class="profileavatar">
			<?php if (is_file('./img/profile/'.$this->session->userdata('id').'_thumb.jpg')): ?>
				<img class="circle" src="<?php echo base_url('img/profile/'.$this->session->userdata('id').'_thumb.jpg'); ?>" alt="Avatar">
			<?php else: ?>
			<?php if (is_file('./img/profile/'.$this->session->userdata('id').'_thumb.png')): ?>
				<img class="circle" src="<?php echo base_url('img/profile/'.$this->session->userdata('id').'_thumb.png'); ?>" alt="Avatar">
			<?php else: ?>
				<i class="material-icons circle red lighten-4 medium">perm_identity</i>
			<?php endif ?>
			<?php endif ?>
			</a>
			<a class="dropdown-button white-text" href="#!" data-activates="dropdown2"><?php echo $this->session->userdata('username'); ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
		</div>
		<span class="level"><?php echo $this->session->userdata('type'); ?></span>
		<ul id='dropdown2' class='dropdown-content'>
			<li><a href="<?php echo base_url('admin/user/ver/'.$this->session->userdata('id')) ?>">Perfil</a></li>
			<li><a href="<?php echo base_url('admin/user/editar/'.$this->session->userdata('id')) ?>">Editar perfil</a></li>
			<li><a href="<?php echo base_url('login/'); ?>"> Cerrar sesión</a>
		</ul>
	</div>
	<ul class="main-menu">
		<?php if ($this->session->userdata('type')=='Responsable de Clap'): ?>
			<li><a href="<?php echo base_url('admin/user/') ?>"><i class="material-icons">perm_identity</i> Líderes</a></li>
		<?php endif ?>
		<?php if ($this->session->userdata('type')=='Administrador'): ?>
			<li><a href="<?php echo base_url('admin/user/') ?>"><i class="material-icons">perm_identity</i> Usuarios</a></li>
		<?php endif ?>
		<?php if ($this->session->userdata('type')=='Líder de calle'): ?>
			<li><a href="<?php echo base_url('admin/Jefesdehogar') ?>"><i class="material-icons">perm_identity</i> Jefes de Hogar</a></li>
		<?php endif ?>
		<?php if ($this->session->userdata('type')!='Líder de calle'): ?>
			<li><a href="<?php echo base_url('admin/clap/') ?>"><i class="material-icons">streetview</i> Clap</a></li>
		<?php endif ?>
		<?php if ($this->session->userdata('level')== 3): ?>
			<li><a href="<?php echo base_url('admin/Jefesdehogar/planilla/'.$this->session->userdata('id')) ?>"><i class="material-icons">perm_identity</i> Planilla</a></li>
		<?php endif ?>
		
	</ul>
</div>

<nav class="main-nav red darken-4">
	<div class="nav-wrapper">

		<a href="<?php echo base_url('admin/'); ?>" class="brand-logo"><img src="/img/login.png" style="float: left; width: 60px"></a>
		<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
	</div>
</nav>

