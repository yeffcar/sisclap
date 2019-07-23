<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index($continue='')
	{
		$this->session->sess_destroy();
		$data['title'] = "Login";
		if ($continue!=='') {
			$data['continue'] =str_replace('_','/',$continue);
		}
		$data['base_url'] = $this->config->base_url();
		$this->load->view('admin/head', $data);
		$this->load->view('admin/login', $data);
		$this->load->view('admin/footer', $data);
	}

	public function validar()
	{
		if ($this->input->post('username')) {	
			$this->load->model('LoginMod');
			$password = $this->input->post('password');
			$username = $this->input->post('username');
			$isLoged = $this->LoginMod->isLoged($username, $password);
			if ($isLoged) {
				if ($this->input->post('continue')) {
					redirect($this->input->post('continue'));
				}else{
					redirect('admin');
				}
			}else{
				$data['title'] = "Login";
				$data['base_url'] = $this->config->base_url();
				$data['error'] = "Combinacion Password / Username Invalido";
				$this->load->view('admin/head', $data);
				$this->load->view('admin/login', $data);
				$this->load->view('admin/footer', $data);
			}
		}else{
			$this->index();
		}
	}
}