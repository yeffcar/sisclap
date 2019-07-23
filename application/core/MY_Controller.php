<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
				$uri = str_replace('/','_',uri_string());
				redirect('admin/login/index/'.$uri);
		}
	}

	public function showError($errorMsg = 'Ocurrio un error inesperado', $data = array('title' => 'Error', 'h1' => 'Error')){	
		$data['conten'] = $errorMsg;
		$data['header'] = $this->load->view('admin/header', $data, TRUE);
		$this->load->view('admin/head', $data);
		$this->load->view('admin/navbar', $data);	
		$this->load->view('admin/template', $data);
		$this->load->view('admin/footer', $data);
	}

	public function fn_ajax_delete_data()
	{
		$json = array('result' => FALSE, 'message'=> 'Error al eliminar datos');
		$array_id = $this->input->post('id');
		$table = $this->input->post('table');

		foreach ($array_id as $key => $id) {
			if ($this->input->post('whereportion')) {
				
			}
				if($this->StModel->delete_data(array('id' => $id), $table)){
					if ($table == 'datos_clap') {
						$this->StModel->delete_data(array('id_clap' => $id), 'ubicacion_clap');
						$this->StModel->delete_data(array('id_clap' => $id), 'datos_lideres');
					}
					if ($table == 'user') {
						$this->StModel->delete_data(array('id_user' => $id), 'datauserstorage');
					}
					$json = array('result' => TRUE, 'message'=> 'Datos eliminados con exito!');
					$this->StModel->delete_data(array('id_row' => $id, 'tablename' => $table), 'relations');
				}else{
					break;
				}
			
		}
	
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function fn_ajax_check_value(){
		
		$this->load->model('StModel');

		$table = $this->input->post('table');
		$field = $this->input->post('field');
		$value = $this->input->post('value');

		$res = $this->StModel->get_is_exist_value($table, $field, $value);
		
		$json = array('result' => FALSE);
		if ($res) {
			$json = array('result' => TRUE);
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function fn_ajax_change_state()
	{

		$id = $this->input->post('id');
		$table = $this->input->post('table');
		$status = 0;
		if ($this->input->post('status')==='1') {
			$status = 1;
		}
		$json = array('result' => FALSE, 'message'=> 'Error al cambiar estado!');
		if($this->StModel->update_data(array('id' => $id), array('status' => $status), $table)){
			$json = array('result' => TRUE, 'message'=> 'Actualizado con exito!');
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function get_datarelations($relations)
	{	
		$dat = false;
		if ($relations) {
		foreach ($relations as $key => $row) {
			$id = $row['id_row'];
			$table = $row['tablename'];
			$date_rel = $row['date'];
			switch ($table) {
				case 'user':
						$users  = $this->StModel->get_data($data = array('user.id' => $id), $table, $limit = '', $order = array('user.id','DESC'));
						$users[0]['tiperel'] = 'user';
						$users[0]['date_rel'] = $date_rel;
						$users[0]['user_rel'] = $row['username'];
						$users[0]['id_user_rel'] = $row['id_user'];

						$dat[] = $users[0];
				break;				
				case 'datos_clap':
						$users  = $this->StModel->get_data($data = array('id' => $id), $table);
						$users[0]['tiperel'] = 'datos_clap';
						$users[0]['date_rel'] = $date_rel;
						$users[0]['user_rel'] = $row['username'];
						$users[0]['id_user_rel'] = $row['id_user'];
						$dat[] = $users[0];
				break;
				case 'jefe_hogar':
						$jefe  = $this->StModel->get_data($data = array('id' => $id ), $table);
						$jefe[0]['tiperel'] = 'jefe_hogar';
						$jefe[0]['date_rel'] = $date_rel;
						$jefe[0]['user_rel'] = $row['username'];
						$jefe[0]['id_user_rel'] = $row['id_user'];
						$dat[] = $jefe[0];
				break;
				
				default:
					
				break;
			}
		}
		}
		return $dat;
	}
	
}
/* End of file MY_Controller */