<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Locations extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}
	
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
		
		
		try
		{
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('location');
			$crud->set_primary_key('name');
			$crud->set_subject('Location');
			$crud->field_type('description', 'textarea');
			
			$crud->required_fields('name');
			$crud->set_rules('name','Name','trim|required|max_length[50]|xss_clean|alpha_dash||callback_location_exists');
			$crud->set_rules('room_no','Room No','numeric|trim|xss_clean');
			$crud->set_rules('description','Description','trim|xss_clean');
			
			$crud->columns('name','description');
 			//$crud->callback_add_field('name',array($this,'add_name_callback'));
			
 			$output = $crud->render();

			$this->load->view('locations_view',$output);
			
		}
		catch(Exception $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
			$this->load->view('locations_view',(object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		}
		
	}
	function location_exists($location)
	{
		$this->load->model('location');
		if($this->location->location_exists($location))
		{
			$this->form_validation->set_message('location_exists', 'This location already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	/*function add_name_callback()
	{
		
	}*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */