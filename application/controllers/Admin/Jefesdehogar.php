<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jefesdehogar extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		
		$data['title'] = "Admin | Jefes de Hogar";
		$data['h1'] = "Jefes de Hogar";
		
		$data['header'] = $this->load->view('admin/header', $data, TRUE);
		$data['username'] = $this->session->userdata('username');

		//Administrador
		
		$data['jefes'] = $this->StModel->get_data(array('id_lider' => $this->session->userdata('id')), 'jefe_hogar');

		$this->load->view('admin/head', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/jefesdehogar/todos', $data);

		$this->load->view('admin/footer', $data);
	}

	public function planilla($id_lider = 'all'){
		
		$data['title'] = "Admin | Planilla";
		$data['h1'] = "";
		
		$data['header'] = $this->load->view('admin/header', $data, TRUE);
		$data['username'] = $this->session->userdata('username');



		if ($id_lider == 'all') {
			$id_lider = $this->session->userdata('id');
		}

		$this->load->model('UserMod');
		$data['userdata'] = $this->UserMod->get_user(array('user.id' => $id_lider));
		$datastorage = $this->UserMod->get_datauserstorage(array('id_user'=>$id_lider));
			if ($datastorage) {
				foreach ($datastorage as $key => $value) {
					$data['userdata'][0][$value['_key']] = $value['_value'];
				}
			}

		//Si incie session como lider veo mis planillas 
		if ($this->session->userdata('level') == 3) {
			$whereportion = '`id_lider` = '.$id_lider;
		}
		$data['clapasociado'] = $this->StModel->get_custom_data('`datos_lideres`', $whereportion, '*');

		$data['jefes'] = $this->StModel->get_data(array('id_lider' => $this->session->userdata('id')), 'jefe_hogar');


		$data['clap'] = $this->StModel->get_data(array('id' => $data['clapasociado'][0]['id_clap']), 'datos_clap');

		$ubicaciones = $this->StModel->get_data(array('id_clap' => $data['clap'][0]['id']), 'ubicacion_clap');
				//get_datauserstorage
				if ($ubicaciones) {
					foreach ($ubicaciones as $key => $value) {
						$data['clap'][0][$value['_key']] = $value['_value'];
					}
				}


		$this->load->view('admin/head', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/jefesdehogar/planillaclap', $data);

		$this->load->view('admin/footer', $data);
	}
	

	public function editar($id){
		$data['jefe'] = $this->StModel->get_data(array('id' => $id), 'jefe_hogar')[0];
		if ($data['jefe']) {
			$this->load->helper('form');
			$this->load->helper('array');
			$data['action'] = 'admin/Jefesdehogar/update/';
			$data['title'] = "Admin | Editar datos";
			$data['userdata'] = false;
			$data['h1'] = "Jefes de hogar";
			$data['header'] = $this->load->view('admin/header', $data, TRUE);
			// Load the views
			$this->load->view('admin/head', $data);
			$this->load->view('admin/navbar', $data);
			$this->load->view('admin/jefesdehogar/crear', $data);
			$this->load->view('admin/footer', $data);
		}else{
			$this->showError();
		}	
	}

	public function nuevo($tipo = 'all'){

			$this->load->helper('form');
			$this->load->helper('array');

			$data['jefes'] = array();
			$data['action'] = 'admin/Jefesdehogar/save/';
			$data['title'] = "Admin | Nuevo Jefe de Hogar";
			$data['userdata'] = false;
			$data['jefe'] = array();
			$data['h1'] = "Jefes de hogar";
			$data['header'] = $this->load->view('admin/header', $data, TRUE);
			// Load the views
			$this->load->view('admin/head', $data);
			$this->load->view('admin/navbar', $data);
			$this->load->view('admin/jefesdehogar/crear', $data);
			$this->load->view('admin/footer', $data);
	}

	public function save(){
		
			$status = "0";
			if($this->input->post('status')=="on"){
				$status = "1";
			}

			$data = array(
				'cedula' => $this->input->post('cedula'),
				'nombre' => $this->input->post('nombre'),
				'apellido' => $this->input->post('apellido'),
				'email' => $this->input->post('email'),
				'telefono' => $this->input->post('telefono'),
				'direccion' => $this->input->post('direccion'),
				'n_miembros' => $this->input->post('n_miembros'),
				'id_lider' => $this->session->userdata('id'),
				'status' =>  $status
			);

			if($this->StModel->set_data($data, 'jefe_hogar')){
			$this->load->model('ModRelations');
			$id_jefe = $this->StModel->get_data(array('cedula'=>$this->input->post('cedula')), 'jefe_hogar')[0]['id'];
			$relations = array('id_user' => $this->session->userdata('id'), 'tablename' => 'jefe_hogar', 'id_row' => $id_jefe, 'action' => 'crear');

			$this->ModRelations->set_relation($relations);
			redirect('admin/Jefesdehogar');

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
				'cedula' => $this->input->post('cedula'),
				'nombre' => $this->input->post('nombre'),
				'apellido' => $this->input->post('apellido'),
				'email' => $this->input->post('email'),
				'telefono' => $this->input->post('telefono'),
				'direccion' => $this->input->post('direccion'),
				'n_miembros' => $this->input->post('n_miembros'),
				'status' =>  $status
		);

		if($this->StModel->update_data(array('id' => $id ), $data, 'jefe_hogar')){
			redirect('admin/Jefesdehogar');
		}else{
			$this->showError();
		}
	}

}