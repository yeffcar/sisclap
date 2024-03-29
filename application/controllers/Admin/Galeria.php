<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Galeria extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModGallery');
		$this->load->helper('form');
		
	}

	public function index()
	{
		
		$data['albumes'] = $this->ModGallery->get_album('all','',array('fecha','DESC'));

		$data['username'] = $this->session->userdata('username');
		$data['title'] = "Admin | Galería";
		$data['h1'] = "Galería de Imagenes";
		$data['header'] = $this->load->view('admin/header', $data, TRUE);
		
		$this->load->view('admin/head', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/galeria/albumes', $data);
		$this->load->view('admin/footer', $data);
	}

	public function Albumes($albumid=''){
		if(!$albumid){
			$this->index();
		}else{
			
			$album = $this->ModGallery->get_album(array('id' => $albumid));
			if($album){

				$data['album'] = $album;
				$data['items'] =  $this->StModel->get_data(array('id_album' => $albumid), 'album_items');		

				$data['title'] = "Admin | Galeria";
				$data['h1'] = $album[0]['nombre'];
				$data['header'] = $this->load->view('admin/header', $data, TRUE);	
				
				$data['head_includes'] = array('Galeria' => link_tag('css/galery.css'), 'file-input' => link_tag('js/fileinput-master/css/fileinput.min.css'));
				$data['footer_includes'] = array('file-input' => '<script src="'.base_url('js/fileinput-master/js/fileinput.js').'"></script>', 'file-input-canvas' => '<script src="'.base_url('js/fileinput-master/js/plugins/canvas-to-blob.min.js').'"></script>' );
				
				//Set upload options
				$directorio = './img/portfolio/';
				$data['error'] = '';
				$data['load_to'] = 'Admin/Galeria/subirtoalbum/'.$albumid;
				$data['form'] = $this->load->view('admin/galeria/upload_form', $data, TRUE);
				
				$this->load->view('admin/head', $data);
				$this->load->view('admin/navbar', $data);
				$this->load->view('admin/galeria/items', $data);
				$this->load->view('admin/footer', $data);
			}else{
				$this->showError('Album no encontrado :(');
			}
		}
	}
	public function subirmultiple($dir = '/img')
	{
		// set the url base
		$udir = $dir;
		$dir = str_replace('_','/',$dir);
		$data['base_url'] = $this->config->base_url();
		if (!$this->session->userdata('logged_in')) {
						header('Location: '.$data['base_url'] .'index.php/Login/');
				}else{
		$this->load->helper('strbefore');
		foreach ($_FILES["imagenes"]["error"] as $clave => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		        $nombre_tmp = $_FILES["imagenes"]["tmp_name"][$clave];
		        $ext = strstr($_FILES["imagenes"]["name"][$clave], '.');
		        $nombre = $_FILES["imagenes"]["name"][$clave];
		        move_uploaded_file($nombre_tmp, $dir.'/'.$nombre);
		    }
		}
		redirect('admin/galeria/index/'.$udir);
	}
	}

	public function subirtoalbum($albumid='')
	{
		// set the url base
		$data['base_url'] = $this->config->base_url();
		$this->load->model('ModGallery');
		$album = $this->StModel->get_data(array('id' => $albumid), 'album');
		$this->load->helper('string');
		foreach ($_FILES["imagenes"]["error"] as $clave => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		        $nombre_tmp = $_FILES["imagenes"]["tmp_name"][$clave];
		        $ext = strstr($_FILES["imagenes"]["name"][$clave], '.');
		        $nombre = random_string('alpha', 16).$ext;
		        move_uploaded_file($nombre_tmp, "./img/gallery/".$album[0]['path']."/$nombre");
		        $this->ModGallery->set_item($albumid, $nombre);
		    }
		}
		redirect('Admin/Galeria/albumes/'.$albumid);
		
	}

	private function set_upload_options(){   
		    //upload an image options
		    $config = array();
		    $config['upload_path'] = './img/portfolio/';
		    $config['allowed_types'] = 'gif|jpg|png';
		    $config['max_size']      = '0';
		    $config['overwrite']     = FALSE;

		    return $config;
	}
	
	public function uploadtoalbum($albumid = '')
	{
						// set the url base
		$data['base_url'] = $this->config->base_url();
// is the current user logged in ?
		if (!$this->session->userdata('logged_in')) {
				header('Location: '.$data['base_url'] .'index.php/Login/');
		}else{
		if ($albumid != '') {
			
		$this->load->model('ModGallery');
		$album = $this->ModGallery->get_album($albumid);
		$config['upload_path']          = './img/gallery/'.$album[0]['path'];
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 0;
		$config['max_width']            = 0;
		$config['max_height']           = 0;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile'))
			{
			$error = array('error' => $this->upload->display_errors());
				$data['username'] = $this->session->userdata('username');
				$data['title'] = "Admin | Upload";
				$data['h1'] = "Cargar Imagen";
				$data['header'] = $this->load->view('admin/header', $data, TRUE);
				
				$this->load->view('admin/head', $data);
				$this->load->view('admin/navbar', $data);
				$data['conten'] = $this->load->view('admin/galeria/upload_form', $error, TRUE);
				
				$this->load->view('admin/template', $data);
				$this->load->view('admin/footer', $data);
		}
		else
		{
				$config['image_library'] = 'gd2';
				$config['source_image'] = './img/gallery/'.$album[0]['path'].'/'.$this->upload->data('file_name');
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
						$config['width']         = 200;
						$this->load->library('image_lib', $config);
						if ( ! $this->image_lib->resize())
						{
							$this->image_lib->display_errors('<p>', '</p>');
						}
						$this->ModGallery->set_item($albumid, $this->upload->data('file_name'));
						$this->Albumes($albumid);
				}
				}
		}
		}
		public function crearalbum()
		{
			
			$data['title'] = "Admin | Nuevo Album";
			$data['h1'] = "Agregar nuevo Album";
			$data['header'] = $this->load->view('admin/header', $data, TRUE);
			$data['footer_includes'] = array(
				'tinymce'=>'<script src="'.base_url('js/tinymce/js/tinymce/tinymce.min.js').'"></script>',
				'tinymceinit' => "<script>tinymce.init({ selector:'textarea',  plugins : ['link table'] });</script>");

			$this->load->view('admin/head', $data);
			$this->load->view('admin/navbar', $data);
			$this->load->view('admin/galeria/crearalbum', $data);
			$this->load->view('admin/footer', $data);
		
		}
		public function editaralbum($albumid)
		{
			
			$this->load->model('ModGallery');

			$data['title'] = "Admin | Editar album";
			$data['h1'] = "Editar album";
			$data['header'] = $this->load->view('admin/header', $data, TRUE);
			$data['album'] = $this->ModGallery->get_album($albumid);
			
			$data['footer_includes'] = array(
				'tinymce'=>'<script src="'.base_url('js/tinymce/js/tinymce/tinymce.min.js').'"></script>',
				'tinymceinit' => "<script>tinymce.init({ selector:'textarea',  plugins : ['link table'] });</script>");
			
			$this->load->view('admin/head', $data);
			$this->load->view('admin/navbar', $data);
			$this->load->view('admin/galeria/editaralbum', $data);
			$this->load->view('admin/footer', $data);
		
		}
		public function savealbumedit($albumid)
		{
				// set the url base
			$data['base_url'] = $this->config->base_url();
			// is the current user logged in ?
			if (!$this->session->userdata('logged_in')) {
				header('Location: '.$data['base_url'] .'index.php/Login/');
			}else{
				$this->load->model('ModGallery');
				$result = $this->ModGallery->update_album($albumid);
				if($result){
					$this->Albumes($albumid);
				}else{
						$data['username'] = $this->session->userdata('username');
						$data['title'] = "Admin | Usuarios";
						$data['h1'] = "Albumes";
						$data['header'] = $this->load->view('admin/header', $data, TRUE);
						$this->load->view('admin/head', $data);
						$this->load->view('admin/navbar', $data);
						$data['error'] = '';
						$data['conten'] = "Ocurrio un error ".$albumid;
						$this->load->view('admin/template', $data);
						$this->load->view('admin/footer', $data);
				}
			}
		}
		public function savealbum()
		{
		
			$this->load->helper('string');
			$path = "album".random_string('alnum', 16);
			mkdir('./img/gallery/'.$path);
			$this->load->helper('date');
			if($this->ModGallery->set_album($path)){
				$this->load->model('ModRelations');
				$album = $this->ModGallery->get_album(array('path' => $path));
				$relations = array('id_user' => $this->session->userdata('id'), 'tablename' => 'album', 'id_row' => $album[0]['id'], 'action' => 'crear');
				$this->ModRelations->set_relation($relations);
				redirect('admin/galeria/albumes/'.$album[0]['id']);
			}else{
				$this->showError();
			}
		}

		private function uploadmultiple()
		{       
		    $this->load->library('upload');
		    $files = $_FILES;
		    $cpt = count($_FILES['userfile']['name']);
		    for($i=0; $i<$cpt; $i++)
		    {           
		        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
		        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
		        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
		        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
		        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    
		        $this->upload->initialize($this->set_upload_options());
		        $this->upload->do_upload();
		    }
		}
}
?>