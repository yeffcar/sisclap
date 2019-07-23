<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('UserMod');
	}
	
	public function index(){
		
		if ($this->session->userdata('level')>=3) {
			redirect('admin/');
		}

		$data['title'] = "Admin | Usuarios";
		if ($this->session->userdata('type')=='Responsable de Clap'){
			$data['h1'] = "Líderes";
		}else{
			$data['h1'] = "Usuarios";
		}
		$data['header'] = $this->load->view('admin/header', $data, TRUE);
		$data['username'] = $this->session->userdata('username');

		//Administrador
		if ($this->session->userdata('level')==1) {
			$data['userdata'] = $this->UserMod->get_custom_data('`usergroup`, `user`', "`usergroup`.`id`=`user`.`usergroup`");
		}else{
			$data['userdata'] = $this->UserMod->get_custom_data('`usergroup`, `datauserstorage`, `user`', "`user`.`id`=`datauserstorage`.`id_user` AND `datauserstorage`.`_key`='idcreateby' AND `datauserstorage`.`_value`='".$this->session->userdata('id')."' AND `usergroup`.`id`=`user`.`usergroup`");
		}
		
		$this->load->view('admin/head', $data);
		$this->load->view('admin/navbar', $data);
		
		if ($this->session->userdata('type')=='Responsable de Clap'){
			$this->load->view('admin/user/lideres', $data);
		}else{
			$this->load->view('admin/user/alluser', $data);
		}
		$this->load->view('admin/footer', $data);
	}

	public function ver($id = false){
		
		if ($this->session->userdata('id') != $id && $this->session->userdata('level')!='1') {
			if (!$this->UserMod->get_custom_data('`usergroup`, `datauserstorage`, `user`', "`user`.`id`=`datauserstorage`.`id_user` AND `datauserstorage`.`_key`='idcreateby' AND `datauserstorage`.`_value`='".$this->session->userdata('id')."' AND `usergroup`.`id`=`user`.`usergroup` AND user.id = $id")) {
				redirect('admin/');
			}
		}
		$this->load->model('ModRelations');
		$this->load->model('EventosMod');
		$this->load->model('ModGallery');
		$this->load->model('ModVideo');

		$this->load->helper('form');

		//get_user
		$data['userdata'] = $this->UserMod->get_user(array('user.id' => $id));
		if ($data['userdata']) {
			
			//Make the timeline
			$relations = $this->ModRelations->get_relation(array('id_user'=>$id), '', array('date','DESC'));	
			$data['relations'] = $this->get_datarelations($relations);
			
			//get_datauserstorage
			$datastorage = $this->UserMod->get_datauserstorage(array('id_user'=>$id));
			if ($datastorage) {
				foreach ($datastorage as $key => $value) {
					$data['userdata'][0][$value['_key']] = $value['_value'];
				}
			}

			$data['currentlevel'] = $this->session->userdata('level');
			$data['username'] = $this->session->userdata('username');
			$data['title'] = "Admin | Ver";
			$data['h1'] = '';
			$data['header'] = '';
			
			//Form Options
			$data['error'] = '';
			$data['nomultiple'] = true;
			$data['load_to'] = 'admin/user/profileimage/'.$data['userdata'][0]['username'].'/'.$id;
			$data['form'] = $this->load->view('admin/galeria/upload_form', $data, TRUE);
			
			$data['modalid'] = random_string('alnum', 16);
			
			//Make the menu options
			$this->load->library('menu');
			$this->menu->char = "'";
			$this->menu->set_ul_properties($properties = array('class' => 'dropdown-content', 'role' => 'menu', 'id' => 'dropdown'));
			
			$links = array();
			if ($data['currentlevel'] <= $data['userdata'][0]['level']) {
				 $links = array('Editar' =>  array('href' => base_url('admin/user/editar/'.$id)),
				 				'Cambiar avatar' =>  array( 'href'=>'#modal2','class'=>'modal-trigger'),
								'Eliminar' =>  array('href' => '#'.$data['modalid'], 
													'class' => 'modal-trigger',
													'data-action-param'=>'{"id":['.$id.'], "table":"user"}',
												 	'data-url'=>'admin/user/fn_ajax_delete_data',
												 	'data-url-redirect'=>'admin/user/',
												 	'data-ajax-action'=>'inactive'
								),
								'Bloquear'  =>  array('href' => '#'));
			}

			if ($id == $this->session->userdata('id')) {
				$links = array('Editar' =>  array('href' =>base_url('admin/user/editar/'.$id) ),
				 				'Cambiar avatar' =>  array( 'href'=>'#modal2','class'=>'modal-trigger'));

			}		

			$data['options'] = $this->menu->get_menu($links);
			

			//Page includes
			$data['head_includes'] = array('file-input' => link_tag('js/fileinput-master/css/fileinput.min.css'));
			$data['footer_includes'] = array('file-input' => '<script src="'.base_url('js/fileinput-master/js/fileinput.js').'"></script>','file-input-canvas' => '<script src="'.base_url('js/fileinput-master/js/plugins/canvas-to-blob.min.js').'"></script>');
			
			// Load the views
			$this->load->view('admin/head', $data);
			$this->load->view('admin/navbar', $data);
			$data['timeline'] = $this->load->view('admin/timeline', $data, TRUE);

			$this->load->view('admin/user/userprofile', $data);
			$this->load->view('admin/footer', $data);

		}else{
			$this->showError('El usuario al que intenta acceder no existe :(');
		}
	}

	public function editar($id){
		$data['user'] = $this->UserMod->get_user(array('user.id' => $id))[0];
		if ($data['user']) {
			$datastorage = $this->UserMod->get_datauserstorage(array('id_user'=>$id));
			if ($datastorage) {
				foreach ($datastorage as $key => $value) {
					$data['user'][$value['_key']] = $value['_value'];
				}
			}

			$this->load->helper('form');
			$this->load->helper('array');

			$data['title'] = "Admin | Editar";
			$data['h1'] = "Editar Usuario";
			$data['header'] = $this->load->view('admin/header', $data, TRUE);
			$data['action'] = 'admin/user/update/';
			
			if ($this->session->userdata('level')==1) {
				$data['usergroups'] = $this->UserMod->get_usergroup(array('status'=>'1'));
			}else{
				$data['usergroups'] = $this->UserMod->get_usergroup(array('status'=>'1', 'level ='=>$this->session->userdata('level')));
			}

			$this->load->view('admin/head', $data);
			$this->load->view('admin/navbar', $data);
			$this->load->view('admin/user/form', $data);
			$this->load->view('admin/footer', $data);
		}else{
			$this->showError();
		}	
	}

	public function nuevo($tipo = 'all'){

		if ($this->session->userdata('level')==3) {
			redirect('admin/');
		}
		
		if ($tipo == 'lider' && $this->session->userdata('level')!='2') {
			$this->showError('No posee permisos para realizar esta accion');
		}elseif ($tipo == 'responsable' && $this->session->userdata('level')!='1') {
			$this->showError('No posee permisos para realizar esta accion');
		}elseif($tipo == 'all'){
			$this->showError('No posee permisos para realizar esta accion');
		}
		else
		{

			$this->load->helper('form');
			$this->load->helper('array');

			$data['user'] = array();
			$data['action'] = 'admin/user/save/';
			$data['title'] = "Admin | Nuevo Usuario";
			$data['userdata'] = false;
			
			if ($this->session->userdata('level')==1 ) {
				$data['usergroups'] = $this->UserMod->get_usergroup(array('status'=>'1'));
				if ($tipo == 'all') {
					$data['usergroups'] = $this->UserMod->get_usergroup(array('status'=>'1'));
					$data['h1'] = "Registro de lideres y Responsables";
				}elseif ($tipo == 'lider') {
					$data['usergroups'] = $this->UserMod->get_usergroup(array('status'=>'1', 'usergroup.level' => '3'));
					$data['h1'] = "Registro de lideres";
				}elseif ($tipo == 'responsable') {
					$data['usergroups'] = $this->UserMod->get_usergroup(array('status'=>'1', 'usergroup.level' => '2'));
					$data['h1'] = "Registro de Responsables";
				}
			}elseif($this->session->userdata('level')==2){
				$data['h1'] = "Registro de lideres";
				$data['usergroups'] = $this->UserMod->get_usergroup(array('status'=>'1', 'usergroup.level' => '3'));
			}
			$data['header'] = $this->load->view('admin/header', $data, TRUE);
			// Load the views
			$this->load->view('admin/head', $data);
			$this->load->view('admin/navbar', $data);
			
			if ($tipo == 'lider' && $this->session->userdata('level')=='2') {
				$this->load->view('admin/user/formlideres', $data);
			}elseif ($tipo == 'responsable' && $this->session->userdata('level')=='1') {
				$data['clap'] = array();
				$data['action'] = 'admin/user/saveuserclap/';
				$this->load->view('admin/user/formresponsable', $data);
			}
			$this->load->view('admin/footer', $data);
		}
	}

	public function save(){
		
			// Load the model
			
			$mode = $this->input->post('mode');
			$query = false;
			$status = "0";
			if($this->input->post('status')=="on"){
				$status = "1";
			}
			$data = array(
				'username' => url_title($this->input->post('username'), 'underscore', TRUE),
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email'),
				'usergroup' =>  $this->input->post('usergroup'),
				'status' =>  $status
			);
			$date = new DateTime();
			$data['lastseen'] = $date->format('Y-m-d H:i:s');
			if ($this->UserMod->set_user($data)){
				$id_user = $this->UserMod->get_user(array('username'=>url_title($this->input->post('username'), 'underscore', TRUE)))[0]['id'];
				$datauserstorage = array(
					array('_key' => 'nombre', '_value' => $this->input->post('nombre'), 'id_user' => $id_user),
					array('_key' => 'apellido', '_value' =>  $this->input->post('apellido'), 'id_user' => $id_user),
					array('_key' => 'direccion', '_value' => $this->input->post('direccion'), 'id_user' => $id_user),
					array('_key' => 'telefono',  '_value'=>$this->input->post('telefono'), 'id_user' => $id_user),
					array('_key' => 'cedula',  '_value'=>$this->input->post('cedula'), 'id_user' => $id_user),
					array('_key' => 'create by',  '_value'=>$this->session->userdata('username'), 'id_user' => $id_user),
					array('_key' => 'idcreateby',  '_value'=> $this->session->userdata('id'), 'id_user' => $id_user)
				);
				foreach ($datauserstorage as $key => $data) {
					$this->UserMod->set_datauserstorage($data);
				}
				$this->load->model('ModRelations');
				$relations = array('id_user' => $this->session->userdata('id'), 'tablename' => 'user', 'id_row' => $id_user, 'action' => 'crear');
				$this->ModRelations->set_relation($relations);
				
				$clap = $this->StModel->get_data(array('id_responsable' => $this->session->userdata('id')), 'datos_clap')[0];

				$this->StModel->set_data(array('id' => 'NULL', 'id_clap' => $clap['id'], 'id_lider' => $id_user), 'datos_lideres');

				redirect('admin/user/ver/'.$id_user);
			}else{
				$this->showError();
			}
	}

	public function saveuserclap(){
		
			// Load the model
			
			$mode = $this->input->post('mode');
			$query = false;
			$status = "0";
			if($this->input->post('status')=="on"){
				$status = "1";
			}
			$data = array(
				'username' => url_title($this->input->post('username'), 'underscore', TRUE),
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email'),
				'usergroup' =>  $this->input->post('usergroup'),
				'status' =>  $status
			);
			$date = new DateTime();
			$data['lastseen'] = $date->format('Y-m-d H:i:s');
			if ($this->UserMod->set_user($data)){
				$id_user = $this->UserMod->get_user(array('username'=>url_title($this->input->post('username'), 'underscore', TRUE)))[0]['id'];
				$datauserstorage = array(
					array('_key' => 'nombre', '_value' => $this->input->post('nombre'), 'id_user' => $id_user),
					array('_key' => 'apellido', '_value' =>  $this->input->post('apellido'), 'id_user' => $id_user),
					array('_key' => 'direccion', '_value' => $this->input->post('direccion'), 'id_user' => $id_user),
					array('_key' => 'telefono',  '_value'=>$this->input->post('telefono'), 'id_user' => $id_user),
					array('_key' => 'cedula',  '_value'=>$this->input->post('cedula'), 'id_user' => $id_user),
					array('_key' => 'create by',  '_value'=>$this->session->userdata('username'), 'id_user' => $id_user),
					array('_key' => 'idcreateby',  '_value'=> $this->session->userdata('id'), 'id_user' => $id_user)
				);
				foreach ($datauserstorage as $key => $data) {
					$this->UserMod->set_datauserstorage($data);
				}
				$this->load->model('ModRelations');
				$relations = array('id_user' => $this->session->userdata('id'), 'tablename' => 'user', 'id_row' => $id_user, 'action' => 'crear');
				$this->ModRelations->set_relation($relations);

				///////////////////////////////////////////////////////////////////////////////////////////////////////////
				$status = 0;
				if ($this->input->post('status_clap')==='1') {
					$status = 1;
				}
				$fecha = new DateTime;
				$data = array(
					'id' => 'NULL', 
					'nombre' =>  $this->input->post('nombre_clap'),
					'codigo' =>  $this->input->post('codigo_clap'),
					'n_consejosc' =>  $this->input->post('n_consejosc_clap'),
					'id_responsable' =>  $id_user,			
					'fecha' => $fecha->format('Y-m-d H:i:s'),
					'status' => $status
				);
				if($this->StModel->set_data($data, "datos_clap")){
					unset($data['id']);

					$clap = $this->StModel->get_data($data, 'datos_clap');
					$this->StModel->set_data(array('id' => 'NULL', 'id_clap' => $clap[0]['id'], '_key' => 'estado', '_value' => $this->input->post('estado_clap')), "ubicacion_clap");
					$this->StModel->set_data(array('id' => 'NULL', 'id_clap' => $clap[0]['id'], '_key' => 'municipio', '_value' => $this->input->post('municipio_clap')), "ubicacion_clap");
					$this->StModel->set_data(array('id' => 'NULL', 'id_clap' => $clap[0]['id'], '_key' => 'parroquia', '_value' => $this->input->post('parroquia_clap')), "ubicacion_clap");
					$this->StModel->set_data(array('id' => 'NULL', 'id_clap' => $clap[0]['id'], '_key' => 'direccion', '_value' => $this->input->post('direccion_clap')), "ubicacion_clap");
					$this->load->model('ModRelations');

					$relations = array('id_user' => $this->session->userdata('id'), 'tablename' => 'datos_clap', 'id_row' => $clap[0]['id'], 'action' => 'crear');
					$this->ModRelations->set_relation($relations);



				redirect('admin/user/ver/'.$id_user);
			}else{
				$this->showError();
			}
	}else{
				$this->showError();
	}
}
	public function update(){
		$id = $this->input->post('id');
		$status = "0";
		if($this->input->post('status')=="on"){
			$status = "1";
		}
		$data = array(
				'username' => url_title($this->input->post('username'), 'underscore', TRUE),
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email'),
				'usergroup' =>  $this->input->post('usergroup'),
				'status' =>  $status
		);
		if ($this->UserMod->update_user($data,$id)) {
			$datauserstorage = array(
				array('_key' => 'nombre', '_value' => $this->input->post('nombre')),
				array('_key' => 'apellido', '_value' =>  $this->input->post('apellido')),
				array('_key' => 'direccion', '_value' => $this->input->post('direccion')),
				array('_key' => 'telefono',  '_value'=>$this->input->post('telefono')),
				array('_key' => 'cedula',  '_value'=>$this->input->post('cedula')),
				array('_key' => 'create by',  '_value'=>$this->session->userdata('username'))
			);
			foreach ($datauserstorage as $key => $data) {
				$this->UserMod->update_datauserstorage($data, $arrayName = array('_key' => $data['_key'], 'id_user' => $id));
			}
			if ($id==$this->session->userdata('id')) {
				$newdata = array(
                	'username'  => url_title($this->input->post('username'), 'underscore', TRUE),
                	'level' => $this->input->post('usergroup'),
                );
		  		$this->session->set_userdata($newdata);
			}
			redirect('admin/user/ver/'.$id);
		}
	}

	public function profileimage($dir = '/img', $id_user){
		
		
		$udir = $dir;
		$dir = str_replace('_','/',$dir);
		if ($dir === 'root') {
			$dir = dirname('img');
		}
		
		$ext = '';

		foreach ($_FILES["imagenes"]["error"] as $clave => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		        $nombre_tmp = $_FILES["imagenes"]["tmp_name"][$clave];
		        $ext = strstr($_FILES["imagenes"]["name"][$clave], '.');
		        $nombre = $id_user.$ext;
		        move_uploaded_file($nombre_tmp, 'img/profile/'.$nombre);
		    }
		}

		$config['image_library'] = 'gd2';
		$config['source_image'] = './img/profile/'.$nombre;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = FALSE;
		$config['width']         = 150;
		$config['height']       = 150;
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();

		unlink('./img/profile/'.$nombre);

		$data = array('_key' => 'avatar', 'id_user' =>  $id_user);
		// delete the current avatar
		$this->UserMod->delete_datauserstorage($data);
		$data = array('_key' => 'avatar', '_value' => $id_user.'_thumb'.$ext, 'id_user' => $id_user);
		// set the new avatar in the db
		$this->UserMod->set_datauserstorage($data);

		if ($id_user==$this->session->userdata('id')) {
			$this->session->set_userdata('avatar',$id_user.'_thumb'.$ext);
		}

		redirect('admin/user/ver/'.$id_user);
	}
}