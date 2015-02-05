<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('auth_helper');
		redirect_if_not_logged_in();
		$this->load->view('welcome_message');
		
				$this->load->library('grocery_CRUD');
				try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('location');
			//$crud->set_subject('Location');
			//$crud->required_fields('name');
			//$crud->columns('name','room_no','description');

			 $output = $crud->render();
			//print_r($output);
			 echo $output->output;

//			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
				
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */