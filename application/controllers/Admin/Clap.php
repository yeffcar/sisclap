<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clap extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		if ($this->session->userdata('level')!='3') {
			$data['title'] = "Admin | CLAP";
			$data['h1'] = "CLAP Registrados";
			//Administrador
			if ($this->session->userdata('level')=='1') {
				$data['claps'] =  $this->StModel->get_data('all', 'datos_clap');
			}elseif($this->session->userdata('level')=='2'){
				$data['h1'] = "CLAP Asignados";
				$data['claps'] =  $this->StModel->get_data(array('id_responsable' => $this->session->userdata('id')), 'datos_clap');
			}

			$data['header'] = $this->load->view('admin/header', $data, TRUE);
			$this->load->view('admin/head', $data);
			$this->load->view('admin/navbar', $data);
			$this->load->view('admin/clap/todos', $data);
			$this->load->view('admin/footer', $data);
		}else{
			$this->showError('No tienes permisos para accedder a este modulo');
		}
	}
	
	public function nuevo(){
		if ($this->session->userdata('level')==1) {
			$this->load->model('UserMod');
			$this->load->helper('array');
			$data['title'] = "Admin | CLAP - Nuevo";
			$data['h1'] = "Registro de CLAP";
			$data['header'] = $this->load->view('admin/header', $data, TRUE);
			$data['clap'] = array();
			$data['action'] = 'admin/clap/save';

			$data['userdata'] = $this->UserMod->get_custom_data('`datos_clap`, `user`', '`user`.`id` =! `datos_clap`.`id_responsable`');
			if ($data['userdata']) {
				foreach ($data['userdata'] as $clave => $valor) {
						$datastorage = $this->UserMod->get_datauserstorage(array('id_user'=>$valor['id']));
						if ($datastorage) {
							foreach ($datastorage as $key => $value) {
								$data['userdata'][$clave][$value['_key']] = $value['_value'];
							}
						}
				}
				$this->load->view('admin/head', $data);
				$this->load->view('admin/navbar', $data);
				$this->load->view('admin/clap/crear', $data);
				$this->load->view('admin/footer', $data);
			}else{
				$this->showError('No hay responsables sin asignar, debe <a href="'.base_url('admin/user/nuevo/responsable').'"> crear uno</a> primero');
			}
		}else{
			$this->showError('No tienes permisos para accedder a este modulo');
		}
	}

	public function ver($id = 'all'){
		if ($this->session->userdata('level')!='3') {
			$data['clap'] = $this->StModel->get_data(array('id' => $id), 'datos_clap');
			if ($data['clap']) {
				$data['title'] = "Admin | Clap";
				$data['h1'] = $data['clap'][0]['nombre'];
				$data['header'] = $this->load->view('admin/header', $data, TRUE);
				$this->load->model('UserMod');
				
				$data['userdata'] = $this->UserMod->get_user(array('user.id' => $data['clap'][0]['id_responsable']));
				//get_datauserstorage
				$datastorage = $this->UserMod->get_datauserstorage(array('id_user'=>$data['clap'][0]['id_responsable']));
				if ($datastorage) {
					foreach ($datastorage as $key => $value) {
						$data['userdata'][0][$value['_key']] = $value['_value'];
					}
				}

				$ubicaciones = $this->StModel->get_data(array('id_clap' => $data['clap'][0]['id']), 'ubicacion_clap');
				//get_datauserstorage
				if ($ubicaciones) {
					foreach ($ubicaciones as $key => $value) {
						$data['clap'][0][$value['_key']] = $value['_value'];
					}
				}

				$data['lideresasignados'] = $this->UserMod->get_custom_data("`datos_lideres`, `user`" , "`datos_lideres`.`id_lider`=`user`.`id` AND `user`.`status`='1' AND `datos_lideres`.`id_clap`=".$id);

				
				$this->load->view('admin/head', $data);
				$this->load->view('admin/navbar', $data);
				$this->load->view('admin/clap/ver', $data);
				$this->load->view('admin/footer', $data);
			}else{
				$this->showError('Los datos a los que intenta acceder no existe :(');
			}
		}else{
				$this->showError('No tienes permisos para accedder a este modulo');
			}
	}
	

	public function save(){
		$status = 0;
		if ($this->input->post('status')==='1') {
			$status = 1;
		}
		$fecha = new DateTime;
		$data = array(
			'id' => 'NULL', 
			'nombre' =>  $this->input->post('nombre'),
			'codigo' =>  $this->input->post('codigo'),
			'n_consejosc' =>  $this->input->post('n_consejosc'),
			'id_responsable' =>  $this->input->post('id_responsable'),			
			'fecha' => $fecha->format('Y-m-d H:i:s'),
			'status' => $status
		);
		if($this->StModel->set_data($data, "datos_clap")){
			unset($data['id']);

			$clap = $this->StModel->get_data($data, 'datos_clap');
			$this->StModel->set_data(array('id' => 'NULL', 'id_clap' => $clap[0]['id'], '_key' => 'estado', '_value' => $this->input->post('estado')), "ubicacion_clap");
			$this->StModel->set_data(array('id' => 'NULL', 'id_clap' => $clap[0]['id'], '_key' => 'municipio', '_value' => $this->input->post('municipio')), "ubicacion_clap");
			$this->StModel->set_data(array('id' => 'NULL', 'id_clap' => $clap[0]['id'], '_key' => 'parroquia', '_value' => $this->input->post('parroquia')), "ubicacion_clap");
			$this->StModel->set_data(array('id' => 'NULL', 'id_clap' => $clap[0]['id'], '_key' => 'direccion', '_value' => $this->input->post('direccion')), "ubicacion_clap");
			$this->load->model('ModRelations');

			$relations = array('id_user' => $this->session->userdata('id'), 'tablename' => 'datos_clap', 'id_row' => $clap[0]['id'], 'action' => 'crear');
			$this->ModRelations->set_relation($relations);

			redirect('admin/clap/ver/'.$clap[0]['id']);
		}else{
			$this->showError('Ocurrió un error inesperado al guardar los datos :(');
		}
	}

	public function editardatos($id){

		$data['clap'] = $this->StModel->get_data(array('id' => $id), 'datos_clap')[0];
		if ($data['clap']) {
			$this->load->helper('array');
			$this->load->model('UserMod');

			$data['title'] = "Admin | Editar Clap";
			$data['h1'] = "Editar Clap";
			$data['header'] = $this->load->view('admin/header', $data, TRUE);
			$data['action'] = 'admin/clap/update';
			
			$data['userdata'] = false;
			//get_datauserstorage
			if ($data['userdata']) {				
				foreach ($data['userdata'] as $clave => $valor) {
					$datastorage = $this->UserMod->get_datauserstorage(array('id_user'=>$valor['id']));
					if ($datastorage) {
						foreach ($datastorage as $key => $value) {
							$data['userdata'][$clave][$value['_key']] = $value['_value'];
						}
					}
				}
			}
			$ubicaciones = $this->StModel->get_data(array('id_clap' => $data['clap']['id']), 'ubicacion_clap');
				//get_datauserstorage
				if ($ubicaciones) {
					foreach ($ubicaciones as $key => $value) {
						$data['clap'][$value['_key']] = $value['_value'];
					}
			}

			$this->load->view('admin/head', $data);
			$this->load->view('admin/navbar', $data);
			$this->load->view('admin/clap/crear', $data);
			$this->load->view('admin/footer', $data);
		}else{
			$this->showError();
		}
	}

	public function update(){
		$status = 0;
		if ($this->input->post('status')==='1') {
			$status = 1;
		}
		$where = array('id' => $this->input->post('id'));
		$data = array(
			'nombre' =>  $this->input->post('nombre'),
			'codigo' =>  $this->input->post('codigo'),
			'n_consejosc' =>  $this->input->post('n_consejosc'),
			'status' => $status
		);
		if($this->StModel->update_data($where, $data, 'datos_clap')){
			$this->StModel->delete_data(array('id_clap'=>$this->input->post('id')), 'ubicacion_clap');
			$this->StModel->set_data(array('id' => 'NULL', 'id_clap' => $this->input->post('id'), '_key' => 'estado', '_value' => $this->input->post('estado')), "ubicacion_clap");
			$this->StModel->set_data(array('id' => 'NULL', 'id_clap' => $this->input->post('id'), '_key' => 'municipio', '_value' => $this->input->post('municipio')), "ubicacion_clap");
			$this->StModel->set_data(array('id' => 'NULL', 'id_clap' => $this->input->post('id'), '_key' => 'parroquia', '_value' => $this->input->post('parroquia')), "ubicacion_clap");
			$this->StModel->set_data(array('id' => 'NULL', 'id_clap' => $this->input->post('id'), '_key' => 'direccion', '_value' => $this->input->post('direccion')), "ubicacion_clap");
			redirect('admin/clap/ver/'.$this->input->post('id'));
		}else{
			$this->showError('Ocurrió un error inesperado :(');
		}
	}

	public function test(){
		print_r($this->session->userdata);
	}
}