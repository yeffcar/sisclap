<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		$this->load->helper('array');
		$this->load->helper('text');
		$this->load->model('ModRelations');

		$data = array('mensajes' => false, 'eventos' => false, 'albumes' => false);
		$data['username'] = $this->session->userdata('username');
		$data['title'] = "Admin";
		$data['h1'] = "Bienvenido";
		$data['header'] = $this->load->view('admin/header', $data, TRUE);
		//Make the timeline
		if ($this->session->userdata('level')==3) {
		$relations = $this->ModRelations->get_relation(array('id_user' => $this->session->userdata('id')), '10', array('date','DESC'));	
			
		}else{
		$relations = $this->ModRelations->get_relation(array('usergroup >=' => $this->session->userdata('level')), '10', array('date','DESC'));	

		}

		$data['relations'] = $this->get_datarelations($relations);

		$this->load->view('admin/head', $data);
		$this->load->view('admin/navbar', $data);
		$data['timeline'] = $this->load->view('admin/timeline', $data, TRUE);
		$this->load->view('admin/bodypage', $data);
		$this->load->view('admin/footer', $data);
		
	}

}
